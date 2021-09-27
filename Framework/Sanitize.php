<?php

namespace Frame;

class Sanitize
{

    /**
     * Checking email format
     * 
     * @param string $email Email to check.
     * @return bool
     */
    public static function email(string $email): bool
    {

        $email = utf8_encode($email);
        if (preg_match('/^([\w.-]+\@[\w.-]+\.[\w]{2,})$/i', $email))
            return true;
        return false;
    }

    /**
     * Sanitize string
     * 
     * @param string $string String to sanitize.
     * @param string $capsule Encapsulation charactère.
     * @return string
     */
    public static function string(string $string, string $capsule = "\""): string
    {
        if (in_array($capsule, ["\"", '\'', '`'])) {
            $replace = ["\\", "$capsule"];
            $with = ["\\\\", "\\$capsule"];
            return $capsule . str_replace($replace, $with, $string) . $capsule;
        }
    }

    /**
     * Sanitize variable name
     * 
     * @param string $variablename
     * @return string
     */
    public static function variableName(string $string): string
    {
        return preg_replace('/[^\w]+/i', '', $string);
    }
}
