<?php $title = 'Erreur'; ?>

<?php ob_start(); ?>
    <p><?= $errorMessage ?></p>
    <a href="index.php">Revenir à l'accueil</a>
<?php $content = ob_get_clean(); ?>

<?php require('template/template.php'); ?>
