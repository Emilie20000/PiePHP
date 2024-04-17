<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
            <div class="">
                <form action="" method="post" name="register_form" id="registerForm" class="bg-white rounded px-md-5 pt-5 pb-8 shadow">
                    <div class="">
                        <h2 class="">Inscription</h2>
                    </div>
                    <div class="">
                        <label for="lastname">Nom :</label>
                        <input class="" type="text" name="lastname" id="lastname" required>
                    </div>
                    <div class="">
                        <label for="firstname">Prénom :</label>
                        <input class="" type="text"  name="firstname" id="firstname" required>
                    </div>
                    <div class="">
                        <label for="birthdate">Date de naissance :</label>
                        <input class="" type="date" name="birthdate" id="birthdate" required>
                    </div>
                    <div class="">
                        <label for="genre">Genre :</label>
                        <select class="" name="genre" id="genre" required>
                            <option value="">Genre</option>
                            <option value="man">Homme</option>
                            <option value="woman">Femme</option>
                            <option value="other">Autre</option>
                        </select>
                    </div>
                    <div class="">
                        <label for="email">Email :</label>
                        <input class="" type="email" name="email" id="email" required>
                    </div>
                    <div class="">
                        <label for="pseudo">Choisissez un pseudo :</label>
                        <input class="" type="text" name="pseudo" id="pseudo" required>
                    </div>
                    <div class="">
                        <label for="password">Mot de passe :</label>
                        <input class="" type="password" name="password" id="password" required>
                    </div>
                    <div class="">
                        <label for="confirmPassword">Confirmez votre mot de passe :</label>
                        <input class="" type="password" name="confirm_password" id="confirmPassword" required>
                    </div>
                    <div class="">
                        <button class="" id="register">S'inscrire</button>
                    </div>
                </form>
            </div>
</body>
</html>