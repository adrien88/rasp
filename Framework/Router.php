<?php

namespace Frame;

class Router
{

    // 'Router' => [
    // 	'homepage' => "/Page/home.html",
    // 	'controllers' => "App\\controllers\\",
    // 	'API' => [
    // 		'status' => 'open',
    // 		'slug' => 'api',
    // 		'JSRouting' => 'App/src/assets/html/JSRouting.html'
    // 	],
    // ],
    static $config;

    /**
     * 
     */
    static function route()
    {
        if ((!isset($_SERVER['PATH_INFO']) || '/' == $_SERVER['PATH_INFO']))
            $route = self::$config['homepage'];
        else
            $route =  $_SERVER['PATH_INFO'];
        $route = explode('/', substr($route, 1));
        new self($route);
    }

    /**
     *  
     */
    function __construct(array $route)
    {
        if ('open' == self::$config['API']['status']) {
            if (null != self::$config['API']['JSRouting'] && self::$config['API']['slug'] != $route[0]) {
                header('Content-Type: text/html');
                echo file_get_contents(self::$config['API']['JSRouting']);
                exit;
            } else if (self::$config['API']['slug'] == $route[0]) {
                Response::$headers['Content-Type'] = 'application/json; charset=utf-8';
                array_shift($route);
            }
        }
        self::routage($route);
    }

    /**
     * 
     */
    static function routage(&$route)
    {
        $class = self::$config['controllers'] . ($route[0] ?? '');
        $method = ($route[1] ?? '');
        if (class_exists($class, true)) {
            if (!method_exists($class, $method))
                $class::default($route);
            else
                $class::$method($route);
        } else Response::sendError();
    }
}
