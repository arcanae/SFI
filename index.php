<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Searching for it !</title>
</head>
<body>
<?php
    session_start();
 if (isset($_SESSION['user'])) {
    include_once("logged.php");
 } else {
    include_once("login.php"); 
 }
 ?>
</body>
</html>