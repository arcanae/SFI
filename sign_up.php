<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <form action="creacompte.php" method="POST">
            <h2>Identifiants</h2>
            <hr>
            <label for="user">Pseudo:</label>
            <input type="text" name="user" placeholder="Username">
            <label for="pass">Mot de Passe:</label>
            <input type="password" name="pass">
            <label for="verifpass">Confirmer Mot de Passe:</label>
            <input type="password" name="verifpass">
            <input type="submit" value="Valider">
            <h2>Informations</h2>
            <hr>
            <label for="nom">Nom:</label>
            <input type="text" name="nom">
            <label for="prenom">Prénom:</label>
            <input type="text" name="prenom">
            <label for="age">Date de Naissance:</label>
            <input type="date" name="age">
            <label for="ville">Ville:</label>
            <input type="text" name="ville">            
            <label for="mail">Mail:</label>
            <input type="email" name="mail">
            <label for="tel">Téléphone:</label>
            <input type="number" name="tel">
        </form>
</body>
</html>
