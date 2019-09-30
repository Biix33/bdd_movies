<?php


namespace DBMOVIE\Controller;


use DBMOVIE\Exception\NotFoundException;
use DBMOVIE\Model\TvShow;
use DBMOVIE\Utils\Utils;
use DBMOVIE\Repository\TvShowManager;
use DBMOVIE\Services\Viewer;

class TvShowController extends AbstractController
{
    const SINGLE_PAGE = 'tv_show';
    protected static $repository = TvShowManager::class;
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

        $tvShow = TvShow::hydrate($_POST);
        $tvShow = self::getSynopsisAndPoster($tvShow);
        $newTvShow = self::$repository::add($tvShow);
        return $this->redirectTo($this->router::getUrl(self::SINGLE_PAGE, ['id' => $newTvShow]));
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
        return Viewer::render('tvshows/show.tvshow', ['tvShow' => $tvShow]);
    }
}