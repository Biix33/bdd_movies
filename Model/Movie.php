<?php

namespace DBMOVIE\Model;

class Movie
{
    private $id;
    private $title;
    private $no_dvd;
    private $year = null;
    private $genre = null;
    private $duration = null;
    private $link_allocine = null;

    // public function __construct($title, $dvdNum) {
    //     $this->setTitle($title);
    //     $this->setNumDvd($dvdNum);
    // }

    public static function hydrate(array $data)
    {
        $movie = new Movie();
        $movie->setId($data['id'])
            ->setTitle($data['title'])
            ->setNumDvd($data['no_dvd'])
            ->setYear($data['year'])
            ->setGenre($data['genre'])
            ->setDuration($data['duration'])
            ->setLinkAllocine($data['link_allocine']);
        return $movie;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $id = intval($id);
        $this->id = $id;
        return $this;
    }

    public function setTitle($title)
    {
        if (empty($title)) {
            throw new InvalidArgumentExcption("Title can't be empty");
        }
        $this->title = $title;
        return $this;
    }

    public function setNumDvd($no_dvd)
    {
        $no_dvd = intval($no_dvd);
        if (empty($no_dvd)) {
            throw new InvalidArgumentExcption("Dvd num can't be empty");
        }
        $this->no_dvd = $no_dvd;
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

    public function setGenre($genre)
    {
        if (is_numeric($genre)) {
            throw new InvalidArgumentExcption("Genre cannot be null or a integer");
        }
        $this->genre = $genre;
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

    /**
     * @param null $link_allocine
     */
    public function setLinkAllocine($link_allocine)
    {
        $this->link_allocine = $link_allocine;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getNoDvd()
    {
        return $this->no_dvd;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function getLink()
    {
        return $this->link_allocine;
    }
}
