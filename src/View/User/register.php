<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../webroot/css/style.css">
    <title>Inscription</title>
    
</head>
<body>
            <div class="">
                <form action="user/register" method="post" name="register_form" id="registerForm" class="">
                    <div class="">
                        <h2 class="">Inscription</h2>
                    </div>
                    <div class="">
                        <label for="">Prénom :</label>
                        <input class="" type="text" name="firstname" id="firstname" required>
                    </div> 
                    <div class="">
                        <label for="">Nom :</label>
                        <input class="" type="text" name="lastname" id="lastname" required>
                    </div>
                    <div class="">
                        <label for="">Date de naissance :</label>
                        <input class="" type="date" name="birthdate" id="birthdate" required>
                    </div>  
                    <div class="">
                        <label for="email">Email :</label>
                        <input class="" type="email" name="email" id="email" required>
                    </div>
                    <div class="">
                        <label for="password">Mot de passe :</label>
                        <input class="" type="password" name="password" id="password" required>
                    </div>
                    <div class="">
                        <label for="password">Confirmation du mot passe :</label>
                        <input class="" type="password" name="confirm_password" id="confirmPassword" required>
                    </div>
                    
                    <div class="">
                        <button class="" id="register">S'inscrire</button>
                    </div>
                </form>
            </div>
</body>
</html>