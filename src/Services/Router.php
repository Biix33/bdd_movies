<?php

namespace DBMOVIE\Services;

class Router
{
    private static $basePath;

    private static $routes = [
        '/home' => ['action' => 'MovieController#showHome', 'method' => 'GET'],
        '/movies' => ['action' => 'MovieController#showMovies', 'method' => 'GET'],
        '/movie/:id' => ['action' => 'MovieController#movie', 'method' => 'GET'],
        '/update-movie/:id' => ['action' => 'MovieController#update', 'method' => 'POST'],
        '/add-movie' => ['action' => 'MovieController#create', 'method' => 'GET|POST'],
        '/tv-shows' => ['action' => 'TvShowController#showTvShows', 'method' => 'GET'],
        '/tv-show/:id' => ['action' => 'TvShowController#tvShow', 'method' => 'GET'],
        '/update-tv-show/:id' => ['action' => 'TvShowController#update', 'method' => 'POST'],
        '/add-tvshow' => ['action' => 'TvShowController#create', 'method' => 'GET|POST'],
        '/search' => ['action' => 'SearchController#find', 'method' => 'GET'],
    ];

    public static function renderRouter(Route $route)
    {
        if (!key_exists($_SERVER['REQUEST_URI'], self::$routes)) {
            http_response_code(404);
            return Viewer::render404();
        } elseif ($_SERVER['REQUEST_METHOD'] !== self::$routes[$_SERVER['REQUEST_URI']]['method']) {
            http_response_code(401);
            return Viewer::render404();
        }

        $controller = 'DBMOVIE\\Controller\\'.explode('#',self::$routes[$_SERVER['REQUEST_URI']]['action'])[0];
        $method = explode('#', self::$routes[$_SERVER['REQUEST_URI']]['action'])[1];
        $params = explode('/', $_SERVER['REQUEST_URI'])[2] ?? null;

        return $controller::$method($params);
    }

    private static function match()
    {
        self::$basePath = $_SERVER['BASE_PATH'] ?? '';

        $requestUrl = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';

        $requestUrl = substr($requestUrl, strlen(self::$basePath));

        if (($strpos = strpos($requestUrl, '?')) !== false) {
            $requestUrl = substr($requestUrl, 0, $strpos);
        }

        $match = false;

        if (key_exists($requestUrl, self::$routes)){
            $methods = explode('|', self::$routes[$requestUrl]['method']);
            $method_match = false;
            foreach ($methods as $method) {
                if (strcasecmp($_SERVER['REQUEST_METHOD'], $method) === 0) {
                    $method_match = true;
                    break;
                }
            }
        }
    }
}