<?php
$title = 'Base de données films';

if (isset($movies)):
    require_once '../template/includes/table-movies.php';
elseif (isset($tvShows)):
    require_once '../template/includes/_tvshow.table.php';
endif;
require_once '../template/includes/pagination.php';