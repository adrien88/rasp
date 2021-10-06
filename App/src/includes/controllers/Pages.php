<?php

namespace App\controllers;

use Frame\Render;

class Pages
{
    static function default()
    {
        new Render('App/src/includes/views', ['title' => 'MaPage']);
    }
}
