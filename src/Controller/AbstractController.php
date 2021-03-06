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

    /** @var Router */
    protected $router = Router::class;

    public function __construct()
    {
        $this->alloHelper = new AlloHelper();
    }

    /**
     * @param array $params
     * @return bool
     */
    public function update(array $params)
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            return $this->redirectToRoute($this->router::getUrl(static::SINGLE_PAGE, ['id' => $params['id']]));
        }

        try {
            $object = static::$model::hydrate($_POST);
            $object = self::getSynopsisAndPoster($object);
            static::$repository::update($object);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $this->redirectToRoute(static::SINGLE_PAGE, ['id' => $params['id']]);
    }

    /**
     * This method redirect to URL generate from router
     * @param string $routeName
     * @param array $params
     * @return bool
     */
    protected function redirectToRoute(string $routeName, array $params = [])
    {
        $url = $this->router::getUrl($routeName, $params);
        if (header("Location: $url")) {
            return true;
        }
        return false;
    }

    protected function getSynopsisAndPoster(Model $model)
    {
        try {
            $type = $model instanceof TvShow ? 'tvseries' : 'movie';
            if (empty($model->getMovieCode())) {
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
                    ->setImageUrl($results[$type]['poster']['href'] ?? '')
                    ->setLinkAllocine('http://www.allocine.fr/series/ficheserie_gen_cserie=' . $model->getMovieCode() . '.html')
                    ->setGenre($results[$type]['genre'][0]['$'] ?? '');
            } else {
                $model
                    ->setGenre($results['genre'][0]['$'] ?? '')
                    ->setDuration($results['runtime'] / 60 ?? '')
                    ->setLinkAllocine($results['link'][0]['href'] ?? '')
                    ->setYear($results['productionYear'] ?? '')
                    ->setSynopsis($results['synopsis'] ?? '')
                    ->setImageUrl($results['poster']->url());
            }
        } catch (\ErrorException $e) {
            echo $e->getMessage();
        }
        return $model;
    }
}