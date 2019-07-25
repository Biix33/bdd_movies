<?php


namespace DBMOVIE\Repository;


use DBMOVIE\Model\TvShow;

class TvShowManager extends Manager
{
    const TABLE = 'tvShows';
    const MODEL = TvShow::class;
}