<?php


namespace DBMOVIE\Repository;


use DBMOVIE\Exception\NotFoundException;
use DBMOVIE\Model\Model;
use PDO;

abstract class Manager extends DBConnect
{
    public static function paginatedQuery($offset, $limit)
    {
        $sql = 'SELECT * FROM ' . static::TABLE . ' ORDER BY id LIMIT ?, ?';
        $q = self::getPDO()->prepare($sql);
        $q->bindValue(1, $offset, PDO::PARAM_INT);
        $q->bindValue(2, $limit, PDO::PARAM_INT);
        $q->execute();
        $data = $q->fetchAll(PDO::FETCH_ASSOC);
        return self::map($data);
    }

    public static function count()
    {
        $sql = "SELECT COUNT(id) FROM " . static::TABLE;
        $q = self::getPDO()->query($sql);
        $q->execute();
        $count = $q->fetch(PDO::FETCH_NUM);
        return intval($count[0]);
    }

    public static function findById($id)
    {
        $sql = "SELECT * FROM " . static::TABLE . " WHERE id = ?";
        $q = self::getPDO()->prepare($sql);
        $q->bindValue(1, $id, PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $data = $q->fetch();
        if (!$data) {
            throw new NotFoundException("La ressource $id n'existe pas ou n'a pas été trouvée");
        }
        $model = static::MODEL;
        return $model::hydrate($data);
    }

    public static function findByTitle($searchWord)
    {
        $sql = "SELECT * FROM " . static::TABLE . " WHERE title LIKE :searchq ORDER BY title ASC";
        $q = parent::getPDO()->prepare($sql);
        $q->bindValue(':searchq', '%' . $searchWord . '%', PDO::PARAM_STR);
        $q->execute();
        $data = $q->fetchAll(PDO::FETCH_ASSOC);
        return self::map($data);
    }

    public static function delete(Model $model)
    {
        $sql = "DELETE FROM " . static::TABLE . " WHERE id = :id";
        $q = self::getPDO()->prepare($sql);
        $q->bindValue(':id', $model->getId(), PDO::PARAM_INT);
        $q->execute();
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