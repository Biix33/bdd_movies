<?php $title = 'Base de donnée films';?>

<?php ob_start();

$data = $movie->fetch();
?>
        <div class="movies col-sm-8">
            <h3><?=$data['title']?></h3>
            <p>Dvd numéro : <?=$data['no_dvd']?></p>
            <p>Année : <?=$data['year']?></p>
            <p>Genre : <?=$data['genre']?></p>
            <p>Durée : <?=$data['duration']?> minutes</p>
            <?php
if (preg_match("#^http#", $data['link_allocine'])) {
    ?>
            <p>Lien descriptif : <a href="<?=$data['link_allocine']?>" target="_blank"><?=$data['title']?></p>
            <?php
} else {
    echo '<p>Pas encore de descriptif de disponible !</p>';
}
?>
            <a href="index.php?db=<?=$_GET['db'];?>" class="btn btn-primary">Retour à la liste de films</a>
            <button type="button" name="button" id="upd" class="btn btn-warning">Mettre à jour</button>
        </div>
        <div id="form-update" class="col-sm-8"></div>
        <script type="text/javascript" src="../public/js/create_form.js"></script>
    <?php
$movie->closeCursor();
?>
    <?php $content = ob_get_clean();?>

    <?php require 'template.php';?>
