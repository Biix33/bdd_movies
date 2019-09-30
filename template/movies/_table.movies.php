<table class="table table-striped table-responsive">
    <thead>
    <tr>
        <th>Titre</th>
        <th>Numéro du DVD</th>
        <th>Année</th>
        <th>Genre</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($movies as $movie): ?>
        <tr>
            <td>
                <a href="<?= '/movie/' . $movie->getId() ?>"><?= ucwords($movie->getTitle()) ?></a>
            </td>
            <td class="text-center"><?= $movie->getNoDvd() ?></td>
            <td><?= $movie->getYear() ?></td>
            <td><?= $movie->getGenre() ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>