<?php
// 1. Cargar el archivo .env manualmente sin dependencias
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Ignorar comentarios
        if (strpos(trim($line), '#') === 0) continue;

        if (strpos($line, '=') === false) continue;

        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        // Quitar comillas envolventes si existen
        if (strlen($value) >= 2) {
            $first = $value[0];
            $last = $value[strlen($value) - 1];
            if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                $value = substr($value, 1, -1);
            }
        }

        $_ENV[$name] = $value;
    }
}


$supabaseUrl = $_ENV['PUBLIC_SUPABASE_URL'] ?? $_ENV['SUPABASE_URL'] ?? '';
$supabaseAnonKey = $_ENV['PUBLIC_SUPABASE_PUBLISHABLE_KEY'] ?? $_ENV['PUBLIC_SUPABASE_ANON_KEY'] ?? '';
$supabaseServiceKey = $_ENV['SUPABASE_SERVICE_ROLE_KEY'] ?? '';

if (empty($supabaseUrl) || (empty($supabaseAnonKey) && empty($supabaseServiceKey))) {
    die("Error: Faltan las credenciales de Supabase en el archivo .env");
}

/**
 * Función auxiliar para hacer peticiones a Supabase (REST API).
 * Usa cURL si está disponible y, si no, recurre a file_get_contents.
 *
 * @param string $endpoint Ej: 'rest/v1/nombre_de_tu_tabla?select=*'
 * @param string $method 'GET', 'POST', 'PATCH', 'DELETE'
 * @param array|null $data Datos para enviar (en POST o PATCH)
 * @param bool $useServiceKey Usar la Service Role Key en lugar de la Anon Key
 * @return array
 */
function supabaseRequest($endpoint, $method = 'GET', $data = null, $useServiceKey = false) {
    global $supabaseUrl, $supabaseAnonKey, $supabaseServiceKey;

    $method = strtoupper($method);
    $apiKey = $useServiceKey && $supabaseServiceKey !== ''
        ? $supabaseServiceKey
        : ($supabaseAnonKey !== '' ? $supabaseAnonKey : $supabaseServiceKey);

    if (empty($apiKey)) {
        return ['error' => true, 'code' => 500, 'message' => 'No hay una llave de Supabase configurada.'];
    }

    $url = rtrim($supabaseUrl, '/') . '/' . ltrim($endpoint, '/');

    $headers = [
        "apikey: $apiKey",
        "Content-Type: application/json",
        "Accept: application/json",
        "Prefer: return=representation",
    ];

    // Las llaves nuevas (sb_secret_...) se autentican solo con "apikey".
    // Las llaves JWT tradicionales también requieren Authorization.
    if (strpos($apiKey, 'eyJ') === 0) {
        $headers[] = "Authorization: Bearer $apiKey";
    }

    $payload = null;
    if ($data !== null && in_array($method, ['POST', 'PATCH', 'PUT'], true)) {
        $payload = json_encode($data);
        if ($payload === false) {
            return ['error' => true, 'code' => 500, 'message' => 'No se pudieron codificar los datos enviados.'];
        }
    }

    $response = null;
    $httpCode = 0;

    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        if ($payload !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        }

        $response = curl_exec($ch);
        $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($response === false) {
            return ['error' => true, 'code' => 500, 'message' => 'Error de conexión: ' . $curlError];
        }
    } else {
        $http = [
            'method' => $method,
            'header' => implode("\r\n", $headers),
            'ignore_errors' => true,
            'timeout' => 30,
            'protocol_version' => 1.1,
        ];

        if ($payload !== null) {
            $http['content'] = $payload;
        }

        $response = @file_get_contents($url, false, stream_context_create(['http' => $http]));

        if (isset($http_response_header) && is_array($http_response_header)) {
            foreach ($http_response_header as $headerLine) {
                if (preg_match('#^HTTP/\S+\s+(\d{3})#', $headerLine, $matches)) {
                    $httpCode = (int) $matches[1];
                    break;
                }
            }
        }

        if ($response === false) {
            return ['error' => true, 'code' => $httpCode ?: 500, 'message' => 'Error de conexión con Supabase.'];
        }
    }

    $decoded = json_decode($response, true);

    if ($httpCode >= 400) {
        $message = 'Error ' . $httpCode . ' al comunicarse con Supabase.';

        if (is_array($decoded)) {
            $message = $decoded['message'] ?? $decoded['error_description'] ?? $message;
        } elseif (is_string($response) && trim($response) !== '') {
            $message = trim($response);
        }

        return ['error' => true, 'code' => $httpCode, 'message' => $message, 'details' => $decoded];
    }

    if ($decoded === null) {
        return [];
    }

    return $decoded;
}
