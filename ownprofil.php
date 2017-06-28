<?php 
    session_start();
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }
    include_once("database.php");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
    <?php 
        if(isset($_SESSION['user'])) {
            echo "Profil de ".$user->username;
        } else {
            echo "Page de profil";
        }
    ?>
    </title>
</head>
<body>
    <?php
        if (isset($_SESSION['user'])) {
            include_once("logged.php");

            $database->userInfoProfile($user);
    ?>
    <h2>Mes annonces</h2>

    <?php 
        } else {
            include_once("login.php");
            echo "<hr></br>Vous devez être connecté pour voir ce profil !";
        }
    ?>
</body>
</html>