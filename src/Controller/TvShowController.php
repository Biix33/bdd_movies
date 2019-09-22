<?php


namespace DBMOVIE\Controller;


use DBMOVIE\Utils\Utils;
use DBMOVIE\Repository\TvShowManager;
use DBMOVIE\Services\Viewer;

class TvShowController
{
    const TEMPLATE_PATH = '../template/frontend/';

    /**
     * @return mixed|void
     */
    public static function showTvShows()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') return Viewer::redirect('home');

        $pagination = Utils::paginated(TvShowManager::class);
        return Viewer::render(self::TEMPLATE_PATH, 'movies', [
           'tvShows' => $pagination['elements'],
           'paginated' => $pagination
        ]);
    }

    public static function tvshow($id)
    {
        $tvShow = TvShowManager::findMovieById($id);
        return Viewer::render(self::TEMPLATE_PATH, 'tvShow.details', ['tvShow' => $tvShow]);
    }
}