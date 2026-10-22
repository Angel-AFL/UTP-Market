<?php
require_once __DIR__ . '/../SupaBase.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

const PRODUCTOS_TABLE = 'rest/v1/producto_y_servicio';
const PRODUCTOS_EMPRESA_ID = 1;
const IMAGENES_TABLE = 'rest/v1/imagenes';
const VIDEO_TABLE = 'rest/v1/video';

function responder($data, int $status = 200): void
{
    http_response_code($status);
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function errorSupabase(array $resultado): void
{
    $code = (int) ($resultado['code'] ?? 500);
    $mensaje = (string) ($resultado['message'] ?? 'Error al comunicarse con Supabase.');
    $details = $resultado['details'] ?? null;
    $codigoPostgres = is_array($details) ? ($details['code'] ?? '') : '';

    $mensajes = [
        '23502' => 'Falta un dato obligatorio para guardar el producto.',
        '23503' => 'La imagen o el video indicados no existen en el catálogo de Supabase. Deja esos campos vacíos o usa una URL registrada.',
        '23505' => 'Ya existe un producto con esos datos.',
        '23514' => 'Alguno de los valores no cumple las reglas de la base de datos.',
    ];

    if (isset($mensajes[$codigoPostgres])) {
        $mensaje = $mensajes[$codigoPostgres];
    } elseif ($code === 401 || $code === 403) {
        $mensaje = 'No hay permisos para realizar esta operación en Supabase.';
    } elseif ($code === 404) {
        $mensaje = 'El producto solicitado no existe.';
    }

    $status = in_array($code, [400, 401, 403, 404, 409], true) ? $code : 500;

    responder([
        'error' => true,
        'message' => $mensaje,
        'supabase_code' => $codigoPostgres ?: null,
        'details' => $details,
    ], $status);
}

function leerJson(): array
{
    $raw = file_get_contents('php://input');
    if ($raw === false || trim($raw) === '') {
        return [];
    }

    $data = json_decode($raw, true);

    if (!is_array($data)) {
        responder(['error' => true, 'message' => 'El cuerpo de la petición no es un JSON válido.'], 400);
    }

    return $data;
}

function validarId($id): int
{
    if (!is_numeric($id) || (int) $id <= 0) {
        responder(['error' => true, 'message' => 'El ID del producto no es válido.'], 400);
    }

    return (int) $id;
}

function validarUrl(?string $url, string $campo): ?string
{
    if ($url === null) {
        return null;
    }

    $url = trim($url);
    if ($url === '') {
        return null;
    }

    if (mb_strlen($url) > 500) {
        responder(['error' => true, 'message' => "El campo $campo no puede superar los 500 caracteres."], 400);
    }

    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        responder(['error' => true, 'message' => "El campo $campo debe ser una URL válida."], 400);
    }

    return $url;
}

function esErrorSupabase($resultado): bool
{
    return is_array($resultado) && isset($resultado['error']) && $resultado['error'];
}

function buscarMedio(string $tabla, string $campo, string $url): array
{
    $endpoint = $tabla . '?' . $campo . '=eq.' . rawurlencode($url) . '&select=' . $campo;
    return supabaseRequest($endpoint, 'GET', null, true);
}

function registrarMedio(string $tabla, string $campo, string $url): array
{
    $existente = buscarMedio($tabla, $campo, $url);

    if (esErrorSupabase($existente)) {
        return ['ok' => false, 'resultado' => $existente];
    }

    if (!empty($existente)) {
        return ['ok' => true, 'created' => false];
    }

    $creado = supabaseRequest($tabla, 'POST', [$campo => $url], true);

    if (esErrorSupabase($creado)) {
        $codigoHttp = (int) ($creado['code'] ?? 0);
        $detalles = $creado['details'] ?? [];
        $codigoPostgres = is_array($detalles) ? ($detalles['code'] ?? '') : '';

        // Si otra petición lo registró al mismo tiempo, se considera válido.
        if ($codigoHttp === 409 || $codigoPostgres === '23505') {
            return ['ok' => true, 'created' => false];
        }

        return ['ok' => false, 'resultado' => $creado];
    }

    return ['ok' => true, 'created' => true];
}

