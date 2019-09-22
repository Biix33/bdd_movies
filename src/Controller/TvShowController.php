<?php


namespace DBMOVIE\Controller;


use DBMOVIE\Utils\Utils;
use DBMOVIE\Repository\TvShowManager;
use DBMOVIE\Services\Viewer;

class TvShowController extends MovieController
{
    /**
     * @return mixed|void
     */
    public static function showTvShows()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') return Viewer::redirect('home');

        $pagination = Utils::paginated(TvShowManager::class);
        return Viewer::render('movies/index.movies', [
           'tvShows' => $pagination['elements'],
           'paginated' => $pagination
        ]);
    }

    public static function tvshow($id)
    {
        $tvShow = TvShowManager::findMovieById($id);
        return Viewer::render('tvshows/show.tvshow', ['tvShow' => $tvShow]);
    }
}