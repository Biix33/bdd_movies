<?php

namespace DBMOVIE\Controller;

use DBMOVIE\Model\Model;
use DBMOVIE\Utils\Utils;
use DBMOVIE\Repository\MovieManager;
use DBMOVIE\Model\Movie;
use DBMOVIE\Services\Viewer;
use DBMOVIE\Utils\api_allocine_helper\AlloHelper;
use Exception;

class MovieController
{
    const TEMPLATE_PATH = '../template/movies/';

    public static function showHome()
    {
        return Viewer::render('home');
    }

    public static function showMovies()
    {
        $pagination = Utils::paginated(MovieManager::class);
        return Viewer::render('movies/index.movies',
            [
                'movies' => $pagination['elements'],
                'paginated' => $pagination,
            ]);
    }

    public static function movie(array $params)
    {
        /** @var Movie $movie */
        $movie = MovieManager::findMovieById((int)$params['id']);
        if ($movie->getMovieCode()) {
            $helper = new AlloHelper();
            $movieA = $helper->movie($movie->getMovieCode());
            if (array_key_exists('synopsis', $movieA)) {
                $movie->setSynopsis($movieA['synopsis']);
            }
            if (array_key_exists('poster', $movieA)) {
                $movie->setImageUrl($movieA['poster']->url());
            }
        }
        return Viewer::render('movies/show.movie', [
            'movie' => $movie
        ]);
    }

    public static function create()

    {
        if ($_SERVER['REQUEST_METHOD'] === "GET") return Viewer::render('movies/create.movie');

        /** @var Movie $movie */
        $movie = Movie::hydrate($_POST);
        $movie = self::findOnAlloCine($movie);
        $movieId = MovieManager::add($movie);
        return Viewer::redirect("movie/$movieId");
    }

    public static function update(array $params)
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") return Viewer::render('movies/create.movie');

        try {
            $movie = Movie::hydrate($_POST);
            if (empty($movie->getMovieCode()) || empty($movie->getDescribeLink())) {
                $movie = self::findOnAlloCine($movie);
            }
            MovieManager::updateMovie($movie);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return Viewer::redirect("movie/{$params['id']}");
    }

    protected static function findOnAlloCine(Model $model)
    {
        $alloHelper = new AlloHelper();

        $results = $alloHelper->search($model->getTitle(), 1, 10, true, ['movie']);
        if (isset($results['movie'])) {
            $model->setMovieCode($results['movie'][0]['code']);
        } else {
            $model->setMovieCode($_POST['movie_code']);
        }
        if (!empty($model->getMovieCode())) {
            $foundWithCode = $alloHelper->movie($model->getMovieCode());
            $model
                ->setTitle($model->getTitle())
                ->setNoDvd($model->getNoDvd())
                ->setYear($foundWithCode['productionYear'])
                ->setGenre($foundWithCode['genre'][0]['$'])
                ->setDuration($foundWithCode['runtime'] / 60)
                ->setLinkAllocine($foundWithCode['link'][0]['href'])
                ->setMovieCode($model->getMovieCode());
        }
        return $model;
    }

    /**
     * Update movie link with allocine helper
     */
    public static function findLink()
    {
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
        $helper = new AlloHelper();
        $movies = MovieManager::findMovieWithoutLink();
        foreach ($movies as $movie) {
            $results = $helper->search($movie->getTitle(), 1, 10, true, ['movie']);
            if (isset($results['movie'])) {
                $movie->setCode($results['movie'][0]['code']);
                var_dump($movie);
                MovieManager::updateCode($movie);
            }
        }
        exit;

        $moviesWithCode = MovieManager::findMovieWithoutLinkCodeNotNull();
        foreach ($moviesWithCode as $item) {
            if (!empty($item->getCode())) {
                $foundWithCode = $helper->movie($item->getCode());
                $item
                    ->setTitle($item->getTitle())
                    ->setNumDvd($item->getNoDvd())
                    ->setYear($foundWithCode['productionYear'])
                    ->setGenre($foundWithCode['genre'][0]['$'])
                    ->setDuration($foundWithCode['runtime'] / 60)
                    ->setDescribeLink($foundWithCode['link'][0]['href'])
                    ->setCode($item->getCode());
                var_dump($item);
                MovieManager::updateMovie($item);
            }
        }
        exit();
    }
}
