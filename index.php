<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Searching for it !</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
    include_once("header.html");
    session_start();
    include_once("database.php");
    if (isset($_SESSION['user'])) {
       include_once("logged.php");
    } else {
       include_once("login.php"); 
    }

    if(is_dir("posts")) {
        $database->showLastPosts();
    } else {
        echo "Pas de nouvelles annonces.";
    }

?>    
</body>
</html>