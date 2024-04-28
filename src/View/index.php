<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pie PHP</title>
    <link rel="stylesheet" type="text/css" href="<?= BASE_URI ?>/webroot/css/style.css">
   
</head>
<body>
<header class="header">
        <div class="header__menu">
            <div class="header__logo">
                <h1 class="logo__title">My cinema</h1>
            </div>
        <nav class="header__nav">
            <div id="" class="nav__items">
                    <h2 class="nav__title"><a href="<?= BASE_URI ?>/">Accueil</a></h2>
                </div>

            <div id="" class="nav__items">
                <h2 class="nav__title"><a href="<?= BASE_URI ?>/movie">Films</a></h2>
            </div>
            <div id="" class="nav__items">
                <h2 class="nav__title"><a href="<?= BASE_URI ?>/distributor">Distributeurs</a></h2>
            </div>
        </nav>
    </header>
    <?= $view ?>
   
</body>
</html>