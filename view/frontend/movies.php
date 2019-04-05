<?php
$title = 'Base de données films';
ob_start();
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

        <?php foreach ($movies as $movie): ?>
        <tr>
            <td><a href="index.php?db=<?=$_GET['db']?>&action=getmovie&id=<?=$movie['id']?>"><?=$movie['title']?></a>
            </td>
            <td style="text-align: center"><?=$movie['no_dvd']?></td>
            <td><?=$movie['year']?></td>
            <td><?=$movie['genre']?></td>
        </tr>
        <?php endforeach?>
    </tbody>
</table>

<ul class="pagination pagination-sm">
    <?php for ($i = 1; $i < $nbPages; $i++): ?>
    <li class="page-item">
        <a href="index.php?db=<?=$_GET['db']?>&page=<?=$i?>" class="page-link"><?=$i?></a>
    </li>
    <?php endfor?>
</ul>

<?php $content = ob_get_clean();?>

<?php require_once 'template.php';?>