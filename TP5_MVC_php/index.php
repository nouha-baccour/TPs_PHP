<?php

require 'routing/routes.php';

//$uri = $_SERVER['REQUEST_URI'];
//$uri = str_replace('/MVC_2023','',$uri);

$uri = isset($_GET['url']) ? "/".$_GET['url'] : '/';
$router->dispatch($uri); 




/*
echo $uri; echo $_GET['code'];die();
$path_parts = pathinfo($uri);echo $path_parts['dirname']; 
$uri = str_replace('/'.$path_parts['dirname'],'',$uri); echo '     '.$uri; */