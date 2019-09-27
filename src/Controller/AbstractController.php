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
            $object = $model::hydrate($_POST);
            $object = self::findOnAlloCine($object);
            $repository = static::$repository;
            $repository::update($object);
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
        $type = $model instanceof TvShow ? 'tvserie' : 'movie';
        if (empty($model->getMovieCode())) {
            $type = ($type === 'tvserie') ? $type . 's' : $type;
            $results = $this->alloHelper->search($model->getTitle(), 1, 10, true, [$type]);
            foreach ($results[$type] as $result) {
                if (array_key_exists('title', $result)) {
                    if ($result['title'] == $model->getTitle()) {
                        $model->setMovieCode($result['code']);
                    }
                } elseif (array_key_exists('originalTitle', $result)) {
                    if ($result['originalTitle'] == $model->getTitle()) {
                        $model->setMovieCode($result['code']);
                    }
                } else {
                    $model->setMovieCode($model->getMovieCode());
                }
            }
        }
        $type = ($type === 'tvseries') ? 'tvserie' : $type;
        $results = $this->alloHelper->$type($model->getMovieCode());
        $type = ($type === 'tvserie') ? $type . 's' : $type;
        if ($type === 'tvserie' || $type === 'tvseries') {
            $model
                ->setStartYear($results[$type]['yearStart'] ?? '')
                ->setEndYear($results[$type]['yearEnd'] ?? '')
                ->setNumOfSeason($results[$type]['seasonCount'] ?? '')
                ->setSynopsis($results[$type]['synopsis'] ?? '')
                ->setImageUrl($results[$type]['poster']['href'] ?? '');
        } else {
            $model
                ->setSynopsis($results['synopsis'])
                ->setImageUrl($results['poster']->url());
        }
        return $model;
    }
}