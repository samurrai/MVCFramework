<?php

use Klein\Klein;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

class App
{
    public function __construct()
    {
        $this->initErrorHandler();

        $this->initRouter();
    }

    private function initRouter()
    {
        $router = new Klein();

        $routeBase = config('app.routes.base');

        $dir = path($routeBase);

        if (!file_exists($dir))
            mkdir($dir);

        $list = scandir($dir);

        $list = array_diff($list, ['.', '..']);

        foreach ($list as $file) {
            $path = path($routeBase, $file);
            $info = pathinfo($path);
            if ($info['extension'] == 'php')
                include_once $path;
        }

        $router->dispatch();
    }

    private function initErrorHandler(){
        $debug = config('app.debug') === true;

        ini_set('display_error', $debug);
        error_reporting((E_ALL ^ E_NOTICE) * $debug);

        if($debug){
            $whoops = new Run();
            $whoops->pushHandler(new PrettyPageHandler());
            $whoops->register();
        }
    }

}