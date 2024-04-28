<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie</title>
</head>
<body>
    <h1>Liste des films</h1>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Réalisateur</th>
                <th>Durée</th>
                <th>Date de réalisation</th>
                <th>Age minimum</th>
                <th>Détails</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movies as $movie): ?>
                <tr>
                    <td><?= $movie['title'] ?></td>
                    <td><?= $movie['director'] ?></td>
                    <td><?= $movie['duration'] ?></td>
                    <td><?= date('d-m-Y', strtotime($movie['release_date'])) ?></td>
                    <td><?= $movie['rating'] ?></td>
                    <td><a href="<?= BASE_URI ?>/movie/show/<?= $movie['id'] ?>">Détails du film</a></td>
                    <td><a href="<?= BASE_URI ?>/movie/delete/<?= $movie['id'] ?>">Supprimer un film</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if ($pagination['total_pages'] > 1): ?>
        <div>
            <?php if ($pagination['prev_page']): ?>
                <a href="?page=<?= $pagination['prev_page'] ?>">Précédent</a>
            <?php endif; ?>
            
            <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                <?php if ($i == $pagination['current_page']): ?>
                    <span><?= $i ?></span>
                <?php else: ?>
                    <a href="?page=<?= $i ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($pagination['next_page']): ?>
                <a href="?page=<?= $pagination['next_page'] ?>">Suivant</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</body>
</html>