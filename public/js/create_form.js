$elt = document.querySelector('#form-update');
$update = document.querySelector('#upd');
$formUpdate = document.querySelector('#form-update');

$update.addEventListener('click', function() {
    $formUpdate.style.display = "block";
    this.style.display = 'none';
});
