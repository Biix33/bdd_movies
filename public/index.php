<?php
require dirname(__DIR__).'/config/bootstrap.php';
use DBMOVIE\Services\Route;
use DBMOVIE\Services\Router;

$route = (isset($_GET['page'])) ? new Route($_GET['page']) : new Route('home');
Router::renderRouter($route);
