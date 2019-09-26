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