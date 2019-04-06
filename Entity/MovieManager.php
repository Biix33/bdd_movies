<?php
namespace DBMOVIE\Entity;
use DBMOVIE\Model\Movie;
use \PDO;

require_once 'Database.php';
require_once 'Model/Movie.php';

class MovieManager extends Database
{
    const TABLE = ['db_movies', 'tvShows'];

    private static function tableExist($tableToMatch)
    {
        foreach (self::TABLE as $table) {
            if ($table === $tableToMatch) {
                return true;
            }
        }
        unset($table);
        throw new Exception("No table matching");
    }

    public static function getMoviesPage($table, $min, $max)
    {
        if (self::tableExist($table)) {
            $sql = 'SELECT * FROM '.$table.' ORDER BY id LIMIT ?, ?';
        }
        $q = parent::getPDO()->prepare($sql);
        $q->bindValue(1, $min, PDO::PARAM_INT);
        $q->bindValue(2, $max, PDO::PARAM_INT);
        $q->execute();
        $data = $q->fetchAll();
        return self::map($data);
    }

    public static function count($table)
    {
        if (self::tableExist($table)) {
            $sql = "SELECT id FROM $table";
        }
        $q = parent::getPDO()->query($sql);
        return $q->rowCount();
    }

    public static function getMovie($table, $id)
    {
        if (self::tableExist($table)) {
            $sql = "SELECT * FROM $table WHERE id = ?";
        }
        $q = parent::getPDO()->prepare($sql);
        $q->bindValue(1, $id, PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $data = $q->fetch();
        return Movie::hydrate($data);
    }

    public static function addMovie($table, Movie $movie)
    {
        if (self::tableExist($table)) {
            $sql = 'INSERT INTO ' . $table . '(title, no_dvd, year, genre, duration, link_allocine) VALUES(?, ?, ?, ?, ?, ?)';
        }
        $q = parent::getPDO()->prepare($sql);
        $q->bindValue(1, $movie->getTitle(), PDO::PARAM_STR);
        $q->bindValue(2, $movie->getNoDvd(), PDO::PARAM_INT);
        $q->bindValue(3, $movie->getYear(), PDO::PARAM_INT);
        $q->bindValue(4, $movie->getDuration(), PDO::PARAM_INT);
        $q->bindValue(5, $movie->getLink(), PDO::PARAM_STR);
        return $q->execute();
    }

    public static function updateMovie($table, Movie $movie)
    {
        if (self::tableExist($table)) {
            $sql = 'UPDATE ' . $table . ' SET title = :newtitle, no_dvd = :new_no_dvd, year = :newyear, genre = :newgenre, duration = :newduration,  link_allocine = :newlink WHERE id = :movieid WHERE id = :id';
        }
        $q = parent::getPDO()->prepare($sql);
        $q->bindValue('newtitle', $movie->getTitle(), PDO::PARAM_STR);
        $q->bindValue('new_no_dvd', $movie->getNoDvd(), PDO::PARAM_INT);
        $q->bindValue('newyear', $movie->getYear(), PDO::PARAM_INT);
        $q->bindValue('newgenre', $movie->getDuration(), PDO::PARAM_INT);
        $q->bindValue('newduration', $movie->getLink(), PDO::PARAM_STR);
        $q->execute();

        if ($q === false) {
            throw new Exception('Un erreur c\'est produite lors de la mise à jour');
        }
    }

    public static function searchTitle($table, $searchWord)
    {
        if (self::tableExist($table)) {
            $sql = "SELECT id, title, no_dvd, year,  genre, duration, link_allocine FROM $table WHERE title LIKE '%'$searchWord'%' ORDER BY id DESC";
        }
        return parent::getPDO()->query($sql);
    }

    private static function map($data)
    {
        $movies = [];

        foreach ($data as $row) {
            $movies[] = Movie::hydrate($row);
        }

        return $movies;
    }
}
