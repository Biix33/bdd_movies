<?php


namespace DBMOVIE\Controller;


use DBMOVIE\Model\Model;
use DBMOVIE\Model\TvShow;
use DBMOVIE\Services\Router;
use DBMOVIE\Utils\api_allocine_helper\AlloHelper;
use Exception;

abstract class AbstractController
{
    protected $alloHelper;
    protected $router = Router::class;

    public function __construct()
    {
        $this->alloHelper = new AlloHelper();
    }

    public function update(array $params)
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            return $this->redirectTo($this->router::getUrl(static::SINGLE_PAGE, ['id' => $params['id']]));
        }

        try {
            $model = static::$model;
            $movie = $model::hydrate($_POST);
            if (empty($movie->getMovieCode()) || empty($movie->getDescribeLink())) {
                $movie = self::findOnAlloCine($movie);
            }
            $repository = static::$repository;
            $repository::update($movie);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $this->redirectTo($this->router::getUrl(static::SINGLE_PAGE, ['id' => $params['id']]));
    }

    /**
     * This method redirect to URL generate from router
     * @param string $route
     * @return bool
     */
    protected function redirectTo(string $route)
    {
        if (header("Location: $route")) {
            return true;
        }
        return false;
    }

    protected function findOnAlloCine(Model $model)
    {
        $type = $model instanceof TvShow ? 'tvseries' : 'movie';
        $results = $this->alloHelper->search($model->getTitle(), 1, 10, true, [$type]);
        foreach ($results as $result) {
            if ($result['title'] == $model->getTitle() || $result['OriginalTitle'] == $model->getTitle()) {
                $model->setMovieCode($result['code']);
            } else {
                $model->setMovieCode($_POST['movie_code']);
            }
        }
        if (!empty($model->getMovieCode())) {
            $findWithCode = $this->alloHelper->movie($model->getMovieCode());
            $model
                ->setTitle($model->getTitle())
                ->setNoDvd($model->getNoDvd())
                ->setYear($findWithCode['productionYear'])
                ->setGenre($findWithCode['genre'][0]['$'])
                ->setDuration($findWithCode['runtime'] / 60)
                ->setLinkAllocine($findWithCode['link'][0]['href'])
                ->setMovieCode($model->getMovieCode());
        }
        return $model;
    }
}