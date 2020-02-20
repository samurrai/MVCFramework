<?php

function dot_notations(string $dots, array $original){
    $parts = explode('.', $dots);
    foreach($parts as $part)
        $original = $original[$part] ?? null;
    return $original;
}

function path(... $parts): string{

    $path = getcwd();

    foreach($parts as $part)
        $path .= DIRECTORY_SEPARATOR . $part;

    return $path;
}

function config(string $path){
    $parts = explode('.', $path);
    $name = array_shift($parts);
    $file = path('config', "{$name}.php");

    if(!file_exists($file))
        return null;

    $cfg = include $file;

    foreach($parts as $part)
        $cfg = $cfg[$part] ?? null;

    return $cfg;
}

function view(string $name, array $vars = []){
    foreach($vars as $key => $value)
        $$key = $value;

    $basePath = str_replace('.', DIRECTORY_SEPARATOR, $name);
    $path = path(config('app.views.base'), $basePath);

    $path .= config('app.views.extensions');

    if(!file_exists($path))
        throw new Exception("$path doesn't exists");

    return include $path;
}

function controller(string $action){

    $action = explode('@', $action);
    $name = $action[0];
    $action = $action[1];

    $name = 'Controllers\\' . $name;
    $name = str_replace('/', '\\', $name);

    $controller = new $name();
    return call_user_func([$controller, $action]);

}