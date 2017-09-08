<?php
namespace DSisconeto\Ciroute;

class Route
{
    private static $routes = [
        0=> [
            'controller'=>'welcome',
            'route'=>'default_controller',
            'name'=>'index',
            'prefix' =>'',
        ],
        1=>  [
            'controller'=>'',
            'route'=>'404_override',
            'name'=>'404_override',
            'prefix' =>'',
        ],
        2=>  [
            'controller'=>false,
            'route'=>'translate_uri_dashes',
            'name'=>'',
            'prefix' =>'',
        ],

    ];

    private static $routes_reservard=[
        "default_controller"=>1,
        "404_override"=>1,
        "translate_uri_dashes" => 1,
    ];



    private function __construct()
    {
    }
    /**
     * @param string $controller
     * @param string $name
     * @param string $route
     */
    public static function set($route, $controller, $name = '')
    {
        self::validateRoute($route);

        $route = Group::getPrefix($route);
        $controller = Group::getController($controller);
        $controller = Group::getFolder($controller);
        $name = Group::getName($name);
       
        self::$routes[] = [
            'controller'=> $controller,
            'route'=> $route,
            'name'=>$name,
            'prefix' =>Group::getPrefix(),
        ];
    }


    /**
     * @param array $group ['name'=>'', 'prefix'=>'', 'controller'=>'', 'folder'=>'']
     * @param array $closure
     */

    public static function group($group, $closure)
    {
        Group::setGroup($group);
        $closure();
        Group::resetGroup($group);
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



  

    private static function validateRoute($route)
    {

        if (isset(self::$routes_reservard[$route])) {
            throw new Exception("Rota reservada");
        }

        if (isset(self::$route[$route])) {
            throw new Exception("Rota Já registrada");
        }
    }


    public static function get_routes()
    {
    
        return self::$routes;
    }
}
