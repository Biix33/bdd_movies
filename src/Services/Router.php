<?php

namespace DBMOVIE\Services;

use AltoRouter;

class Router
{
    /** @var string */
    private static $basePath;

    /** @var AltoRouter */
    private static $router;

    private static $routes = [
        ['GET', '/', 'MovieController#showHome', 'home'],
        ['GET', '/movies', 'MovieController#showMovies', 'movies'],
        ['GET', '/movie/[i:id]', 'MovieController#movie', 'movie'],
        ['POST', '/update-movie/[i:id]', 'MovieController#update', 'update_movie'],
        ['GET|POST', '/add-movie', 'MovieController#create', 'add_movie'],
        ['GET', '/tv-shows', 'TvShowController#showTvShows', 'tv_shows'],
        ['GET', '/tv-show/[i:id]', 'TvShowController#tvShow', 'tv_show'],
        ['POST', '/update-tv-show/[i:id]', 'TvShowController#update', 'update_tv_show'],
        ['GET|POST', '/add-tvshow', 'TvShowController#create', 'add_tv_show'],
        ['GET', '/search', 'SearchController#find', 'search'],
    ];

    public static function renderRoute()
    {
        self::$basePath = $_SERVER['BASE_PATH'] ?? '';
        self::$router = new AltoRouter(self::$routes);
        $match = self::$router->match();

        if (!is_array($match)) {
            http_response_code(404);
            return Viewer::render404();
        }

        $controller = 'DBMOVIE\\Controller\\' . explode('#', $match["target"])[0];
        $method = explode('#', $match['target'])[1];

        $params = $match['params'] ?? null;

        return $controller::$method($params);
    }
}