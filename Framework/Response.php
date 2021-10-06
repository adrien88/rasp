<?php

namespace Frame;

class Response
{

    /**
     * Return content
     */
    public array $headers = ['Content-Type' => 'text/html;charset=utf-8'];
    public $payload;

    /**
     * 
     */
    function send()
    {
        foreach ($this->headers as $key => $value)
            header("$key: $value", true);
        echo $this;
    }

    /**
     * 
     */
    function __toString()
    {
        if (strpos($this->headers['Content-Type'], '/json') !== false) {
            echo json_encode($this->payload, JSON_PRETTY_PRINT);
        }
    }

    /**
     * 
     */
    function sendError(int $code = 404, string $mssg = 'Page not found', bool $die = true)
    {
        http_response_code($code);
        echo $mssg;
        if ($die) exit;
    }
}
