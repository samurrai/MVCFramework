<?php

namespace Core\_Interfaces;


interface ControllerInterface
{
    public function render($template, array $vars =[]);
}