<?php 
    session_start();
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Créer une annonce</title>
</head>
<body>
<?php
    session_start();
    if (isset($_SESSION['user'])) {
        include_once("logged.php");
?>
<form action="" method="post">
    <label for="posttype">Choisissez un type d'annonce:</label>
    <select name="posttype">
        <option value="people">Personnel</option>
        <option value="transport">Transport</option>
        <option value="housing">Logement</option>
    </select>
    <input type="submit" value="ok">
</form>
<form action="postcreation" method="post">
        
</form> 
<?php
    } else {
        include_once("login.php"); 
        echo "<hr></br>Vous devez être connecté pour accéder à cette page !";
    }
?>


</body>
</html>