<?php

namespace Core\_Abstracts;

use Core\_Interfaces\ControllerInterface;

abstract class Controller implements ControllerInterface
{

    public function render($template, array $vars = [])
    {
        return view($template, $vars);
    }
}