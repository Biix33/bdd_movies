<?php

require_once 'model/MovieManager.php';
require_once 'Check.php';

function getMovies($table)
{
    if (Check::checkTable($table)) {
        $movieManager = new MovieManager($table);
        $movies = $movieManager->getMovies();
        $nbMovies = $movieManager->count();
    }
    require_once 'view/frontend/movies.php';
}

function getMovie($table, $id)
{
    if (Check::checkTable($table)) {
        if (Check::checkId($id)) {
            $movieManager = new MovieManager($table);
            $movie = $movieManager->getMovie($id);
        }
    }
    require_once 'view/frontend/movieDetails.php';
}

function addMovie($table, $title, $no_dvd)
{
    if (Check::checkTable($table)) {
        $movieManager = new MovieManager($table);
        $affectedLines = $movieManager->addMovie($title, $no_dvd);
    }
    header('Location : index.php?db=' . $table . '');
}

function updateMovie($table, $id, $title, $no_dvd, $year, $genre, $duration, $link_allocine)
{
    if (Check::checkTable($table) && Check::checkId($id)) {
        $movieManager = new MovieManager($table);
        $updateMovie = $movieManager->updateMovie($id, $title, $no_dvd, $year, $genre, $duration, $link_allocine);
    }
}

function updateMovieLink($table, $id, $link_allocine)
{
    if (Check::checkTable($table) && Check::checkId($id)) {
        $movieManager = new MovieManager($table);
        $updateMovieLink = $movieManager->updateMovieLink($id, $link_allocine);
    }
}

function search($table, $expression)
{
    if (Check::checkTable($table)) {
        $movieManager = new MovieManager($table);
        $search = $movieManager->searchTitle($expression);
    }
    require_once 'view/frontend/searchResult.php';
}

function pagination($nbMovies, $nbMoviesPerPage)
{
    $nbPages = ceil($nbMovies/$nbMoviesPerPage);

    
}