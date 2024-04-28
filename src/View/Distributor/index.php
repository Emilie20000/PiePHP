<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distributeurs</title>
</head>
<body>
    <h1>Liste des distributeur</h1>
    <a href="<?= BASE_URI ?>/distributor/add/">Ajouter un distributeur</a>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Pays</th>
                <th>Ajouter un film</th>
            </tr>
        </thead>
         <?php foreach ($distributors as $distributor): ?>
                <tr>
                    <td>
                    <a href="<?= BASE_URI ?>/distributor/show/<?= $distributor['id'] ?>">
                        <?php echo $distributor['name']; ?></a></p>
                    </td>
                    <td><?= $distributor['country'] ?></td>
                    <td>
                        <a href="<?= BASE_URI ?>/movie/add/<?= $distributor['id']; ?>">Ajouter un film</a>
                    </td>
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