function prepararMedios(?string $urlImagen, ?string $urlVideo, bool $procesarImagen = true, bool $procesarVideo = true): array
{
    $creadas = [];

    if ($procesarImagen && $urlImagen !== null && $urlImagen !== '') {
        $registro = registrarMedio(IMAGENES_TABLE, 'url_imagen', $urlImagen);

        if (!$registro['ok']) {
            limpiarMediosCreados($creadas);
            return ['ok' => false, 'resultado' => $registro['resultado']];
        }

        if ($registro['created']) {
            $creadas[] = ['tipo' => 'imagen', 'url' => $urlImagen];
        }
    }

    if ($procesarVideo && $urlVideo !== null && $urlVideo !== '') {
        $registro = registrarMedio(VIDEO_TABLE, 'url_video', $urlVideo);

        if (!$registro['ok']) {
            limpiarMediosCreados($creadas);
            return ['ok' => false, 'resultado' => $registro['resultado']];
        }

        if ($registro['created']) {
            $creadas[] = ['tipo' => 'video', 'url' => $urlVideo];
        }
    }

    return ['ok' => true, 'creadas' => $creadas];
}

function limpiarMediosCreados(array $creadas): void
{
    foreach ($creadas as $medio) {
        eliminarMedioSiNoUsado($medio['tipo'], $medio['url']);
    }
}

function eliminarMedioSiNoUsado(string $tipo, ?string $url): bool
{
    if ($url === null || $url === '') {
        return false;
    }

    if ($tipo === 'imagen') {
        $tabla = IMAGENES_TABLE;
        $campo = 'url_imagen';
    } elseif ($tipo === 'video') {
        $tabla = VIDEO_TABLE;
        $campo = 'url_video';
    } else {
        return false;
    }

    $urlCodificada = rawurlencode($url);
    $referencias = supabaseRequest(
        PRODUCTOS_TABLE . '?' . $campo . '=eq.' . $urlCodificada . '&select=id&limit=1',
        'GET',
        null,
        true
    );

    if (esErrorSupabase($referencias) || !empty($referencias)) {
        return false;
    }

    $eliminado = supabaseRequest($tabla . '?' . $campo . '=eq.' . $urlCodificada, 'DELETE', null, true);

    return !esErrorSupabase($eliminado);
}

function eliminarMediosDeProducto(array $producto): void
{
    if (!empty($producto['url_imagen'])) {
        eliminarMedioSiNoUsado('imagen', $producto['url_imagen']);
    }

    if (!empty($producto['url_video'])) {
        eliminarMedioSiNoUsado('video', $producto['url_video']);
    }
}

function normalizarProductoParaInsert(array $input): array
{
    $nombre = trim((string) ($input['nombre'] ?? ''));
    if ($nombre === '') {
        responder(['error' => true, 'message' => 'El nombre del producto es obligatorio.'], 400);
    }
    if (mb_strlen($nombre) > 150) {
        responder(['error' => true, 'message' => 'El nombre del producto no puede superar los 150 caracteres.'], 400);
    }

    if (!isset($input['precio']) || !is_numeric($input['precio'])) {
        responder(['error' => true, 'message' => 'El precio del producto es obligatorio y debe ser numérico.'], 400);
    }

    $precio = (float) $input['precio'];
    if ($precio < 0) {
        responder(['error' => true, 'message' => 'El precio no puede ser negativo.'], 400);
    }

    $producto = [
        'empresa_id' => PRODUCTOS_EMPRESA_ID,
        'nombre' => $nombre,
        'precio' => $precio,
        'stock' => 0,
    ];

    $descripcion = trim((string) ($input['descripcion'] ?? ''));
    if ($descripcion !== '') {
        $producto['descripcion'] = $descripcion;
    }

    $urlImagen = validarUrl($input['url_imagen'] ?? null, 'url_imagen');
    if ($urlImagen !== null) {
        $producto['url_imagen'] = $urlImagen;
    }

    $urlVideo = validarUrl($input['url_video'] ?? null, 'url_video');
    if ($urlVideo !== null) {
        $producto['url_video'] = $urlVideo;
    }

    return $producto;
}

