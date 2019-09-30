<?php $title = 'Résultats de recherche'; ?>
    <div class="bg-info"><p><?= count($movies) ?> film(s) trouvé(s)</p></div>
<?php
if (!empty($movies)):
    require_once '../template/movies/_table.movies.php';
endif;
?>
    <div class="bg-info"><p><?= count($tvShows) ?> série(s) trouvée(s)</p></div>
<?php
if (!empty($tvShows)):
    require_once '../template/tvshows/_tvshow.table.php';
endif;


