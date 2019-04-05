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

    public function setTitle($title) {
        if (empty($title) || empty($dvdNum)) {
            throw new InvalidArgumentExcption("Title or dvd num can't be empty");
        }
        $this->title = $title;
    }

    public function setNumDvd($no_dvd) {
        if (empty($no_dvd)) {
            throw new InvalidArgumentExcption("Title or dvd num can't be empty");
        }
        $this->no_dvd = $no_dvd;
    }

    public function setYear($year) {
        if (empty($year) || !is_numeric($year)) {
            throw new InvalidArgumentExcption("Year cannot be null or a string");
        }
        $this->year = $year;
    }

    public function setGenre($genre) {
        if (empty($genre) || !is_numeric($genre)) {
            throw new InvalidArgumentExcption("Genre cannot be null or a string");
        }
        $this->genre = $genre;
    }

    public function setDuration($duration) {
        if (empty($duration) || !is_numeric($duration)) {
            throw new InvalidArgumentExcption("Duration cannot be null or a string");
        }
        $this->duration = $duration;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getNoDvd() {
        return $this->no_dvd;
    }

    public function getYear() {
        return $this->year;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function getDuration() {
        return $this->duration;
    }

    public function getLink() {
        return $this->link_allocine;
    }
}
