<?php

namespace DBMOVIE\Router;

use DBMOVIE\Controller\MovieController;
use DBMOVIE\Controller\SearchController;
use DBMOVIE\Controller\TvShowController;
use DBMOVIE\View\View;

class Router
{
    private static $pages = [
        'home' => ['controller' => MovieController::class, 'method' => 'showHome'],
        'movies' => ['controller' => MovieController::class, 'method' => 'showMovies'],
        'tvshows' => ['controller' => TvShowController::class, 'method' => 'showTvShows'],
        'search' => ['controller' => SearchController::class, 'method' => 'find'],
    ];

    public static function renderRouter(Route $route)
    {
        if (!key_exists($route->getPage(), self::$pages)):
            http_response_code(404);
            return View::render404();
        endif;

        $controller = self::$pages[$route->getPage()]['controller'];
        $method = (empty($route->getMethod())) ? self::$pages[$route->getPage()]['method'] : $route->getMethod();

        if (!method_exists($controller, $method)):
            return http_response_code(400);
        endif;

        return $controller::$method($route->getParams());
    }
}