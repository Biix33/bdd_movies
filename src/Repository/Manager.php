<?php


namespace DBMOVIE\Repository;


use PDO;

abstract class Manager extends Database
{
    public static function getMoviesPage($min, $max)
    {
        $sql = 'SELECT * FROM ' . static::TABLE . ' ORDER BY id LIMIT ?, ?';
        $q = self::getPDO()->prepare($sql);
        $q->bindValue(1, $min, PDO::PARAM_INT);
        $q->bindValue(2, $max, PDO::PARAM_INT);
        $q->execute();
        $data = $q->fetchAll();
        return self::map($data);
    }

    public static function count()
    {
        $sql = "SELECT COUNT(id) AS 'count' FROM " . static::TABLE;
        $q = self::getPDO()->query($sql);
        $q->execute();
        return $q->fetch(PDO::FETCH_ASSOC);
    }

    public static function findMovieById($id)
    {
        $sql = "SELECT * FROM " . static::TABLE . " WHERE id = ?";
        $q = self::getPDO()->prepare($sql);
        $q->bindValue(1, $id, PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $data = $q->fetch();
        $model = static::MODEL;
        return $model::hydrate($data);
    }

    public static function findByTitle($searchWord)
    {
        $sql = "SELECT * FROM " . static::TABLE . " WHERE title LIKE :searchq ORDER BY title ASC";
        $q = parent::getPDO()->prepare($sql);
        $q->bindValue(':searchq', '%' . $searchWord . '%', PDO::PARAM_STR);
        $q->execute();
        $data = $q->fetchAll();
        return self::map($data);
    }

    protected static function map($data)
    {
        $movies = [];
        $model = static::MODEL;

        foreach ($data as $row) {
            $movies[] = $model::hydrate($row);
        }

        return $movies;
    }
}