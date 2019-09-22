<?php

namespace DBMOVIE\Controller;

use DBMOVIE\Utils\Utils;
use DBMOVIE\Repository\MovieManager;
use DBMOVIE\Model\Movie;
use DBMOVIE\Services\Viewer;
use DBMOVIE\Utils\api_allocine_helper\AlloHelper;
use Exception;

class MovieController
{
    const TEMPLATE_PATH = '../template/frontend/';

    public static function showHome()
    {
        return Viewer::render(self::TEMPLATE_PATH, 'home');
    }

    public static function showMovies()
    {
        $pagination = Utils::paginated(MovieManager::class);
        return Viewer::render(self::TEMPLATE_PATH, 'movies',
            [
                'movies' => $pagination['elements'],
                'paginated' => $pagination,
            ]);
    }

    public static function movie(int $id)
    {
        /** @var Movie $movie */
        $movie = MovieManager::findMovieById($id);
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
        return Viewer::render(self::TEMPLATE_PATH, 'movieDetails', [
            'movie' => $movie
        ]);
    }

    public static function create()

    {
        if ($_SERVER['REQUEST_METHOD'] === "GET") return Viewer::render(self::TEMPLATE_PATH, 'create.movie');

        $alloHelper = new AlloHelper();
        /** @var Movie $movie */
        $movie = Movie::hydrate($_POST);

        $results = $alloHelper->search($movie->getTitle(), 1, 10, true, ['movie']);
        if (isset($results['movie'])) {
            $movie->setMovieCode($results['movie'][0]['code']);
        } else {
            $movie->setMovieCode($_POST['movie_code']);
        }
        if (!empty($movie->getMovieCode())) {
            $foundWithCode = $alloHelper->movie($movie->getMovieCode());
            $movie
                ->setTitle($movie->getTitle())
                ->setNoDvd($movie->getNoDvd())
                ->setYear($foundWithCode['productionYear'])
                ->setGenre($foundWithCode['genre'][0]['$'])
                ->setDuration($foundWithCode['runtime'] / 60)
                ->setLinkAllocine($foundWithCode['link'][0]['href'])
                ->setCode($movie->getMovieCode());
        }
        $movieId = MovieManager::add($movie);
        return Viewer::redirect("movies/movie/$movieId");
    }

    public static function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== "POST") return Viewer::render(self::TEMPLATE_PATH, 'create.movie');

        try {
            $movie = Movie::hydrate($_POST);
            MovieManager::updateMovie($movie);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return Viewer::redirect("movies/movie/$id");
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
//        var_dump($moviesWithCode);
        exit();
    }

    public static function search()
    {
        if (!isset($_GET['db']) && !isset($_GET['q'])) {
            return Viewer::redirect('home');
        }
        $movies = MovieManager::findByTitle($_GET['db'], $_GET['q']);
        return Viewer::render(self::TEMPLATE_PATH, 'search.result', ['movies' => $movies]);
    }
}
