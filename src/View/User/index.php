<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach ($user as $userInfo) : ?>
        <h1>Bienvenue <?= $userInfo['firstname'] ?></h1>
    <?php endforeach; ?>
    <a href="<?= BASE_URI ?>/user/show/<?= $userInfo['id'] ?>">Voir mon profil</a>
</body>
</html>