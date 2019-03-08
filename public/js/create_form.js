$elt = document.querySelector('#form-update');
$update = document.querySelector('#upd');

$update.addEventListener('click', function() {
    $elt.innerHTML = '<form class="well" action="" method="post"><div class="form-group"><label for="dvd_title">Titre :</label><br><input class="form-control" type="text" id="dvd_title" name="dvd_title"></div><div class="form-group"><label for= "no_dvd" > Numéro Dvd :</label ><br><input class="form-control" type= "text" id= "no_dvd" name= "no_dvd" ></div > <div class="form-group"><label for="year">Année :</label><br><input class="form-control" type="text" id="year" name="year"></div><div class="form-group"><label for="genre">Genre :</label><br><input class="form-control" type="text" id="genre" name="genre"></div class ="form-group"><div class="form-group"><label for="duration">Durée :</label><br><input class="form-control" type="text" id="duration" name="duration"></div><div class="form-group"><label for="link_allocine">Lien descriptif :</label><br><input class="form-control" type="text" id="link_allocine" name="link_allocine"></div><div class="form-group"><input class="btn btn-default" type="submit" name="update" value="Mettre à jour"></div></form>';

    this.style.display = 'none';
});
