<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
<?php foreach ($user as $userInfo) : ?>
        <p>User ID: <?= $userInfo['id'] ?></p>
        <p>First Name: <?= $userInfo['firstname'] ?></p>
        <p>Last Name: <?= $userInfo['lastname'] ?></p>
        <p>Email: <?= $userInfo['email'] ?></p>
       
    <?php endforeach; ?>
    <a href="<?= BASE_URI ?>/user/update/<?= $userInfo['id'] ?>">Modifier mon profile</a>
    <a href="<?= BASE_URI ?>/user/delete/<?= $userInfo['id'] ?>">Supprimer mon profil</a>

</body>
</html>