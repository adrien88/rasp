<?php

namespace Frame;

class Render
{
    private array $route;
    static array $config = [];

    /**
     * Construct
     */
    function __construct(string $path, array $values)
    {
        foreach ($values as $key => $value)
            $this->$key = $value;
        $this->route = explode('/', ROUTE);
        array_shift($this->route);
        $this->buildPath($path);
    }

    /**
     * Rendering
     */
    function buildPath(string $path)
    {
        $cwd = getcwd();
        chdir($path);
        if (file_exists('index.php')) {
            include 'index.php';
        }
        chdir($cwd);
    }
}