function normalizarProductoParaUpdate(array $input): array
{
    $permitidos = ['nombre', 'precio', 'stock', 'descripcion', 'url_imagen', 'url_video', 'calificacion'];
    $cambios = [];

    foreach ($permitidos as $campo) {
        if (!array_key_exists($campo, $input)) {
            continue;
        }

        $valor = $input[$campo];

        if ($campo === 'nombre') {
            $valor = trim((string) $valor);
            if ($valor === '') {
                responder(['error' => true, 'message' => 'El nombre del producto no puede quedar vacío.'], 400);
            }
            if (mb_strlen($valor) > 150) {
                responder(['error' => true, 'message' => 'El nombre del producto no puede superar los 150 caracteres.'], 400);
            }
        } elseif ($campo === 'precio') {
            if (!is_numeric($valor) || (float) $valor < 0) {
                responder(['error' => true, 'message' => 'El precio debe ser un número mayor o igual a cero.'], 400);
            }
            $valor = (float) $valor;
        } elseif ($campo === 'stock') {
            if (!is_numeric($valor) || (int) $valor < 0) {
                responder(['error' => true, 'message' => 'El stock debe ser un número entero mayor o igual a cero.'], 400);
            }
            $valor = (int) $valor;
        } elseif ($campo === 'descripcion') {
            $valor = trim((string) $valor);
            if ($valor === '') {
                $cambios[$campo] = null;
                continue;
            }
        } elseif ($campo === 'url_imagen' || $campo === 'url_video') {
            $valor = validarUrl(is_string($valor) ? $valor : null, $campo);
        } elseif ($campo === 'calificacion') {
            if ($valor === null || $valor === '') {
                $cambios[$campo] = null;
                continue;
            }
            if (!is_numeric($valor) || (float) $valor < 0 || (float) $valor > 5) {
                responder(['error' => true, 'message' => 'La calificación debe estar entre 0 y 5.'], 400);
            }
            $valor = (float) $valor;
        }

        $cambios[$campo] = $valor;
    }

    return $cambios;
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $id = isset($_GET['id']) && $_GET['id'] !== '' ? validarId($_GET['id']) : null;
        $endpoint = PRODUCTOS_TABLE . '?select=*';

        if ($id !== null) {
            $endpoint = PRODUCTOS_TABLE . '?id=eq.' . $id . '&select=*';
        }

        $resultado = supabaseRequest($endpoint, 'GET', null, true);

        if (isset($resultado['error']) && $resultado['error']) {
            errorSupabase($resultado);
        }

        if ($id !== null) {
            if (empty($resultado)) {
                responder(['error' => true, 'message' => 'El producto solicitado no existe.'], 404);
            }

            responder($resultado[0]);
        }

        responder(is_array($resultado) ? $resultado : []);
        break;

    case 'POST':
        $input = leerJson();
        $producto = normalizarProductoParaInsert($input);

        $medios = prepararMedios(
            $producto['url_imagen'] ?? null,
            $producto['url_video'] ?? null
        );

        if (!$medios['ok']) {
            errorSupabase($medios['resultado']);
        }

        $resultado = supabaseRequest(PRODUCTOS_TABLE, 'POST', $producto, true);

        if (esErrorSupabase($resultado)) {
            limpiarMediosCreados($medios['creadas']);
            errorSupabase($resultado);
        }

        responder([
            'message' => 'Producto creado correctamente.',
            'producto' => is_array($resultado) && isset($resultado[0]) ? $resultado[0] : $resultado,
        ], 201);
        break;

    case 'PATCH':
        $input = leerJson();
        $id = validarId($input['id'] ?? ($_GET['id'] ?? null));
        unset($input['id'], $input['empresa_id']);

        $cambios = normalizarProductoParaUpdate($input);

        if (empty($cambios)) {
            responder(['error' => true, 'message' => 'No hay campos válidos para actualizar.'], 400);
        }

        $consulta = supabaseRequest(PRODUCTOS_TABLE . '?id=eq.' . $id . '&select=*', 'GET', null, true);

        if (esErrorSupabase($consulta)) {
            errorSupabase($consulta);
        }

        if (empty($consulta)) {
            responder(['error' => true, 'message' => 'El producto solicitado no existe.'], 404);
        }

        $productoAnterior = $consulta[0];
        $cambiaImagen = array_key_exists('url_imagen', $cambios);
        $cambiaVideo = array_key_exists('url_video', $cambios);

        $medios = prepararMedios(
            $cambiaImagen ? $cambios['url_imagen'] : null,
            $cambiaVideo ? $cambios['url_video'] : null,
            $cambiaImagen,
            $cambiaVideo
        );

        if (!$medios['ok']) {
            errorSupabase($medios['resultado']);
        }

        $endpoint = PRODUCTOS_TABLE . '?id=eq.' . $id;
        $resultado = supabaseRequest($endpoint, 'PATCH', $cambios, true);

        if (esErrorSupabase($resultado)) {
            limpiarMediosCreados($medios['creadas']);
            errorSupabase($resultado);
        }

        if (empty($resultado)) {
            limpiarMediosCreados($medios['creadas']);
            responder(['error' => true, 'message' => 'El producto solicitado no existe.'], 404);
        }

        if ($cambiaImagen) {
            $imagenAnterior = $productoAnterior['url_imagen'] ?? null;
            $imagenNueva = $cambios['url_imagen'];

            if ($imagenAnterior && $imagenAnterior !== $imagenNueva) {
                eliminarMedioSiNoUsado('imagen', $imagenAnterior);
            }
        }

        if ($cambiaVideo) {
            $videoAnterior = $productoAnterior['url_video'] ?? null;
            $videoNuevo = $cambios['url_video'];

            if ($videoAnterior && $videoAnterior !== $videoNuevo) {
                eliminarMedioSiNoUsado('video', $videoAnterior);
            }
        }

        responder([
            'message' => 'Producto actualizado correctamente.',
            'producto' => $resultado[0],
        ]);
        break;

    case 'DELETE':
        $id = validarId($_GET['id'] ?? null);

        $consulta = supabaseRequest(PRODUCTOS_TABLE . '?id=eq.' . $id . '&select=*', 'GET', null, true);

        if (esErrorSupabase($consulta)) {
            errorSupabase($consulta);
        }

        if (empty($consulta)) {
            responder(['error' => true, 'message' => 'El producto solicitado no existe.'], 404);
        }

        $producto = $consulta[0];

        $endpoint = PRODUCTOS_TABLE . '?id=eq.' . $id;
        $resultado = supabaseRequest($endpoint, 'DELETE', null, true);

        if (esErrorSupabase($resultado)) {
            errorSupabase($resultado);
        }

        if (empty($resultado)) {
            responder(['error' => true, 'message' => 'El producto solicitado no existe.'], 404);
        }

        eliminarMediosDeProducto($producto);

        responder([
            'message' => 'Producto eliminado correctamente.',
            'producto' => $resultado[0],
        ]);
        break;

    default:
        header('Allow: GET, POST, PATCH, DELETE, OPTIONS');
        responder(['error' => true, 'message' => 'Método no permitido.'], 405);
}
