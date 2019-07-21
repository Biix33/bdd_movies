<?php
namespace DBMOVIE\Lib;

class Utils
{
    public static function getUrl($table, $id)
    {
        if ($table === "db_movies") {
            $link = "films";
        } else if ($table === "tvShows") {
            $link = "series";
        }
        return "$link/$id";
    }
}
