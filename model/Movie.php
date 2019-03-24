<?php

class Movie
{
    private $_title;
    private $_dvdNum;
    private $year = null;
    private $genre = null;
    private $duration = null;
    private $link = null;

    public function __construct($title, $dvdNum) {
        if (empty($title) || empty($dvdNum)) {
            throw new InvalidArgumentExcption("Title or dvd num can't be empty");
        }
        $this->_title = $title;
        $this->_dvdNum = $dvdNum;
    }

    public function setYear($year) {
        if (empty($year) || !is_numeric($year)) {
            throw new InvalidArgumentExcption("Year cannot be null or a string");
        }
        $this->_year = $year;
    }

    public function setGenre($genre) {
        if (empty($genre) || !is_numeric($genre)) {
            throw new InvalidArgumentExcption("Genre cannot be null or a string");
        }
        $this->_genre = $genre;
    }

    public function setDuration($duration) {
        if (empty($duration) || !is_numeric($duration)) {
            throw new InvalidArgumentExcption("Duration cannot be null or a string");
        }
        $this->_duration = $duration;
    }

    public function getTitle() {
        return $this->_title;
    }
}
