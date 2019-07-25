<?php


namespace DBMOVIE\Model;


class TvShow extends Model
{
    /** @var string $startYear */
    private $startYear;

    /** @var string $endYear */
    private $endYear;

    /** @var int $numOfDvd */
    private $numOfDvd;

    /** @var int $numOfSeason */
    private $numOfSeason;

    public static function hydrate($data)
    {
        $tvShow = new TvShow();
        $tvShow
            ->setId($data['id'])
            ->setTitle($data['title'])
            ->setStartYear($data['start_year'])
            ->setEndYear($data['end_year'])
            ->setNumOfDvd($data['num_of_dvd'])
            ->setGenre($data['genre'])
            ->setNumOfSeason($data['num_of_season'])
            ->setDescribeLink($data['describe_link'])
            ->setCode($data['allocine_code'])
            ->setUpdatedAt($data['updated_at'])
            ->setDeletedAt($data['deleted_at']);
        return $tvShow;
    }

    /**
     * @return string
     */
    public function getStartYear(): string
    {
        return $this->startYear;
    }

    /**
     * @param string|null $startYear
     * @return TvShow
     */
    public function setStartYear(?string $startYear): TvShow
    {
        $this->startYear = $startYear;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEndYear(): ?string
    {
        return $this->endYear;
    }

    /**
     * @param string|null $endYear
     * @return TvShow
     */
    public function setEndYear(?string $endYear): TvShow
    {
        $this->endYear = $endYear;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumOfDvd(): int
    {
        return $this->numOfDvd;
    }

    /**
     * @param int $numOfDvd
     * @return TvShow
     */
    public function setNumOfDvd(int $numOfDvd): TvShow
    {
        $this->numOfDvd = $numOfDvd;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumOfSeason(): ?string
    {
        return $this->numOfSeason;
    }

    /**
     * @param int|string $numOfSeason
     * @return TvShow
     */
    public function setNumOfSeason($numOfSeason): TvShow
    {
        $this->numOfSeason = $numOfSeason;
        return $this;
    }
}