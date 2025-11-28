<?php
require "Router.php";
$router = new Router();

// Define routes
$router->addRoute('/', 'ControllerHome@index');
$router->addRoute('/loginProcess', 'ControllerHome@loginProcess');
$router->addRoute('/logout', 'ControllerHome@logout');
$router->addRoute('/products', 'ControllerProduit@index');
$router->addRoute('/products/show', 'ControllerProduit@show');
$router->addRoute('/products/create', 'ControllerProduit@create');
$router->addRoute('/products/createProcess', 'ControllerProduit@createProcess');
//$router->addRoute('/products/edit/{id}', 'ControllerProduit@edit');
$router->addRoute('/products/edit', 'ControllerProduit@edit');
$router->addRoute('/products/delete', 'ControllerProduit@delete');
$router->addRoute('/products/search', 'ControllerProduit@search');

