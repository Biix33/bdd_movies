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
        $pagination = Utils::paginated($this->repository);
        return Viewer::render('movies/index.movies', [
            'tvShows' => $pagination['elements'],
            'paginated' => $pagination
        ]);
    }

    public function tvShow(array $params)
    {
        try {
            $repo = self::$repository;
            /** @var TvShow $tvShow */
            $tvShow = $repo::findById($params['id']);
            /*if (!$tvShow->getMovieCode()) {
                $alloResult = $this->alloHelper->search($tvShow->getTitle())['tvseries'];
                foreach ($alloResult as $result) {
                    if (
                        $result['title'] === $tvShow->getTitle() ||
                        $result['OriginalTitle'] === $tvShow->getTitle()
                    ) {
                        $tvShow->setMovieCode($result['code']);
                        $tvShow->setImageUrl($result['poster']['href']);
                    }
                }
            } else {
                $alloResult = $this->alloHelper->tvserie($tvShow->getMovieCode());
                if ($alloResult && key_exists('synopsis', $alloResult)){
                    $tvShow->setImageUrl($alloResult['poster']->url());
                    $tvShow->setSynopsis($alloResult['synopsis']);
                }
            }*/
        } catch (NotFoundException $e) {
            http_response_code(404);
            return Viewer::render404($e->getMessage());
        }
        return Viewer::render('tvshows/show.tvshow', ['tvShow' => $tvShow]);
    }
}