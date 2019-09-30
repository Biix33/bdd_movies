<?php
$title = ucwords($movie->getTitle());
?>

<div class="movies col-sm-12 col-md-6 row">
    <?php if (!is_null($movie->getImageUrl())): ?>
        <div class="col-md-4">
            <img class="img-fluid" src="<?= $movie->getImageUrl() ?>" alt="" style="max-width: 100%">
        </div>
    <?php endif; ?>
    <div class="col-md-8">
        <h3 class="text-uppercase"><?= $movie->getTitle() ?></h3>
        <ul>
            <li><span class="text-info">DVD :</span> <?= $movie->getNoDvd() ?></li>
            <li>Année : <?= $movie->getYear() ?></li>
            <li>Genre : <?= $movie->getGenre() ?></li>
            <li>Durée : <?= $movie->getDuration() ?> minutes</li>
        </ul>
    </div>
    <div class="col-md-12">
        <?php if (!is_null($movie->getSynopsis())) : ?>
            <h3 class="text-uppercase text-center">Synopsis</h3>
            <p> <?= $movie->getSynopsis() ?><span><a href="<?= $movie->getDescribeLink() ?>" target="_blank"> en savoir plus</a></span>
            </p>
        <?php elseif (preg_match("#^http#", $movie->getDescribeLink())): ?>
            <p>Lien descriptif : <a href="<?= $movie->getDescribeLink() ?>"
                                    target="_blank"><?= $movie->getTitle() ?></a>
            </p>
        <?php else: ?>
            <p>Pas encore de descriptif de disponible !</p>
        <?php endif ?>
        <a href="<?= $_SERVER['HTTP_REFERER'] ?? '/movies' ?>" class="btn btn-primary">Retour à la liste</a>
        <button type="button" name="button" id="btn-update" class="btn btn-warning">Mettre à jour</button>
    </div>
</div>
<div id="form-update" class="col-sm-12 col-md-6">
    <?php require_once '_form.movie.php' ?>
</div>
<script type="text/javascript" src="/js/display_update_form.js"></script>