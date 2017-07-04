<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <form action="createacc.php" method="POST">
            <h2>Identifiants</h2>
            <hr>
            <label for="user">Pseudo:</label>
            <input type="text" name="user" placeholder="Username" required>
            <label for="pass">Mot de Passe:</label>
            <input type="password" name="pass" required>
            <label for="verifpass">Confirmer Mot de Passe:</label>
            <input type="password" name="verifpass" required>
            <h2>Informations</h2>
            <hr>
            <label for="lastname">Nom:</label>
            <input type="text" name="lastname">
            <label for="firstname">Prénom:</label>
            <input type="text" name="firstname" requireq>
            <label for="birthday">Date de Naissance:</label>
            <input type="date" name="birthday">
            <label for="city">Ville:</label>
            <input type="text" name="city">            
            <label for="mail">Mail:</label>
            <input type="email" name="mail" required>
            <label for="tel">Téléphone:</label>
            <input type="number" name="tel" required>
            <input type="submit" value="Valider">
        </form>
</body>
</html>
