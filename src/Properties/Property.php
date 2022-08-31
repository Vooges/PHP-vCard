<?php

namespace JesseVooges\PHPvCard\Properties;

class Property
{
    protected function unescape(string $string): string
    {
        return str_replace('\\n', PHP_EOL, $string);
    }

    /**
     * Adds newline characters every 75 characters to follow RFC 6350, section 3.2
     */
    protected function fold(string $string): string
    {
        return implode("\r\n", str_split($string, 75));
    }
}