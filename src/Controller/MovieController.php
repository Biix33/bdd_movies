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
        $movies = MovieManager::findWithoutLink();
        foreach ($movies as $movie) {
            $results = $helper->search($movie->getTitle(), 1, 10, true, ['movie']);
            if (isset($results['movie'])) {
                $movie->setCode($results['movie'][0]['code']);
                var_dump($movie);
                MovieManager::updateCode($movie);
            }
        }
        exit;

        $moviesWithCode = MovieManager::findWithoutLinkAndCodeNotNull();
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
            /** @var Movie $movie */
            $movie = self::$repository::findById((int)$params['id']);
        } catch (NotFoundException $e) {
            http_response_code(404);
            return Viewer::render404($e->getMessage());
        }

        return Viewer::render('movies/show.movie', [
            'movie' => $movie
        ]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === "GET") return Viewer::render('movies/create.movie');

        /** @var Movie $movie */
        $movie = Movie::hydrate($_POST);
        $movie = $this->getSynopsisAndPoster($movie);
        $movieId = MovieManager::add($movie);
        return $this->redirectTo($this->router::getUrl('movie', ['id' => $movieId]));
    }
}
