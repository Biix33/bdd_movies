<?php
require dirname(__DIR__) . '/vendor/autoload.php';

use DBMOVIE\Router\Route;
use DBMOVIE\Router\Router;

$route = (isset($_GET['page'])) ? new Route($_GET['page']) : new Route('home');
Router::renderRouter($route);
