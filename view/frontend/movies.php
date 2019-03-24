<?php $title = 'Base de données films';?>

<?php ob_start();

$videosParPage = 15;
$nbPages = ceil($nbMovies / $videosParPage);

if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0) {
    $_GET['page'] = intval($_GET['page']);
    $currentpage = $_GET['page'];
} else {
    $currentpage = 1;
}

$depart = ($currentpage - 1) * $videosParPage;

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
            <td><a href="index.php?db=<?=$_GET['db'];?>&action=movie&id=<?=$movie['id'];?>"><?=$movie['title']?></a>
            </td>
            <td style="text-align: center"><?=$movie['no_dvd']?></td>
            <td><?=$movie['year']?></td>
            <td><?=$movie['genre']?></td>
        </tr>
        <?php endforeach?>
    </tbody>
</table>

<?php for ($i = 1; $i < $nbPages; $i++): ?>
<a href="index.php?db=<?=$_GET['db']?>&page=<?=$i?>"><?=$i?></a>
<?php endfor?>

<?php $content = ob_get_clean();?>

<?php require_once 'template.php';?>