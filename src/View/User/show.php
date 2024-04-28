<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
<?php foreach ($user as $userInfo) : ?>
        <p><strong>Prénom : </strong> <?= $userInfo['firstname'] ?></p>
        <p><strong>Nom : </strong> <?= $userInfo['lastname'] ?></p>
        <p><strong>Email : </strong> <?= $userInfo['email'] ?></p>
        <p><strong>Anniversaire : </strong> <?= date('d-m-Y', strtotime($userInfo['birthdate'])) ?></ ?></p>
       
    <?php endforeach; ?>
    <a href="<?= BASE_URI ?>/user/update/<?= $userInfo['id'] ?>">Modifier mon profile</a>
    <a href="<?= BASE_URI ?>/user/delete/<?= $userInfo['id'] ?>">Supprimer mon profil</a>
    <a href="<?= BASE_URI ?>/user/logout/<?= $userInfo['id'] ?>">Déconnexion</a>

</body>
</html>