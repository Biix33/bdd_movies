<?php $title = 'Welcome films et séries' ?>

<?php ob_start();?>
    <div id="bg-home"></div>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
