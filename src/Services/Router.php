<?php

namespace DBMOVIE\Services;

use DBMOVIE\Controller\MovieController;
use DBMOVIE\Controller\SearchController;
use DBMOVIE\Controller\TvShowController;

class Router
{
    private static $routes = [
        'home' => ['controller' => MovieController::class, 'method' => 'showHome'],
        'movies' => ['controller' => MovieController::class, 'method' => 'showMovies'],
        'tvshows' => ['controller' => TvShowController::class, 'method' => 'showTvShows'],
        'search' => ['controller' => SearchController::class, 'method' => 'find'],
    ];

    public static function renderRouter(Route $route)
    {
        if (!key_exists($route->getPage(), self::$routes)):
            http_response_code(404);
            return Viewer::render404();
        endif;

        $controller = self::$routes[$route->getPage()]['controller'];
        $method = (empty($route->getMethod())) ? self::$routes[$route->getPage()]['method'] : $route->getMethod();

        if (!method_exists($controller, $method)):
            return http_response_code(401);
        endif;

        return $controller::$method($route->getParams());
    }
}