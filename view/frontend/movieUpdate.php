<?php $title = 'Modification données films'; ?>

<?php ob_start(); ?>

    <?php
    $data = $movie->fetch();
    ?>
        <div class="movies">
            <div class="well col-sm-8">
                <h3 class="title"><?= $data['title'] ?></h3>
                <p>Dvd numéro : <?= $data['no_dvd'] ?></p>
                <p>Année : <?= $data['year'] ?></p>
                <p>Genre : <?= $data['genre'] ?></p>
                <p>Durée : <?= $data['duration'] ?> minutes</p>
                <?php
                if (preg_match("#^http#", $data['link_allocine'])) {
                ?>
                <p>Lien descriptif : <a href="<?= $data['link_allocine'] ?>" target="_blank"><?= $data['title'] ?></p>
                <?php
                }
                else {
                    echo '<p>Pas encore de descriptif de disponible !</p>';
                }
                ?>

                <a href="index.php?a=<?= $_GET['a']; ?>"  class="btn btn-primary btn-block">Retour à la liste de films</a><br>
            </div>

            <div class="row">
                <section class="col-sm-8">
                    <form class="well" action="" method="post">
                        <div class="form-group">
                            <label for="dvd_title">Titre :</label><br>
                            <input class="form-control" type="text" id="dvd_title" name="dvd_title">
                        </div>
                        <div class="form-group">
                            <label for="no_dvd">Numéro Dvd :</label><br>
                            <input class="form-control" type="text" id="no_dvd" name="no_dvd">
                        </div>
                        <div class="form-group">
                            <label for="year">Année :</label><br>
                            <input class="form-control" type="text" id="year" name="year">
                        </div>
                        <div class="form-group">
                            <label for="genre">Genre :</label><br>
                            <input class="form-control" type="text" id="genre" name="genre">
                        </div class="form-group">
                        <div class="form-group">
                            <label for="duration">Durée :</label><br>
                            <input class="form-control" type="text" id="duration" name="duration">
                        </div>
                        <div class="form-group">
                            <label for="link_allocine">Lien descriptif :</label><br>
                            <input class="form-control" type="text" id="link_allocine" name="link_allocine">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-default" type="submit" name="update" value="Mettre à jour">
                        </div>
                    </form>
                </section>
            </div>

        </div>
    <?php
    $movie->closeCursor();
    ?>
    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?>
