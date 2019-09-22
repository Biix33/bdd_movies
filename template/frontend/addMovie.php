<?php $title = 'Ajouter un film' ?>

<?php ob_start(); ?>

        <div class="row">
            <div class="well col-sm-8">
               <?php require_once 'template/includes/_form.movie.php' ?>
            </div>
        </div>

<?php $content = ob_get_clean(); ?>

<?php require_once 'template.php' ?>
