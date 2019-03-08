<?php

/**
 * This class check if global variables are corrects
 */
class Check
{
    /**
     * @var array list of accesible tables
     */
    private $tables = array('db_movies', 'tvShows');

    /**
     * This method check tables for database acces
     * @param string $tableInput the table to check
     * @return boolean
     */
    public function checkTable($tableInput)
    {
        foreach ($this->tables as $table) {
            if ($table === $tableInput) {
                return true;
            }
        }
        unset($table);
        throw new Exception("No table matching");
    }

    /**
     * This method check id format
     * @param integer $id to check
     * @return boolean
     */
    public function checkId($id)
    {
        if (intval($id) > 0) {
            return true;
        } else {
            throw new Exception("ID is not correct");
        }
    }
}
