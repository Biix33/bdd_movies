<?php
namespace DBMOVIE\Model;

/**
 * This class check if global variables are corrects
 */
class Check
{
    /**
     * This method check id format
     * @param integer $id to check
     * @return boolean
     */
    public static function checkId($id)
    {
        if (intval($id) > 0) {
            return true;
        } else {
            throw new Exception("ID is not correct");
        }
    }
}
