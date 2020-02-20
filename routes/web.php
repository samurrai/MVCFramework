<?php

use Klein\Klein;
/**
 * @var Klein $router
 * */

$router ->get('/', function(){
   return controller('SiteController@index');
});