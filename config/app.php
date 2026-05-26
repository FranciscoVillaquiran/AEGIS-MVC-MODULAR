<?php

define('BASE_URL', '/AEGIS/public');
define('ROOT_PATH', dirname(__DIR__));

function url(string $path = ''): string
{
    return BASE_URL . $path;
}

function asset(string $path): string
{
    if (str_starts_with($path, 'http')) {
        return $path;
    }

    return BASE_URL . '/' . ltrim($path, '/');
}
