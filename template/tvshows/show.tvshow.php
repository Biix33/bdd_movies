<?php $title = $tvShow->getTitle() ?>
<div class="movies col-sm-12 col-md-6 row">
    <?php if (!is_null($tvShow->getImageUrl())): ?>
        <div class="col-md-4">
            <img class="img-fluid" src="<?= $tvShow->getImageUrl() ?>" alt="" style="max-width: 100%">
        </div>
    <?php endif; ?>
    <div class="col-md-8">
        <h3 class="text-uppercase"><?= $tvShow->getTitle() ?></h3>
        <ul>
            <li><span class="text-info">DVD :</span> <?= $tvShow->getNumOfDvd() ?></li>
            <li>Année de début : <?= $tvShow->getStartYear() ?></li>
            <li>Année de fin : <?= $tvShow->getEndYear() ?></li>
            <li>Genre : <?= $tvShow->getGenre() ?></li>
            <li>Saisons : <?= $tvShow->getNumOfSeason() ?></li>
        </ul>
    </div>
    <div class="col-md-12">
        <?php if (!is_null($tvShow->getSynopsis())) : ?>
            <h3 class="text-uppercase text-center">Synopsis</h3>
            <p> <?= $tvShow->getSynopsis() ?><span><a href="<?= $tvShow->getDescribeLink() ?>" target="_blank"> en savoir plus</a></span>
            </p>
        <?php elseif (preg_match("#^http#", $tvShow->getDescribeLink())): ?>
            <p>Lien descriptif : <a href="<?= $tvShow->getDescribeLink() ?>"
                                    target="_blank"><?= $tvShow->getTitle() ?></a>
            </p>
        <?php else: ?>
            <p>Pas encore de descriptif de disponible !</p>
        <?php endif ?>
        <a href="<?= $_SERVER['HTTP_REFERER'] ?? '/tv-shows' ?>" class="btn btn-primary">Retour à la liste</a>
        <button type="button" name="button" id="btn-update" class="btn btn-warning">Mettre à jour</button>
    </div>
</div>
<div id="form-update" class="col-sm-12 col-md-6">
    <?php require_once '_form.tvShow.php' ?>
</div>
<script type="text/javascript" src="/js/display_update_form.js"></script>
