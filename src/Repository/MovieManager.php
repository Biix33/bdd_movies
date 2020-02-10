<?php

namespace DBMOVIE\Repository;

use DBMOVIE\Model\Movie;
use Exception;
use PDO;


class MovieManager extends Manager
{
    const TABLE = 'db_movies';
    const MODEL = Movie::class;

    public static function add(Movie $movie)
    {
        $sql = 'INSERT INTO ' . self::TABLE . ' 
        (title, no_dvd, year, genre, duration, link_allocine, movie_code, synopsis, image_url) 
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $pdo = self::getPDO();
        $q = $pdo->prepare($sql);
        $q->bindValue(1, $movie->getTitle(), $pdo::PARAM_STR);
        $q->bindValue(2, $movie->getNoDvd(), $pdo::PARAM_INT);
        $q->bindValue(3, $movie->getYear(), $pdo::PARAM_INT);
        $q->bindValue(4, $movie->getGenre(), $pdo::PARAM_STR);
        $q->bindValue(5, $movie->getDuration(), $pdo::PARAM_INT);
        $q->bindValue(6, $movie->getDescribeLink(), $pdo::PARAM_STR);
        $q->bindValue(7, $movie->getMovieCode(), $pdo::PARAM_STR);
        $q->bindValue(8, $movie->getSynopsis(), $pdo::PARAM_STR);
        $q->bindValue(9, $movie->getImageUrl(), $pdo::PARAM_STR);
        $q->execute();
        return $pdo->lastInsertId();
    }

    public static function update(Movie $movie)
    {
        $sql = "UPDATE " . self::TABLE . " SET title = :title, no_dvd = :numDvd, year = :year, genre = :genre,";
        $sql .= " duration = :duration, link_allocine = :link, movie_code = :code, synopsis = :synopsis, image_url=:image_url ";
        $sql .= " WHERE id = :id";
        $pdo = self::getPDO();
        $q = $pdo->prepare($sql);
        $q->bindValue(':title', $movie->getTitle(), $pdo::PARAM_STR);
        $q->bindValue(':numDvd', $movie->getNoDvd(), $pdo::PARAM_INT);
        $q->bindValue(':year', $movie->getYear(), $pdo::PARAM_INT);
        $q->bindValue(':genre', $movie->getGenre(), $pdo::PARAM_STR);
        $q->bindValue(':duration', $movie->getDuration(), $pdo::PARAM_INT);
        $q->bindValue(':link', $movie->getDescribeLink(), $pdo::PARAM_STR);
        $q->bindValue(':code', $movie->getMovieCode(), $pdo::PARAM_STR);
        $q->bindValue(':synopsis', $movie->getSynopsis(), $pdo::PARAM_STR);
        $q->bindValue(':image_url', $movie->getImageUrl(), $pdo::PARAM_STR);
        $q->bindValue(':id', $movie->getId(), $pdo::PARAM_INT);
        $q->execute();

        if ($q === false) {
            throw new Exception('Un erreur s\'est produite lors de la mise à jour');
        }
    }
}
