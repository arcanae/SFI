<?php 
    session_start();
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        if (isset($_POST['posttype'])) {
            $type = $_POST['posttype'];
        }
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
<form action="postcreation.php" method="post">
    <?php 
        if (!isset($_POST['posttype']) OR $type == 'people') {
            echo '<input type="hidden" name="type" value="people">';
            echo '<label for="job">Domaine/Metier :</label>';
            echo '<input type="text" name="job">';
            echo '<label for="firstschedule1">Horraires :</label>';
            echo '<input type="time" name="firstschedule1">';
            echo ' - <input type="time" name="firstschedule2"';
            echo '<label for="secondschedule1">Deuxieme plage horraire(optionnel) :</label>';
            echo '<input type="time" name="secondschedule1">';
            echo ' - <input type="time" name="secondschedule2"';
            echo '<label for="price">Tarif :</label>';
            echo '<input type="number" name="price">';
            echo '€/h';
            echo '<label for="comment">Ajouter un commentaire :</label>';
            echo '<textarea name="comment"></textarea>';
            echo '<input type="submit" value="Confirmer">';
        }

        if (isset($type) && $type == 'transport') {
            echo '<input type="hidden" name="type" value="transport">';
            echo '<label for="car">Type du véhicule :</label>';
            echo '<input type="text" name="car">';
            echo '<label for="seats">Nombres de places :</label>';
            echo '<input type="number" name="seats">';
            echo '<label for="date">Date :</label>';
            echo '<input type="date" name="date">';
            echo '<label for="start">Départ :</label>';
            echo '<input type="text" name="start">';
            echo '<label for="hstart">Heure de départ :</label>';
            echo '<input type="time" name="hstart">';
            echo '<label for="finish">Arrivé :</label>';
            echo '<input type="text" name="finish">';
            echo '<label for="hend">Heure d\'arrivé :</label>';
            echo '<input type="time" name="hend">';
            echo '<label for="price">Tarif :</label>';
            echo '<input type="number" name="price">';
            echo '€';
            echo '<label for="comment">Ajouter un commentaire :</label>';
            echo '<textarea name="comment"></textarea>';
            echo '<input type="submit" value="Confirmer">';
        }

        if (isset($type) && $type == 'housing') {
            echo '<input type="hidden" name="type" value="housing">';
            echo '<label for="housetype">Type de logement :</label>';
            echo '<input type="text" name="housetype">';
            echo '<label for="comment">Description du logement :</label>';
            echo '<textarea name="comment"></textarea>';
            echo '<label for="price">Tarif :</label>';
            echo '<input type="number" name="price">';
            echo '€/';
            echo '<select name="cycle">';
            echo '    <option value="jour">Jour</option>';
            echo '    <option value="nuit">Nuit</option>';
            echo '</select>';
            echo '<input type="submit" value="Confirmer">';
        }
    ?>
</form> 
<?php
    } else {
        include_once("login.php"); 
        echo "<hr></br>Vous devez être connecté pour accéder à cette page !";
    }
?>


</body>
</html>