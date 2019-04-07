<?php $title = $movie->getTitle()?>

<?php ob_start(); ?>
<div class="movies col-sm-12 col-md-6">
    <h3><?=$movie->getTitle()?></h3>
    <p>Dvd numéro : <?=$movie->getNoDvd()?></p>
    <p>Année : <?=$movie->getYear()?></p>
    <p>Genre : <?=$movie->getGenre()?></p>
    <p>Durée : <?=$movie->getDuration()?> minutes</p>
    <?php if (preg_match("#^http#", $movie->getLink())) : ?>
        <p>Lien descriptif : <a href="<?=$movie->getLink()?>" target="_blank"><?=$movie->getTitle()?></p>
    <?php else : ?>
        <p>Pas encore de descriptif de disponible !</p>';
    <?php endif ?>
    <a href="index.php?db=<?=$_GET['db'];?>" class="btn btn-primary">Retour à la liste de films</a>
    <button type="button" name="button" id="upd" class="btn btn-warning">Mettre à jour</button>
</div>
<div id="form-update" class="col-sm-12 col-md-6">
    <?php require_once 'view/includes/form-movie.php' ?>
</div>
<script type="text/javascript" src="../public/js/create_form.js"></script>

<?php $content = ob_get_clean();?>

<?php require_once 'view/template.php';?>