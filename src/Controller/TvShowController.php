<?php


namespace DBMOVIE\Controller;


use DBMOVIE\Lib\Utils;
use DBMOVIE\Repository\TvShowManager;
use DBMOVIE\View\Viewer;

class TvShowController
{
    const TEMPLATE_PATH = '../template/frontend/';

    /**
     * @return mixed|void
     */
    public static function showTvShows()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') return Viewer::redirect('home');

        $currentPage = (!isset($_GET['p'])) ? 1 : $_GET['p'];
        $moviesPerPage = (!isset($_GET['nbM'])) ? 15 : $_GET['nbM'];
        $min = ($currentPage - 1) * $moviesPerPage;
        $tvShows = TvShowManager::getMoviesPage($min, $moviesPerPage);
        $totalTvShow = TvShowManager::count();
        $nbPage = Utils::pagination($totalTvShow, $moviesPerPage);
        return Viewer::render(self::TEMPLATE_PATH, 'movies', [
           'tvShows' => $tvShows,
           'nbPages' => $nbPage
        ]);
    }

    public static function tvshow($id)
    {
        $tvShow = TvShowManager::findMovieById($id);
        return Viewer::render(self::TEMPLATE_PATH, 'tvShow.details', ['tvShow' => $tvShow]);
    }
}