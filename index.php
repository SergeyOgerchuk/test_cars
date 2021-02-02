<?php

require_once 'vendor/autoload.php';

$routes = array(
    '/(carlist)(\/[0-9]+)/' => array('CarListController', 'createView'),
    '/(carlist)/' => array('CarListController', 'createView'),
    '/(admin)(\/[0-9]+)/' => array('AdminCarController', 'createView'),
    '/(admin)/' => array('AdminCarController', 'createView'),
);

foreach ($routes as $url => $action) {

    $matches = preg_match($url, $_SERVER['REQUEST_URI'], $params);

    if ($matches > 0) {

        $controller = new $action[0];
        $controller->{$action[1]}(trim($params[2], '/'));

        break;
    }
}
