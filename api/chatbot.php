<?php
header('Content-Type: application/json');

// Habilitar logging de errores en PHP para depuración (se verá en los logs de Apache/Laragon)
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

// Permitir peticiones solo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

// Leer el JSON enviado
$input = json_decode(file_get_contents('php://input'), true);
$message = $input['message'] ?? '';

if (!$message) {
    http_response_code(400);
    echo json_encode(['error' => 'Mensaje vacío']);
    exit;
}

// Configuración de Ollama (En línea)
$url = 'https://ollama.com/api/chat';
$model = 'gemma4:31b';
$apiKey = 'd8318037886e4bdc9b268add87bcf417.2hBLwxdbRlKYcRrJZvasodNX';

// Preparar el cuerpo de la petición para la API de Ollama
$data = [
    "model" => $model,
    "messages" => [
        [
            "role" => "system",
            "content" => "Eres un asistente virtual útil para una tienda en línea llamada ShopUS. Responde de manera concisa, amable y profesional. Responde en español."
        ],
        [
            "role" => "user",
            "content" => $message
        ]
    ],
    "stream" => false // Esperar toda la respuesta
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Ejecutar petición
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

// Loguear resultados para depuración
error_log("--- OLLAMA API DEBUG ---");
error_log("HTTP Code: " . $httpCode);
if ($curlError) {
    error_log("CURL Error: " . $curlError);
}
error_log("Response: " . $response);

// Manejo de errores basado en el código HTTP
if ($httpCode >= 400 || $response === false) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Error al comunicarse con Ollama.',
        'details' => $response ? json_decode($response) : 'Sin respuesta del servidor',
        'curl_error' => $curlError
    ]);
    exit;
}

// Extraemos directamente el texto de la respuesta
$responseData = json_decode($response, true);
$botText = $responseData['message']['content'] ?? 'No pude generar una respuesta.';

echo json_encode(['response' => $botText]);
