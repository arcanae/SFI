<?php

include_once("user.php");


$user = htmlspecialchars($_POST['user']);
$user = strtolower(str_replace(" ", "", $user));
$pass = htmlspecialchars($_POST['pass']);
$ver_pass = htmlspecialchars($_POST['verifpass']);
$lastname = htmlspecialchars($_POST['lastname']);
$firstname = htmlspecialchars($_POST['firstname']);
$birthday = htmlspecialchars($_POST['birthday']);
$city = htmlspecialchars($_POST['city']);
$mail = htmlspecialchars($_POST['mail']);
$tel = htmlspecialchars($_POST['tel']);
$date = date('d/m/Y');
$wrong = false;

if (is_file("users.json")) {
    echo "yo";
    $source = file_get_contents("users.json");
    $data = json_decode($source);
    foreach ($data as $key => $value) {
        $ver_user = htmlspecialchars($data[$key]->user);
        if (strtolower($user) === $ver_user) {
            echo "Ce pseudo est déjà utilisé";
            $wrong = true;
        }
    }
} else {
    echo "nop";
    $create = fopen("users.json", "w");
    fwrite($create, json_encode([]));
    fclose($create);
    $source = file_get_contents("users.json");
    $data = json_decode($source);
}

if ($wrong === false) {
   if ($pass === "") {
        echo "Entrer un mot de passe";
   } elseif ($pass !== $ver_pass){
        echo "Les mots de passe ne correspondent pas";
   } else {
        $pass = md5($pass);
        $obj = new User($user, $pass, $lastname, $firstname, $tel, $mail, $city, $birthday, $date); 
        array_push($data, $obj);
        $encode = json_encode($data);
        unlink("users.json");
        $open = fopen("users.json", "w");
        fwrite($open, $encode);
        fclose($open);
   } 
}

?>