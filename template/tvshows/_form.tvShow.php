<form class="well" action="<?= (isset($tvShow)) ? "/update-tv-show/" . $tvShow->getId() : "" ?>"
      method="post">
    <div class="form-group">
        <label for="title">Titre :</label><br>
        <input class="form-control" type="text" id="title" name="title"
               value="<?= (isset($tvShow)) ? $tvShow->getTitle() : "" ?>">
    </div>
    <div class="form-group">
        <label for="num_of_dvd"> Nombre de DVD :</label><br>
        <input class="form-control" type="text" id="num_of_dvd" name="num_of_dvd"
               value="<?= (isset($tvShow)) ? $tvShow->getNumOfDvd() : '' ?>" required>
    </div>
    <div class="form-group">
        <label for="start_year">Année de début :</label><br>
        <input class="form-control" type="text" id="start_year" name="start_year"
               value="<?= (isset($tvShow)) ? $tvShow->getStartYear() : '' ?>">
    </div>
    <div class="form-group">
        <label for="end_year">Année de fin :</label><br>
        <input class="form-control" type="text" id="end_year" name="end_year"
               value="<?= (isset($tvShow)) ? $tvShow->getEndYear() : '' ?>">
    </div>
    <div class="form-group">
        <label for="genre">Genre :</label><br>
        <input class="form-control" type="text" id="genre" name="genre"
               value="<?= (isset($tvShow)) ? $tvShow->getGenre() : '' ?>">
    </div>
    <div class="form-group">
        <label for="num_of_season">Nombre de saisons :</label><br>
        <input class="form-control" type="text" id="num_of_season" name="num_of_season"
               value="<?= (isset($tvShow)) ? $tvShow->getNumOfSeason() : '' ?>">
    </div>
    <div class="form-group">
        <label for="link_allocine">Lien descriptif :</label><br>
        <input class="form-control" type="text" id="link_allocine" name="link_allocine"
               value="<?= (isset($tvShow)) ? $tvShow->getDescribeLink() : '' ?>">
    </div>
    <div class="form-group">
        <label for="movie_code">Code film</label><br>
        <input class="form-control" type="text" id="movie_code" name="movie_code"
               value="<?= (isset($tvShow)) ? $tvShow->getMovieCode() : '' ?>">
    </div>
    <input type="hidden" value="<?= (isset($tvShow)) ? $tvShow->getId() : '' ?>" name="id">
    <div class="form-group">
        <button class="btn btn-default" type="submit"><?= (isset($tvShow)) ? "Mettre à jour" : "Ajouter" ?></button>
    </div>
</form>