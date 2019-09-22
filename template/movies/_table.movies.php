<table class="table table-striped table-responsive">
    <thead>
    <tr>
        <th>Titre</th>
        <th>Numéro ou Nb DVD</th>
        <th>Année ou Saisons</th>
        <th>Genre</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($movies as $movie): ?>
        <tr>
            <td>
                <a href="/movies/movie/<?= $movie->getId()?>"><?= $movie->getTitle() ?></a>
            </td>
            <td style="text-align: center"><?= $movie->getNoDvd() ?></td>
            <td><?= $movie->getYear() ?></td>
            <td><?= $movie->getGenre() ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>