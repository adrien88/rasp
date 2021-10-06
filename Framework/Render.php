<?php

namespace Frame;

class Render
{
    function __construct(array $values)
    {
        var_dump(ROUTE);
    }

    function builder(string $path)
    {
        $cwd = getcwd();
        chdir(dirname($path));
        foreach (glob('./*') as $file) {
        }
        chdir($cwd);
    }
}
