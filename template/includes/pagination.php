<ul class="pagination pagination-sm">
    <li class="page-item <?= ($currentPage <= 1) ? "disabled" : "" ?>">
        <a href="movies?p=<?= $currentPage - 1 ?>" class="page-link">Précédent</a>
    </li>
    <?php for ($i = 1; $i < $nbPages; $i++): ?>
        <li class="page-item <?= ($i == $currentPage) ? "active" : "" ?>">
            <a href="movies?p=<?= $i ?>" class="page-link"><?= $i ?></a>
        </li>
    <?php endfor ?>
    <li class="page-item <?= ($currentPage == $nbPages) ? "disabled" : "" ?>">
        <a href="movies?p=<?= $currentPage + 1 ?>" class="page-link">Suivant</a>
    </li>
</ul>