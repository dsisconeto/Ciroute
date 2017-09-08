<?php

namespace DSisconeto\Ciroute;

class Group
{

    private static $group =[
        "prefix" => [],
        "folder" => [],
        "controller"  =>null,
        'name'=>[]
    ];

    public static function setGroup($group)
    {
        if (!is_array($group)) {
            return;
        }
        self::setName($group);
        self::setPrefix($group);
        self::setFolder($group);
        self::setController($group);
    }

    
    private static function verifyRoot($route)
    {
        
        return ($route == "/" || $route == "");
    }

    public static function getName($name)
    {
        if (!self::$group["name"] && $name) {
            return $name;
        } elseif (!self::$group["name"] || !$name) {
            return "";
        }

        $nameDefine = "";
        foreach (self::$group["name"] as $name_temp) {
            $nameDefine = $nameDefine ? "$nameDefine.$name_temp" : $name_temp;
        }

        return $nameDefine.".".$name;
    }


    public static function getPrefix($route = null)
    {

        if (!self::$group["prefix"] && $route) {
            return $route;
        } elseif (!self::$group["prefix"] && !$route) {
            return '';
        }

        $prefixDefine = "";
        foreach (self::$group["prefix"] as $prefix) {
            $prefixDefine = $prefixDefine ? "$prefixDefine/$prefix":$prefix;
        }


        return self::verifyRoot($route) || !$route ? $prefixDefine: $prefixDefine."/$route";
    }

    public static function getController($controller)
    {
        if (self::$group["controller"]) {
            $controller = self::$group["controller"]."/$controller";
        }
        return $controller;
    }

    public static function getFolder($controller = null)
    {
        if (!self::$group["folder"] && $controller) {
            return $controller;
        } elseif (!self::$group["folder"] && !$controller) {
            return '';
        }

        $folderDefine = "";
        foreach (self::$group["folder"] as $folder) {
            $folderDefine = $folderDefine? "$folderDefine/$folder":  $folder;
        }

        return $controller ? "$folderDefine/$controller": folderDefine;
    }


   
    public static function resetGroup($group)
    {
        self::resetPrefix($group);
        self::resetController();
        self::resetFolder($group);
        self::resetName();
    }

    private static function resetName()
    {
        if (!isset($group['name'])) {
            return;
        }
        $count = count(self::$group["name"])-1;
        if (isset(self::$group["name"][$count])) {
                unset(self::$group["name"][$count]);
        }
    }

    private static function resetPrefix($group)
    {
        if (!isset($group['prefix'])) {
            return;
        }
        $count = count(self::$group["prefix"])-1;
        if (isset(self::$group["prefix"][$count])) {
                unset(self::$group["prefix"][$count]);
        }
    }
    private static function resetFolder()
    {
        if (!isset($group['folder'])) {
            return;
        }
        $count = count(self::$group["folder"])-1;
        if (isset(self::$group["folder"][$count])) {
                unset(self::$group["folder"][$count]);
        }
    }

    
    private static function resetController()
    {
        self::$group["controller"]  = null;
    }



    private static function setName($group)
    {
        if (!isset($group["name"])) {
            return;
        }
        self::$group["name"][] = $group["name"];
    }

    private static function setPrefix($group)
    {
    
        if (!isset($group["prefix"])) {
            return;
        }
        self::$group["prefix"][] = $group["prefix"];
    }

    public static function setFolder($group)
    {
        if (!isset($group["folder"])) {
            return;
        }
            self::$group["folder"][]  = $group["folder"];
    }

    
    public static function setController($group)
    {
        if (!isset($group["controller"])) {
            return;
        }
        self::$group["controller"]  = $group["controller"];
    }
}
