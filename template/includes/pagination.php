<ul class="pagination pagination-sm">
    <?php for ($i = 1; $i < $nbPages; $i++): ?>
        <li class="page-item">
            <a href="movies?p=<?=$i?>" class="page-link"><?=$i?></a>
        </li>
    <?php endfor?>
</ul>