<?php
namespace DBMOVIE\Lib;

class Utils
{
    public static function pagination($totalElt, $eltPerPage)
    {
        $nbPages = ceil(intval($totalElt) / $eltPerPage);
        return $nbPages;
    }
}
