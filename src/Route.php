<?php
namespace DSisconeto\Ciroute;

class Route
{
    private static $routes = [
        0=> [
            'controller'=>'welcome',
            'route'=>'default_controller',
            'name'=>'index',
            'method' =>'ANY',
        ],
        1=>  [
            'controller'=>'',
            'route'=>'404_override',
            'name'=>'404_override',
            'method' =>'ANY',
        ],
        2=>  [
            'controller'=>false,
            'route'=>'translate_uri_dashes',
            'name'=>'',
            'method' =>'ANY',
        ],

    ];

    private static $routes_reservard=[
        "default_controller"=>1,
        "404_override"=>1,
        "translate_uri_dashes" => 1,
    ];

    public static $instance  = null;

    private function __construct()
    {
    }
    public static function set_default_controller($controller)
    {
        $controller = Group::getController($controller);
        $controller = Group::getFolder($controller);
        self::$routes[0]['controller'] = $controller;
    }
  
    public static function set_404_override($controller)
    {
        $controller = Group::getController($controller);
        $controller = Group::getFolder($controller);
        self::$routes[1]['controller'] = $controller;
    }

    public static function set_translate_uri_dashes($controller)
    {
        $controller = Group::getController($controller);
        $controller = Group::getFolder($controller);
        self::$routes[2]['controller'] = $controller;
    }

    public static function get($route, $controler)
    {
        return self::getInstance()->setRoute($route, $controler, 'GET');
    }

    public static function post($route, $controler)
    {
        return self::getInstance()->setRoute($route, $controler, 'POST');
    }

    public static function put($route, $controler)
    {
        return self::getInstance()->setRoute($route, $controler, 'PUT');
    }
    public static function delete($route, $controler)
    {
        return self::getInstance()->setRoute($route, $controler, 'DELETE');
    }

    public static function any($route, $controler)
    {
        return self::getInstance()->setRoute($route, $controler, 'ANY');
    }

    public function name($name)
    {
        self::$routes[$this->getLastIndice()]['name'] = $name;
     
        return self::getInstance();
    }

    private function setRoute($route, $controller, $method)
    {
        self::validateRoute($route);

        $route = Group::getPrefix($route);
        $controller = Group::getController($controller);
        $controller = Group::getFolder($controller);
       
       
        self::$routes[] = [
            'controller'=> $controller,
            'route'=> $route,
            'method' =>$method,
        ];
        return self::getInstance();
    }


    /**
     * @param array $group ['prefix'=>'', 'controller'=>'', 'folder'=>'']
     * @param \Closure $closure
     */

    public static function group($group, $closure)
    {
         Group::group($group, $closure);
    }
    
  
    private static function validateRoute($route)
    {
        if (isset(self::$routes_reservard[$route])) {
            throw new \Exception("Rota reservada");
        }

        if (isset(self::$routes[$route])) {
            throw new \Exception("Rota Já registrada");
        }
    }

    public static function get_routes()
    {
        return self::$routes;
    }

    private function getLastIndice()
    {
        return  (count(self::$routes)-1);
    }

    
    private static function getInstance()
    {
        if (!self::$instance) {
             self::$instance = new Route();
        }

        return self::$instance;
    }
}
