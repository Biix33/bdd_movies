<?php

namespace DBMOVIE\Controller;

use DBMOVIE\Entity\MovieManager;
use DBMOVIE\Model\Movie;

require_once 'Entity/MovieManager.php';

class MovieController
{

    public static function getMoviesOnPage($table, $page = 1, $moviesOnPage = 15)
    {
        $min = ($page - 1) * $moviesOnPage;
        $movies = MovieManager::getMoviesPage($table, $min, $moviesOnPage);
        $nbMovies = MovieManager::count($table);
        $nbPages = ceil($nbMovies / $moviesOnPage);

        require_once 'view/frontend/movies.php';
    }

    public static function getMovie($table, int $id)
    {
        $movie = MovieManager::getMovie($table, $id);
        require_once 'view/frontend/movieDetails.php';
    }

    public static function addMovie($table, $data)
    {
        $movie = Movie::hydrate($data);
        MovieManager::addMovie($table, $title, $no_dvd);
        header("Location : index.php?db=$table");
    }

    public static function updateMovie($table, $data)
    {
        $movie = Movie::hydrate($data);
        MovieManager::updateMovie($table, $movie);
    }

    public static function search($table, $expression)
    {
        $movies = MovieManager::searchTitle($table, $expression);
        var_dump($movies);
        exit;
        require_once 'view/frontend/searchResult.php';
    }
    /*
public static function pagination($nbMovies, $nbMoviesPerPage)
{
$nbPages = ceil($nbMovies / $nbMoviesPerPage);
}
 */

}
