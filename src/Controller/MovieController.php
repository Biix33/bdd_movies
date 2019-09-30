<?php

namespace DBMOVIE\Controller;

use DBMOVIE\Exception\NotFoundException;
use DBMOVIE\Model\Movie;
use DBMOVIE\Repository\MovieManager;
use DBMOVIE\Services\Viewer;
use DBMOVIE\Utils\Utils;

class MovieController extends AbstractController
{
    const SINGLE_PAGE = 'movie';
    /** @var MovieManager */
    protected static $repository = MovieManager::class;
    /** @var Movie */
    protected static $model = Movie::class;

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
        $movie = self::getSynopsisAndPoster($movie);
        $movieId = self::$repository::add($movie);
        return $this->redirectTo($this->router::getUrl('movie', ['id' => $movieId]));
    }
}
