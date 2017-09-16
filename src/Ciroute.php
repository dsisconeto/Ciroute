<?php
namespace DSisconeto\Ciroute;

class Ciroute
{
    private static $pathConfigRoute;
    private static $pathCache;
    private static $routesFolder;
    private static $names = 'ciroute_names.php';

    public function __construct($pathConfigRoute, $pathCache, $routesFolder)
    {

        self::$pathCache = $pathCache;
        self::$routesFolder = $routesFolder;
        self::$pathConfigRoute = $pathConfigRoute;

        $this->loadRoutesFiles()
        ->generateRoutes()
        ->generateNames();
    }

 
    private function generateRoutes()
    {
        $file = fopen(self::$pathConfigRoute, 'w');
        $routes = Route::get_routes();
        
        if (!$routes) {
            return;
        }
        $content =  "<?php \n defined('BASEPATH') or exit('No direct script access allowed');\n";
        foreach ($routes as $route) {
            $content .= '$route["'.$route["route"].'"]';
            $content .= $route["method"] != 'ANY'? '["'.$route['method'].'"]': '';
            $content .= '="' .$route["controller"]."\"; \n";
        }
            fwrite($file, $content);
            fclose($file);

            return $this;
    }


    private function generateNames()
    {

        $file = fopen(self::$pathCache.self::$names, 'w');
        $routes = Route::get_routes();
        $content =  "<?php \n";
        foreach ($routes as $route) {
            if (isset($route["name"])) {
                $content .= '$routes_names["'.$route["name"].'"] = "' .$route["route"]."\"; \n";
            }
        }
        $content .= 'return $routes_names;';
  
        fwrite($file, $content);
        fclose($file);
        return $this;
    }

    private function loadRoutesFiles()
    {
        $path = self::$routesFolder;
      
        $files = scandir($path);
        unset($files[0]);
        unset($files[1]);

        foreach ($files as $file) {
            if ($file && file_exists($path.$file)) {
                require_once($path.$file);
            }
        }
        return $this;
    }
}
