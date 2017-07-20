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
            echo "Profil de ".$user['username'];
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
            echo "<a href='createpost.php'>Ajouter une annonce</a>";
            
            echo "<h3>Personnel</h3>";
        
            if (is_dir("posts")){
                $database->showUserPosts('people', $user['username']);
            } else {
                echo '<p>L\'utilisateur n\'a pas d\'annonces dans ce domaine.';
            }
        
            echo "<h3>Transports</h3>";
        
            if (is_dir("posts")){
                $database->showUserPosts('transport', $user['username']);
            } else {
                echo '<p>L\'utilisateur n\'a pas d\'annonces dans ce domaine.';
            }
        
            echo "<h3>Logements</h3>";
        
            if (is_dir("posts")){
                $database->showUserPosts('housing', $user['username']);
            } else {
                echo '<p>L\'utilisateur n\'a pas d\'annonces dans ce domaine.';
            }  

        } else {
            include_once("login.php");
            echo "<hr></br>Vous devez être connecté pour voir ce profil !";
        }

    ?>
</body>
</html>