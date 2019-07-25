<?php


namespace DBMOVIE\Controller;


use DBMOVIE\Repository\MovieManager;
use DBMOVIE\Repository\TvShowManager;
use DBMOVIE\View\View;

class SearchController
{
    const TEMPLATE_PATH = '../template/frontend/';

    public static function find()
    {
        if (!isset($_GET['q'])) return View::redirect('home');

        $moviesFound = MovieManager::findByTitle($_GET['q']);
        $tvShowsFound = TvShowManager::findByTitle($_GET['q']);
        return View::render(self::TEMPLATE_PATH, 'search.result', [
           'movies' => $moviesFound,
           'tvShows' => $tvShowsFound
        ]);
    }
}