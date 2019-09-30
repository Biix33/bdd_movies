<?php


namespace DBMOVIE\Repository;


use DBMOVIE\Model\TvShow;

class TvShowManager extends Manager
{
    const TABLE = 'tvShows';
    const MODEL = TvShow::class;

    public static function add(TvShow $tvShow)
    {
        $sql = "INSERT INTO " . self::TABLE . " 
        (title, start_year, end_year, num_of_dvd, genre, num_of_season, link_allocine, movie_code, synopsis, image_url)
        VALUE (?,?,?,?,?,?,?,?,?,?)";
        $pdo = self::getPDO();
        $q = $pdo->prepare($sql);
        $q->bindValue(1, $tvShow->getTitle(), $pdo::PARAM_STR);
        $q->bindValue(2, $tvShow->getStartYear(), $pdo::PARAM_STR);
        $q->bindValue(3, $tvShow->getEndYear(), $pdo::PARAM_STR);
        $q->bindValue(4, $tvShow->getNumOfDvd(), $pdo::PARAM_INT);
        $q->bindValue(5, $tvShow->getGenre(), $pdo::PARAM_STR);
        $q->bindValue(6, $tvShow->getNumOfSeason(), $pdo::PARAM_INT);
        $q->bindValue(7, $tvShow->getDescribeLink(), $pdo::PARAM_STR);
        $q->bindValue(8, $tvShow->getMovieCode(), $pdo::PARAM_STR);
        $q->bindValue(9, $tvShow->getSynopsis(), $pdo::PARAM_STR);
        $q->bindValue(10, $tvShow->getImageUrl(), $pdo::PARAM_STR);
        $q->execute();
        return $pdo->lastInsertId();
    }

    public static function update(TvShow $tvShow)
    {
        $sql = "UPDATE " . self::TABLE . " SET title=:title, start_year=:start_year, end_year=:end_year,";
        $sql .= " num_of_dvd=:num_of_dvd, genre=:genre, num_of_season=:num_of_season,";
        $sql .= " link_allocine=:link, movie_code=:code, synopsis=:synopsis, image_url=:image_url";
        $sql .= " WHERE id = :id";
        $pdo = self::getPDO();
        $q = $pdo->prepare($sql);
        $q->bindValue(':id', $tvShow->getId(), $pdo::PARAM_INT);
        $q->bindValue(':title', $tvShow->getTitle(), $pdo::PARAM_STR);
        $q->bindValue(':start_year', $tvShow->getStartYear(), $pdo::PARAM_STR);
        $q->bindValue(':end_year', $tvShow->getEndYear(), $pdo::PARAM_STR);
        $q->bindValue(':num_of_dvd', $tvShow->getNumOfDvd(), $pdo::PARAM_INT);
        $q->bindValue(':genre', $tvShow->getGenre(), $pdo::PARAM_STR);
        $q->bindValue(':num_of_season', $tvShow->getNumOfSeason(), $pdo::PARAM_INT);
        $q->bindValue(':link', $tvShow->getDescribeLink(), $pdo::PARAM_STR);
        $q->bindValue(':code', $tvShow->getMovieCode(), $pdo::PARAM_STR);
        $q->bindValue(':synopsis', $tvShow->getSynopsis(), $pdo::PARAM_STR);
        $q->bindValue(':image_url', $tvShow->getImageUrl(), $pdo::PARAM_STR);
        $q->execute();
    }
}