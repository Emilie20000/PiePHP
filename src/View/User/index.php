<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug</title>
</head>
<body>
    <h1>Debug</h1>
    <h2>Contenu de $_POST:</h2>
    <pre><?php print_r($_POST); ?></pre>

    <h2>Contenu de $_GET:</h2>
    <pre><?php print_r($_GET); ?></pre>

    <h2>Contenu de $_SERVER:</h2>
    <pre><?php print_r($_SERVER); ?></pre>
</body>
</html>