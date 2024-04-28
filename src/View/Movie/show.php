<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie</title>
</head>
<body>

    <?php foreach ($movie as $film) : ?>
        <h1><?php echo $film['title']; ?></h1>
        <p><strong>Réalisateur:</strong> <?php echo $film['director']; ?></p>
        <p><strong>Durée:</strong> <?php echo $film['duration']; ?> minutes</p>
        <p><strong>Date de sortie:</strong> <?php echo $film['release_date']; ?></p>
        <p><strong>Classification:</strong> <?php echo $film['rating']; ?></p>
        <p><strong>Distributeur:</strong> <?php echo $film['name']; ?></p>

    <?php endforeach; ?>
</body>
</html>