<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie</title>
</head>
<body>
    <h1>Ajouter un film</h1>
    <form action="" method="post">
        <label for="title">Titre :</label><br>
        <input type="text" id="title" name="title" required><br>

        <label for="director">Réalisateur :</label><br>
        <input type="text" id="director" name="director" required><br>

        <label for="duration">Durée :</label><br>
        <input type="number" id="duration" name="duration"><br>

        <label for="release_date">Date de sortie :</label><br>
        <input type="date" id="release_date" name="release_date" required><br>

        <label for="rating">Age minimum :</label><br>
        <input type="text" id="rating" name="rating" required><br>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>