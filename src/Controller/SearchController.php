<?php


namespace DBMOVIE\Controller;


use DBMOVIE\Repository\MovieManager;
use DBMOVIE\Repository\TvShowManager;
use DBMOVIE\View\Viewer;

class SearchController
{
    const TEMPLATE_PATH = '../template/search/';

    public static function find()
    {
        if (!isset($_GET['q'])) return Viewer::redirect('home');

        $moviesFound = MovieManager::findByTitle($_GET['q']);
        $tvShowsFound = TvShowManager::findByTitle($_GET['q']);
        return Viewer::render(self::TEMPLATE_PATH, 'search.result', [
           'movies' => $moviesFound,
           'tvShows' => $tvShowsFound
        ]);
    }
}