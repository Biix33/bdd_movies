<?php $title = 'Base de données films'; ?>

<?php ob_start(); ?>
<?php
/*$videosParPage = 15;
$nbPages = ceil($nbMovies/$videosParPage);

if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0) {
    $_GET['page'] = intval($_GET['page']);
    $currentpage = $_GET['page'];
}
else {
    $currentpage = 1;
}

$depart = ($currentpage-1)*$videosParPage;*/

?>

     <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Numéro ou Nb DVD</th>
                <th>Année ou Saisons</th>
                <th>Genre</th>
            </tr>
        </thead>
        <tbody>

            <?php
            while ($data = $movies->fetch())
            {
            ?>
                <tr>
                    <td><a href="index.php?db=<?= $_GET['db']; ?>&action=movie&id=<?= $data['id']; ?>"><?= $data['title'] ?></a></td>
                    <td style="text-align: center"><?= $data['no_dvd'] ?></td>
                    <td><?= $data['year'] ?></td>
                    <td><?= $data['genre'] ?></td>
                </tr>

            <?php
            }
            $movies->closeCursor();
            ?>
        </tbody>
    </table>
    <?= $nbMovies; ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
