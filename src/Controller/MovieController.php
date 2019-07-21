<?php

namespace DBMOVIE\Controller;

use DBMOVIE\Repository\MovieManager;
use DBMOVIE\Model\Movie;
use DBMOVIE\View\View;
use DBMOVIE\Lib\api_allocine_helper\AlloHelper;
use Exception;

class MovieController
{
    const TEMPLATE_PATH = '../template/frontend/';

    public static function showHome()
    {
        return View::render(self::TEMPLATE_PATH, 'home');
    }

    public static function showMovies()
    {
        $p = (!isset($_GET['p'])) ? 1 : $_GET['p'];
        $moviesOnPage = (!isset($_GET['nbM'])) ? 15 : $_GET['nbM'];
        $min = ($p - 1) * $moviesOnPage;
        $movies = MovieManager::getMoviesPage($min, $moviesOnPage);
        $nbMovies = MovieManager::count();
        $nbPages = ceil(intval($nbMovies['count']) / $moviesOnPage);
        /*$movies = MovieManager::findMovieWithLink();
        $nbPages = 1;
        foreach ($movies as $movie) {
            $split1 = explode('=', $movie->getDescribeLink());
            $split2 = explode('.', $split1[1]);
            $code = $split2[0];
            $movie->setCode($code);
            MovieManager::updateCode($movie);
            var_dump($movie);
        }
        exit;*/

        return View::render(self::TEMPLATE_PATH, 'movies', ['movies' => $movies, 'nbPages' => $nbPages]);
    }

    public static function movie(int $id)
    {
        $movie = MovieManager::findMovieById($id);
        if ($movie->getCode()) {
            $helper = new AlloHelper();
            $movieA = $helper->movie($movie->getCode());
            if (array_key_exists('synopsis', $movieA)) {
                $movie->setSynopsis($movieA['synopsis']);
            }
            if (array_key_exists('poster', $movieA)) {
                $movie->setImageUrl($movieA['poster']->url());
            }
        }
        return View::render(self::TEMPLATE_PATH, 'movieDetails', [
            'movie' => $movie
        ]);
    }

    public static function create()
    {
        $movie = new Movie();
        $movie
            ->setTitle($_POST['dvd_title'])
            ->setNumDvd($_POST['no_dvd'])
            ->setYear($_POST['year'])
            ->setGenre($_POST['genre'])
            ->setDuration($_POST['duration'])
            ->setDescribeLink($_POST['link_allocine']);
        MovieManager::add($movie);
        return View::redirect("movies");
    }

    public static function update($id)
    {
        try {
            $movie = new Movie();
            $movie
                ->setId($id)
                ->setTitle($_POST['dvd_title'])
                ->setNumDvd($_POST['no_dvd'])
                ->setYear($_POST['year'])
                ->setGenre($_POST['genre'])
                ->setDuration($_POST['duration'])
                ->setCode($_POST['movie_code'])
                ->setDescribeLink($_POST['link_allocine']);
            MovieManager::updateMovie($movie);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return View::redirect("/movies/movie/$id");
    }

    public static function search($table, $expression)
    {
        $movies = MovieManager::searchTitle($table, $expression);
        var_dump($movies);
        exit;
        require_once 'template/frontend/searchResult.php';
    }
    /*
public static function pagination($nbMovies, $nbMoviesPerPage)
{
$nbPages = ceil($nbMovies / $nbMoviesPerPage);
}
 */

}
