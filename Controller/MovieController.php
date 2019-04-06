<?php
namespace DBMOVIE\Controller;
use DBMOVIE\Entity\MovieManager;

require_once 'Entity/MovieManager.php';

class MovieController {

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

    public static function addMovie($table, $title, $no_dvd)
    {
        MovieManager::addMovie($table, $title, $no_dvd);
        header("Location : index.php?db=$table");
    }
/*
    public static function updateMovie($table, $id, $title, $no_dvd, $year, $genre, $duration, $link_allocine)
    {
        if (Check::checkTable($table) && Check::checkId($id)) {
            $movieManager = new MovieManager($table);
            $updateMovie = $movieManager->updateMovie($id, $title, $no_dvd, $year, $genre, $duration, $link_allocine);
        }
    }

    public static function updateMovieLink($table, $id, $link_allocine)
    {
        if (Check::checkTable($table) && Check::checkId($id)) {
            $movieManager = new MovieManager($table);
            $updateMovieLink = $movieManager->updateMovieLink($id, $link_allocine);
        }
    }

    public static function search($table, $expression)
    {
        if (Check::checkTable($table)) {
            $movieManager = new MovieManager($table);
            $search = $movieManager->searchTitle($expression);
        }
        require_once 'view/frontend/searchResult.php';
    }

    public static function pagination($nbMovies, $nbMoviesPerPage)
    {
        $nbPages = ceil($nbMovies / $nbMoviesPerPage);
    }
*/

}
