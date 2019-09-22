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
        foreach ($data as $field => $value) {
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $field)));
            $movie->$method($value);
        }
        return $movie;
    }

    public function setNoDvd($dvdNumber)
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
