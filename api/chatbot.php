<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$message = $input['message'] ?? '';

if (!$message) {
    http_response_code(400);
    echo json_encode(['error' => 'Mensaje vacío']);
    exit;
}

// Configuración de Groq Cloud
$url = 'https://api.groq.com/openai/v1/chat/completions';
// Leer API Key desde el archivo .env
$envFile = __DIR__ . '/../.env';
$apiKey = '';
if (file_exists($envFile)) {
    $envVariables = parse_ini_file($envFile);
    $apiKey = $envVariables['GROQ_API_KEY'] ?? '';
}

if (!$apiKey) {
    http_response_code(500);
    echo json_encode(['error' => 'API Key no configurada en el servidor']);
    exit;
}
$model = 'qwen/qwen3.8-27b'; // Modelo compatible de generación de texto en Groq

$data = [
    "model" => $model,
    "messages" => [
        [
            "role" => "system",
            "content" => "Eres un asistente virtual útil para una tienda en línea llamada UTP-Market. Responde de manera concisa, amable y profesional en español."
        ],
        [
            "role" => "user",
            "content" => $message
        ]
    ],
    "temperature" => 1,
    "max_tokens" => 2048, // 'max_completion_tokens' es usado en OpenAI o1, en Groq se usa 'max_tokens'
    "top_p" => 1,
    "stream" => false,
    "stop" => null
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode >= 400 || !$response) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al comunicarse con la IA', 'details' => json_decode($response)]);
    exit;
}

$responseData = json_decode($response, true);
// Estructura estándar OpenAI/Groq
$botText = $responseData['choices'][0]['message']['content'] ?? 'No se pudo generar respuesta.';

echo json_encode(['response' => $botText]);
