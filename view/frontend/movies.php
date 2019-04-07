<?php
$title = 'Base de données films';
ob_start();

require_once 'view/includes/table-movies.php';
require_once 'view/includes/pagination.php';

$content = ob_get_clean();

require_once 'view/template.php';