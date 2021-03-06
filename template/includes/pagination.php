<ul class="pagination pagination-sm">
    <li class="page-item <?= ($paginated['current_page'] <= 1) ? "disabled" : "" ?>">
        <a href="<?= isset($movies) ? 'movies' : 'tv-shows' ?>?p=<?= $paginated['current_page'] - 1 ?>"
           class="page-link">Précédent</a>
    </li>
    <?php for ($i = 1; $i <= $paginated['nb_pages']; $i++): ?>
        <li class="page-item <?= ($i == $paginated['current_page']) ? "active" : "" ?>">
            <a href="<?= isset($movies) ? 'movies' : 'tv-shows' ?>?p=<?= $i ?>" class="page-link"><?= $i ?></a>
        </li>
    <?php endfor ?>
    <li class="page-item <?= ($paginated['current_page'] == $paginated['nb_pages']) ? "disabled" : "" ?>">
        <a href="<?= isset($movies) ? 'movies' : 'tv-shows' ?>?p=<?= $paginated['current_page'] + 1 ?>"
           class="page-link">Suivant</a>
    </li>
</ul>