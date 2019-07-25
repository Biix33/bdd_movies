<?php

namespace DBMOVIE\Model;

use Exception;

class Movie extends Model
{
    private $no_dvd;
    private $year = null;
    private $duration = null;

    public static function hydrate(array $data)
    {
        $movie = new Movie();
        $movie
            ->setId($data['id'])
            ->setTitle($data['title'])
            ->setNumDvd($data['no_dvd'])
            ->setYear($data['year'])
            ->setGenre($data['genre'])
            ->setDuration($data['duration'])
            ->setCode($data['movie_code'])
            ->setDescribeLink($data['link_allocine'])
            ->setUpdatedAt($data['updated_at'])
            ->setDeletedAt($data['deleted_at']);
        return $movie;
    }

    public function setNumDvd($dvdNumber)
    {
        $dvdNumber = trim(strip_tags($dvdNumber));
        $this->no_dvd = intval($dvdNumber);
        return $this;
    }

    public function setYear($year)
    {
        $year = intval($year);
        if (!is_numeric($year)) {
            throw new InvalidArgumentExcption("Year cannot be a string");
        }
        $this->year = $year;
        return $this;
    }

    public function setDuration($duration)
    {
        $duration = intval($duration);
        if (!is_numeric($duration)) {
            throw new InvalidArgumentExcption("Duration cannot be null or a string");
        }
        $this->duration = $duration;
        return $this;
    }

    public function getNoDvd()
    {
        return $this->no_dvd;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getDuration()
    {
        return $this->duration;
    }
}
