<form class="well" action="" method="post">
    <div class="form-group">
        <label for="dvd_title">Titre :</label><br>
        <input class="form-control" type="text" id="dvd_title" name="dvd_title" value="<?=$movie->getTitle()?>">
    </div>
    <div class="form-group">
        <label for="no_dvd"> Numéro Dvd :</label><br>
        <input class="form-control" type="text" id="no_dvd" name="no_dvd" value="<?=$movie->getNoDvd()?>">
    </div>
    <div class="form-group">
        <label for="year">Année :</label><br>
        <input class="form-control" type="text" id="year" name="year" value="<?=$movie->getYear()?>">
    </div>
    <div class="form-group">
        <label for="genre">Genre :</label><br>
        <input class="form-control" type="text" id="genre" name="genre" value="<?=$movie->getGenre()?>">
    </div>
    <div class="form-group">
        <label for="duration">Durée :</label><br>
        <input class="form-control" type="text" id="duration" name="duration" value="<?=$movie->getDuration()?>">
    </div>
    <div class="form-group">
        <label for="link_allocine">Lien descriptif :</label><br>
        <input class="form-control" type="text" id="link_allocine" name="link_allocine" value="<?=$movie->getLink()?>">
    </div>
    <div class="form-group">
        <input class="btn btn-default" type="submit" name="update" value="Mettre à jour">
    </div>
</form>