<?php
/**
 * Controlador de Vistas y Helpers para Proyecto PHP Puro (Sin Laravel)
 */

class ViewController
{
    /**
     * Obtiene la URL base dinámica del proyecto (útil tanto en localhost como en producción)
     */
    public static function getBaseUrl(): string
    {
        static $baseUrl = null;
        if ($baseUrl === null) {
            $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
            $baseUrl = ($scriptDir === '/' || $scriptDir === '.') ? '' : rtrim($scriptDir, '/');
        }
        return $baseUrl;
    }

    /**
     * Genera la ruta para un recurso estático (CSS, JS, imágenes)
     */
    public static function asset(string $path): string
    {
        return self::getBaseUrl() . '/' . ltrim($path, '/');
    }

    /**
     * Genera la URL para una ruta o página interna
     */
    public static function url(string $path = ''): string
    {
        return self::getBaseUrl() . '/' . ltrim($path, '/');
    }

    /**
     * Catálogo central de servicios de UTP Market.
     * Única fuente de verdad: el buscador, el menú y el sidebar se alimentan de aquí.
     */
    public static function servicios(): array
    {
        return [
            [
                'nombre' => 'Impresión 3D',
                'slug' => 'impresion-3d',
                'subservicios' => [
                    'Prototipado Rápido',
                    'Figuras y Coleccionables',
                    'Refacciones y Piezas',
                    'Filamentos y Resinas',
                ],
            ],
            [
                'nombre' => 'Cortadora Láser',
                'slug' => 'cortadora-laser',
                'subservicios' => [
                    'Grabado en Madera',
                    'Corte en Acrílico',
                    'Letreros y Señalética',
                    'Reconocimientos y Trofeos',
                ],
            ],
            [
                'nombre' => 'Playeras Personalizadas',
                'slug' => 'playeras-personalizadas',
                'subservicios' => [
                    'Estampado DTF',
                    'Sublimación',
                    'Vinil Textil',
                    'Playeras para Eventos',
                ],
            ],
            [
                'nombre' => 'Fotografías',
                'slug' => 'fotografias',
                'subservicios' => [
                    'Fotografía de Producto',
                    'Sesiones de Estudio',
                    'Impresión en Cuadros',
                    'Restauración Digital',
                ],
            ],
            [
                'nombre' => 'Cursos',
                'slug' => 'cursos-y-talleres',
                'subservicios' => [
                    'Modelado 3D',
                    'Manejo de Corte Láser',
                    'Técnicas de Estampado',
                    'Fotografía Básica',
                ],
            ],
        ];
    }

    /**
     * Categorías que se muestran en el sidebar de filtros (mismo orden actual)
     */
    public static function categorias(): array
    {
        return [
            'impresion-3d' => 'Impresión 3D',
            'cortadora-laser' => 'Cortadora Láser',
            'playeras-personalizadas' => 'Playeras Personalizadas',
            'fotografias' => 'Fotografías',
            'cursos-y-talleres' => 'Cursos y Talleres',
            'prototipado-rapido' => 'Prototipado Rápido',
            'figuras-y-coleccionables' => 'Figuras y Coleccionables',
            'grabado-en-madera' => 'Grabado en Madera',
            'corte-en-acrilico' => 'Corte en Acrílico',
            'estampado-dtf' => 'Estampado DTF',
            'sublimacion' => 'Sublimación',
            'fotografia-de-producto' => 'Fotografía de Producto',
            'modelado-3d' => 'Modelado 3D',
        ];
    }

    /**
     * Genera un slug legible a partir de un nombre de servicio
     */
    public static function slugify(string $text): string
    {
        $map = [
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ü' => 'u', 'ñ' => 'n',
            'Á' => 'a', 'É' => 'e', 'Í' => 'i', 'Ó' => 'o', 'Ú' => 'u', 'Ü' => 'u', 'Ñ' => 'n',
        ];
        $text = strtr($text, $map);
        $text = preg_replace('/[^A-Za-z0-9]+/', '-', $text);
        return strtolower(trim($text, '-'));
    }

    /**
     * Renderiza una vista dentro del layout principal
     *
     * @param string $viewName Nombre del archivo en views/ (sin extensión .php)
     * @param array $data Variables que estarán disponibles en la vista
     * @param string|null $layout Nombre del layout en views/layouts/ (o null para sin layout)
     */
    public static function render(string $viewName, array $data = [], ?string $layout = 'main'): void
    {
        // Extrae las variables para que estén disponibles en la vista
        extract($data);

        // Sanear el nombre de la vista
        $viewName = trim($viewName, '/');
        $viewName = preg_replace('/\.php$/', '', $viewName);

        $viewFile = __DIR__ . '/views/' . $viewName . '.php';

        if (!file_exists($viewFile)) {
            http_response_code(404);
            $viewFile = __DIR__ . '/views/404.php';
        }

        // Captura el contenido de la vista
        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        // Si se especificó un layout, lo renderiza pasando $content
        if ($layout) {
            $layoutFile = __DIR__ . '/views/layouts/' . $layout . '.php';
            if (file_exists($layoutFile)) {
                require $layoutFile;
                return;
            }
        }

        // Si no hay layout, imprime el contenido directamente
        echo $content;
    }
}

// Helpers globales para fácil uso en plantillas y vistas
if (!function_exists('asset')) {
    function asset(string $path): string {
        return ViewController::asset($path);
    }
}

if (!function_exists('url')) {
    function url(string $path = ''): string {
        return ViewController::url($path);
    }
}

if (!function_exists('view')) {
    function view(string $viewName, array $data = [], ?string $layout = 'main'): void {
        ViewController::render($viewName, $data, $layout);
    }
}

if (!function_exists('servicios')) {
    function servicios(): array {
        return ViewController::servicios();
    }
}

if (!function_exists('categorias')) {
    function categorias(): array {
        return ViewController::categorias();
    }
}

if (!function_exists('slugify')) {
    function slugify(string $text): string {
        return ViewController::slugify($text);
    }
}
