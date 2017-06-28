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

            if($user->image == null) {
                echo "<img src='user-icon.jpg'>";
            } else {
                echo "<img src='".$user->image."'>";
            }

            echo "<h1>".$user->username."</h1>";
            echo "<h2>".$user->lastname." ".$user->firstname."</h2>";
            echo "<p>Date de naissance : ".$user->birthday."</p>";
            echo "<p>Habite : ".$user->city."</p>";
            echo "<p>Tel : ".$user->tel."</p>";
            echo "<p>Mail : ".$user->mail."</p>";
            echo "<p>Inscrit depuis le : ".$user->date."</p>";
            if($user->rating == null){
                echo "<p>Note des utilisateurs : Pas encore noté.";
            } else {
                echo "<p>Note des utilisateurs : ".$user->rating."/10</p>";
            }
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