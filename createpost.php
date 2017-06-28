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
            echo '<label for="job">Domaine/Metier :</label>';
            echo '<input type="text" name="job">';
            echo '<label for="schedule">Horraires :</label>';
            echo '<input type="text" name="schedule">';
            echo '<label for="price">Tarif :</label>';
            echo '<input type="number" name="price">';
            echo '€/h';
            echo '<label for="comment">Ajouter un commentaire :</label>';
            echo '<textarea name="comment"></textarea>';
            echo '<input type="submit" value="Confirmer">';
        }

        if (isset($type) && $type == 'transport') {
            echo '<label for="car">Type du véhicule :</label>';
            echo '<input type="text" name="car">';
            echo '<label for="depart">Départ :</label>';
            echo '<input type="text" name="depart">';
            echo '<label for="hdep">Heure de départ :</label>';
            echo '<input type="text" name="hdep">';
            echo '<label for="arrive">Arrivé :</label>';
            echo '<input type="text" name="arrive">';
            echo '<label for="harr">Heure d\'arrivé :</label>';
            echo '<input type="text" name="harr">';
            echo '<label for="price">Tarif :</label>';
            echo '<input type="number" name="price">';
            echo '€';
            echo '<label for="comment">Ajouter un commentaire :</label>';
            echo '<textarea name="comment"></textarea>';
            echo '<input type="submit" value="Confirmer">';
        }

        if (isset($type) && $type == 'housing') {
            echo '<label for="typehouse">Type de logement :</label>';
            echo '<input type="text" name="typehouse">';
            echo '<label for="comment">Description du logement :</label>';
            echo '<textarea name="comment"></textarea>';
            echo '<label for="price">Tarif :</label>';
            echo '<input type="number" name="price">';
            echo '/';
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