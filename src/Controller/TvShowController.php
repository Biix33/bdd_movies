<?php


namespace DBMOVIE\Controller;


use DBMOVIE\Exception\NotFoundException;
use DBMOVIE\Model\TvShow;
use DBMOVIE\Repository\TvShowManager;
use DBMOVIE\Services\Viewer;
use DBMOVIE\Utils\Utils;

class TvShowController extends AbstractController
{
    const SINGLE_PAGE = 'tv_show';
    /** @var TvShowManager */
    protected static $repository = TvShowManager::class;
    /** @var TvShow */
    protected static $model = TvShow::class;

    /**
     * @return mixed|void
     */
    public function showTvShows()
    {
        $pagination = Utils::paginated(self::$repository);
        return Viewer::render('movies/index.movies', [
            'tvShows' => $pagination['elements'],
            'paginated' => $pagination
        ]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return Viewer::render('tvshows/create.tvshow');

        $tvShow = self::$model::hydrate($_POST);
        $tvShow = self::getSynopsisAndPoster($tvShow);
        $newTvShow = self::$repository::add($tvShow);
        return $this->redirectToRoute(self::SINGLE_PAGE, [
                'id' => $newTvShow
            ]);
    }

    public function tvShow(array $params)
    {
        try {
            /** @var TvShow $tvShow */
            $tvShow = self::$repository::findById($params['id']);
        } catch (NotFoundException $e) {
            http_response_code(404);
            return Viewer::render404($e->getMessage());
        }
        return Viewer::render('tvshows/show.tvshow', [
            'tvShow' => $tvShow
        ]);
    }
}