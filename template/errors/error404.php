<p>404, page not found</p>
<?php if (isset($message)): ?>
    <p class="text-warning"><?= $message ?></p>
<?php endif; ?>
<a href="<?= $_SERVER["HTTP_REFERER"] ?? "/" ?>">Revenir à l'accueil</a>