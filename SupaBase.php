<?php
// 1. Cargar el archivo .env manualmente sin dependencias
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Ignorar comentarios
        if (strpos(trim($line), '#') === 0) continue;
        
        list($name, $value) = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
    }
}

// 2. Obtener las variables
$supabaseUrl = $_ENV['PUBLIC_SUPABASE_URL'] ?? '';
$supabaseAnonKey = $_ENV['PUBLIC_SUPABASE_ANON_KEY'] ?? '';
$supabaseServiceKey = $_ENV['SUPABASE_SERVICE_ROLE_KEY'] ?? '';

if (empty($supabaseUrl) || empty($supabaseAnonKey)) {
    die("Error: Faltan las credenciales de Supabase en el archivo .env");
}

/**
 * Función auxiliar sencilla para hacer peticiones a Supabase (REST API)
 * @param string $endpoint Ej: 'rest/v1/nombre_de_tu_tabla'
 * @param string $method 'GET', 'POST', 'PATCH', 'DELETE'
 * @param array|null $data Datos para enviar (en POST o PATCH)
 * @param bool $useServiceKey Usar la Service Role Key en lugar de la Anon Key
 */
function supabaseRequest($endpoint, $method = 'GET', $data = null, $useServiceKey = false) {
    global $supabaseUrl, $supabaseAnonKey, $supabaseServiceKey;

    $apiKey = $useServiceKey ? $supabaseServiceKey : $supabaseAnonKey;
    $url = rtrim($supabaseUrl, '/') . '/' . ltrim($endpoint, '/');

    $ch = curl_init($url);
    
    $headers = [
        "apikey: $apiKey",
        "Authorization: Bearer $apiKey",
        "Content-Type: application/json",
        "Prefer: return=representation" // Para que devuelva el registro insertado/actualizado
    ];

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    if ($data && in_array($method, ['POST', 'PATCH', 'PUT'])) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode >= 400) {
        return ['error' => true, 'code' => $httpCode, 'message' => $response];
    }

    return json_decode($response, true);
}