<?php

namespace Frame;

class Response
{
    static array $headers = ['Content-Type' => 'text/html;charset=utf-8'];
    static $payload;

    /**
     * 
     */
    static function sendError(int $code = 404, string $mssg = 'Page not found', bool $die = true)
    {
        http_response_code($code);
        echo $mssg;
        if ($die) exit;
    }
}
