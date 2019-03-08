<?php

require_once 'model/MovieManager.php';
require_once 'Check.php';

function listMovies($table)
{
    $check = new Check;
    if ($check->checkTable($table)) {
        $movieManager = new MovieManager($table);
        $movies = $movieManager->getMovies();
        $nbMovies = $movieManager->count();
    }
    require 'view/frontend/movies.php';
}

function movie($table, $id)
{
    $check = new Check;
    if ($check->checkTable($table)) {
        if ($check->checkId($id)) {
            $movieManager = new MovieManager($table);
            $movie = $movieManager->getMovie($id);
        }
    }
    require 'view/frontend/movieDetails.php';
}

function addMovie($table, $title, $no_dvd)
{
    $check = new Check;
    if ($check->checkTable($table)) {
        $movieManager = new MovieManager($table);
        $affectedLines = $movieManager->addMovie($title, $no_dvd, $year, $genre, $duration, $link_allocine);
    }
    header('Location : index.php?db=' . $table . '');
}

function updateMovie($table, $id, $title, $no_dvd, $year, $genre, $duration, $link_allocine)
{
    $check = new Check;
    if ($check->checkTable($table) && $check->checkId($id)) {
        $movieManager = new MovieManager($table);
        $updateMovie = $movieManager->updateMovie($id, $title, $no_dvd, $year, $genre, $duration, $link_allocine);
    }
}

function updateMovieLink($table, $id, $link_allocine)
{
    $check = new Check;
    if ($check->checkTable($table) && $check->checkId($id)) {
        $movieManager = new MovieManager($table);
        $updateMovieLink = $movieManager->updateMovieLink($id, $link_allocine);
    }
}

function search($table, $expression)
{
    $check = new Check;
    if ($check->checkTable($table)) {
        $movieManager = new MovieManager($table);
        $search = $movieManager->searchTitle($expression);
    }
    require 'view/frontend/searchResult.php';
}
