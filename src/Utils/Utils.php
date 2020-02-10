<?php
namespace DBMOVIE\Utils;


use DBMOVIE\Repository\Manager;

class Utils
{
    /**
     * @param Manager|string $repository
     * @return array
     */
    public static function paginated($repository)
    {
        $currentPage = $_GET['p'] ?? 1;
        $limit = $_GET['nbM'] ?? 15;
        $offset = ($currentPage - 1) * $limit;
        $elements = $repository::paginatedQuery($offset, $limit);
        $nbPages = ceil(intval($repository::count()) / $limit);
        return $pagination = [
            'elements' => $elements,
            'current_page' => $currentPage,
            'nb_pages' => $nbPages,
        ];
    }
}
