<form class="well" action="<?= (isset($tvShow)) ? "/tvshows/update/" . $tvShow->getId() : "/tvshows/create" ?>" method="post">
    <div class="form-group">
        <label for="dvd_title">Titre :</label><br>
        <input class="form-control" type="text" id="dvd_title" name="dvd_title"
               value="<?= (isset($tvShow)) ? $tvShow->getTitle() : "" ?>">
    </div>
    <div class="form-group">
        <label for="no_dvd"> Numéro Dvd :</label><br>
        <input class="form-control" type="text" id="no_dvd" name="no_dvd"
               value="<?= (isset($tvShow)) ? $tvShow->getNumOfDvd() : "" ?>">
    </div>
    <div class="form-group">
        <label for="year">Année :</label><br>
        <input class="form-control" type="text" id="year" name="year"
               value="<?= (isset($tvShow)) ? $tvShow->getStartYear() : "" ?>">
    </div>
    <div class="form-group">
        <label for="genre">Genre :</label><br>
        <input class="form-control" type="text" id="genre" name="genre"
               value="<?= (isset($tvShow)) ? $tvShow->getGenre() : "" ?>">
    </div>
    <div class="form-group">
        <label for="duration">Durée :</label><br>
        <input class="form-control" type="text" id="duration" name="duration"
               value="<?= (isset($tvShow)) ? $tvShow->getNumOfSeason() : "" ?>">
    </div>
    <div class="form-group">
        <label for="link_allocine">Lien descriptif :</label><br>
        <input class="form-control" type="text" id="link_allocine" name="link_allocine"
               value="<?= (isset($tvShow)) ? $tvShow->getDescribeLink() : "" ?>">
    </div>
    <div class="form-group">
        <label for="movie_code">Code film</label><br>
        <input class="form-control" type="text" id="movie_code" name="movie_code"
               value="<?= (isset($tvShow)) ? $tvShow->getMovieCode() : "" ?>">
    </div>
    <div class="form-group">
        <button class="btn btn-default" type="submit"><?= (isset($tvShow)) ? "Mettre à jour" : "Ajouter" ?></button>
    </div>
</form>