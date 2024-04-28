<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distributeur</title>
</head>
<body>
    <?php foreach ($distributor['main'] as $distributorDetails) : ?>
            <h2><?php echo $distributorDetails['name']; ?></h2>
            <p><strong>Pays:</strong> <?php echo $distributorDetails['country']; ?></p>
        <?php endforeach; ?>
    <h2>Films Associés</h2>
    <table>
        <tr>
            <th>Titre</th>
            <th>Réalisateur</th>
            <th>Durée</th>
            <th>Date de sortie</th>
            <th>Classification</th>
        </tr>
        <?php foreach ($distributor['relation'] as $film) : ?>
            <tr>
                <td>
                <a href="<?= BASE_URI ?>/movie/show/<?php echo $film['id']; ?>">
                            <?php echo $film['title']; ?>
                    </a>
                </td>
                <td><?php echo $film['director']; ?></td>
                <td><td><?php echo $film['duration']; ?> minutes</td></td>
                <td><?= date('d-m-Y', strtotime($film['release_date'])) ?></td>
                <td><?php echo $film['rating']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>