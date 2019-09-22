<table class="table table-striped table-responsive">
    <thead>
    <tr>
        <th>Titre</th>
        <th>Genre</th>
        <th>Année de début</th>
        <th>Année de fin</th>
        <th>Nombre de DVD</th>
        <th>Nombre de saisons</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($tvShows as $tvShow): ?>
        <tr>
            <td>
                <a href="/tvshows/tvshow/<?= $tvShow->getId()?>"><?= $tvShow->getTitle() ?></a>
            </td>
            <td><?= $tvShow->getGenre() ?></td>
            <td><?= $tvShow->getStartYear() ?></td>
            <td><?= $tvShow->getEndYear() ?></td>
            <td class="text-center"><?= $tvShow->getNumOfDvd() ?></td>
            <td class="text-center"><?= $tvShow->getNumOfSeason() ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>