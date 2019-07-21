<?php $title = 'Résultats de recherche'; ?>

<?php ob_start(); ?>

<?php $videosParPage = 5; ?>

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
    while ($data = $search->fetch())
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
    $search->closeCursor();
    ?>
</tbody>
</table>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
