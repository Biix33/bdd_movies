<?php

namespace DBMOVIE\Controller;

use DBMOVIE\Exception\NotFoundException;
use DBMOVIE\Model\Movie;
use DBMOVIE\Repository\MovieManager;
use DBMOVIE\Services\Viewer;
use DBMOVIE\Utils\api_allocine_helper\AlloHelper;
use DBMOVIE\Utils\Utils;

class MovieController extends AbstractController
{
    const SINGLE_PAGE = 'movie';
    protected static $repository = MovieManager::class;
    protected static $model = Movie::class;

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
                MovieManager::update($item);
            }
        }
        exit();
    }

    public function showHome()
    {
        return Viewer::render('home');
    }

    public function showMovies()
    {
        $pagination = Utils::paginated(self::$repository);
        return Viewer::render('movies/index.movies',
            [
                'movies' => $pagination['elements'],
                'paginated' => $pagination,
            ]);
    }

    public function movie(array $params)
    {
        try {
            $repo = self::$repository;
            /** @var Movie $movie */
            $movie = $repo::findById((int)$params['id']);
            if ($movie->getMovieCode()) {
                $movieA = $this->alloHelper->movie($movie->getMovieCode());
                if (array_key_exists('synopsis', $movieA)) {
                    $movie->setSynopsis($movieA['synopsis']);
                }
                if (array_key_exists('poster', $movieA)) {
                    $movie->setImageUrl($movieA['poster']->url());
                }
            }
        } catch (NotFoundException $e) {
            http_response_code(404);
            return Viewer::render404($e->getMessage());
        }

        return Viewer::render('movies/show.movie', [
            'movie' => $movie
        ]);
    }

    /*public function update(array $params)
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            return $this->redirectTo($this->router::getUrl('movie', ['id' => $params['id']]));
        }

        try {
            $movie = Movie::hydrate($_POST);
            if (empty($movie->getMovieCode()) || empty($movie->getDescribeLink())) {
                $movie = self::findOnAlloCine($movie);
            }
            MovieManager::updateMovie($movie);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $this->redirectTo($this->router::getUrl('movie', ['id' => $params['id']]));
    }*/

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === "GET") return Viewer::render('movies/create.movie');

        /** @var Movie $movie */
        $movie = Movie::hydrate($_POST);
        $movie = $this->findOnAlloCine($movie);
        $movieId = MovieManager::add($movie);
        return $this->redirectTo($this->router::getUrl('movie', ['id' => $movieId]));
    }
}
