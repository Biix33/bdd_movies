<?php


namespace DBMOVIE\Controller;


use DBMOVIE\Repository\MovieManager;
use DBMOVIE\Repository\TvShowManager;
use DBMOVIE\Services\Viewer;

class SearchController extends AbstractController
{
    public function find()
    {
        if (!isset($_GET['q'])) return $this->redirectTo($this->router::getUrl('home'));

        $moviesFound = MovieManager::findByTitle($_GET['q']);
        $tvShowsFound = TvShowManager::findByTitle($_GET['q']);
        return Viewer::render('search/search.result', [
           'movies' => $moviesFound,
           'tvShows' => $tvShowsFound
        ]);
    }
}