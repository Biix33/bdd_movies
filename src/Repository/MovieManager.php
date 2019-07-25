<?php

namespace DBMOVIE\Repository;

use DBMOVIE\Model\Movie;
use \Exception;
use \PDO;


class MovieManager extends Manager
{
    const TABLE = 'db_movies';
    const MODEL = Movie::class;

    public static function add(Movie $movie)
    {
        $sql = 'INSERT INTO ' . self::TABLE . ' (title, no_dvd, year, genre, duration, link_allocine, movie_code) 
        VALUES(?, ?, ?, ?, ?, ?, ?)';
        $pdo = self::getPDO();
        $q = $pdo->prepare($sql);
        $q->bindValue(1, $movie->getTitle(), PDO::PARAM_STR);
        $q->bindValue(2, $movie->getNoDvd(), PDO::PARAM_INT);
        $q->bindValue(3, $movie->getYear(), PDO::PARAM_INT);
        $q->bindValue(4, $movie->getGenre(), PDO::PARAM_STR);
        $q->bindValue(5, $movie->getDuration(), PDO::PARAM_INT);
        $q->bindValue(6, $movie->getDescribeLink(), PDO::PARAM_STR);
        $q->bindValue(7, $movie->getCode(), PDO::PARAM_STR);
        $q->execute();
        return $pdo->lastInsertId();
    }

    public static function updateMovie(Movie $movie)
    {
        $sql = "UPDATE " . self::TABLE . " 
        SET title = :title, no_dvd = :numDvd, year = :year, genre = :genre, duration = :duration, link_allocine = :link, movie_code = :code 
        WHERE id = :id";
        $q = self::getPDO()->prepare($sql);
        $q->bindValue(':title', $movie->getTitle(), PDO::PARAM_STR);
        $q->bindValue(':numDvd', $movie->getNoDvd(), PDO::PARAM_INT);
        $q->bindValue(':year', $movie->getYear(), PDO::PARAM_INT);
        $q->bindValue(':genre', $movie->getGenre(), PDO::PARAM_STR);
        $q->bindValue(':duration', $movie->getDuration(), PDO::PARAM_INT);
        $q->bindValue(':link', $movie->getDescribeLink(), PDO::PARAM_STR);
        $q->bindValue(':code', $movie->getCode(), PDO::PARAM_STR);
        $q->bindValue(':id', $movie->getId(), PDO::PARAM_INT);
        $q->execute();

        if ($q === false) {
            throw new Exception('Un erreur c\'est produite lors de la mise à jour');
        }
    }

    public static function findMovieWithLink()
    {
        $sql = "SELECT * FROM " . self::TABLE . " WHERE link_allocine LIKE '%allocine%' AND movie_code IS NULL";
        $q = self::getPDO()->query($sql);
        $q->execute();
        $data = $q->fetchAll(PDO::FETCH_ASSOC);
        return self::map($data);
    }

    public static function findMovieWithoutLink()
    {
        $sql = "SELECT * FROM " . self::TABLE . " WHERE link_allocine NOT LIKE '%http%' LIMIT 100";
        $q = self::getPDO()->query($sql);
        $q->execute();
        $data = $q->fetchAll(PDO::FETCH_ASSOC);
        return self::map($data);
    }

    public static function findMovieWithoutLinkCodeNotNull()
    {
        $sql = "SELECT * FROM " . self::TABLE . " WHERE link_allocine NOT LIKE '%http%' AND movie_code IS NOT NULL LIMIT 100";
        $q = self::getPDO()->query($sql);
        $q->execute();
        $data = $q->fetchAll(PDO::FETCH_ASSOC);
        return self::map($data);
    }

    public static function updateCode(Movie $movie)
    {
        $sql = "UPDATE " . self::TABLE . " SET movie_code=:code WHERE id=:id";
        $q = self::getPDO()->prepare($sql);
        $q->bindValue(':code', $movie->getCode(), PDO::PARAM_STR);
        $q->bindValue(':id', $movie->getId(), PDO::PARAM_INT);
        $q->execute();
    }
}
