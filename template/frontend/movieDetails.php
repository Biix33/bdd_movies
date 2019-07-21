<?php $title = $movie->getTitle() ?>

<div class="movies col-sm-12 col-md-6 row">
    <?php if (!is_null($movie->getImageUrl())): ?>
    <div class="col-md-4">
        <img src="<?= $movie->getImageUrl() ?>" alt="" style="max-width: 100%">
    </div>
    <?php endif; ?>
    <div class="col-md-8">
        <h3><?= $movie->getTitle() ?></h3>
        <p>Dvd numéro : <?= $movie->getNoDvd() ?></p>
        <p>Année : <?= $movie->getYear() ?></p>
        <p>Genre : <?= $movie->getGenre() ?></p>
        <p>Durée : <?= $movie->getDuration() ?> minutes</p>
    </div>
    <div class="col-md-12">
        <?php if (!is_null($movie->getSynopsis())) : ?>
            <p>Synopsis : <?= $movie->getSynopsis() ?></p>
        <?php endif; ?>
        <?php if (preg_match("#^http#", $movie->getDescribeLink())): ?>
            <p>Lien descriptif : <a href="<?= $movie->getDescribeLink() ?>" target="_blank"><?= $movie->getTitle() ?>
            </p>
        <?php else: ?>
            <p>Pas encore de descriptif de disponible !</p>
        <?php endif ?>
        <a href="movies" class="btn btn-primary">Retour à la liste de films</a>
        <button type="button" name="button" id="btn-update" class="btn btn-warning">Mettre à jour</button>
    </div>
</div>
<div id="form-update" class="col-sm-12 col-md-6">
    <?php require_once '../template/includes/form-movie.php' ?>
</div>
<script type="text/javascript" src="js/display_update_form.js"></script>