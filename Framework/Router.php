<?php

namespace Frame;

use stdClass;

class Router
{
    static $config = [
        'namespace' => 'App\controllers\\',
        'default' => [
            'controller' => 'Pages',
            'method' => 'default',
        ]
    ];

    private array $route;

    /**
     * Get route
     */
    function __get($name)
    {
        if (isset($this->$name))
            return $this->$name;
    }

    /**
     * Automatic routing
     */
    function __construct()
    {
        $this->route = explode('/', ROUTE);
        array_shift($this->route);
        $this->apiRoutage();
        $this->routage();
    }

    /**
     * Api Routage
     */
    function apiRoutage()
    {
        if ('api' === $this->route[0]) {
            Response::$headers = ['Content-Type' => 'application/json;charset=utf-8'];
            array_shift($this->route);
        }
    }

    /**
     * Main routage
     */
    function routage()
    {
        $called = self::$config['namespace'] . $this->route[0];
        $default = self::$config['namespace'] . self::$config['default']['controller'];
        $controller = class_exists($called, true) ? $called : $default;
        $method = ($route[1] ?? self::$config['default']['method']);
        if (method_exists($controller, $method))
            $controller::$method($this->route);
    }
}
