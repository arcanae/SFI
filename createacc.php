<?php

if(isset($_POST['user'])) {


    include_once("database.php");


    $user = htmlspecialchars($_POST['user']);
    $user = str_replace(" ", "", $user);
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
    $error = true;
    $createFile = true;

    function createAcc($user, $pass, $ver_pass, $lastname, $firstname, $tel, $mail, $city, $birthday, $date, $error, $database, $createFile) {
        $return = verifError($user, $pass, $ver_pass, $tel, $mail, $error, $createFile);
        if ($return[0] == false) {
            if ($return[1] == true){
            $data = $database->createUsersFile();
            } else {
                $source = file_get_contents("users.json");
                $data = json_decode($source);
            }
            $database->addUser($user, $pass, $lastname, $firstname, $tel, $mail, $city, $birthday, $date, $data);
        }
    }

    function verifError($user, $pass, $ver_pass, $tel, $mail, $error, $createFile) {
        $continue = true;
        if ($user == "") {
        echo "Entrer un nom d'utilisateur";
        exit();
        } 
        
        elseif (is_file("users.json")) {
            $source = file_get_contents("users.json");
            $data = json_decode($source);
            foreach ($data as $key => $value) {
                $ver_user = htmlspecialchars($data[$key]->username);
                if (strtolower($user) == strtolower($ver_user)) {
                    echo "Ce pseudo est déjà utilisé";
                    exit();
                    $continue = false;
                }
            }
            $createFile = false;
            $continue = true;
        }
        
        if ($continue == true) {
            if ($pass == "") {
                echo "Entrer un mot de passe";
                exit();
            } 

            elseif ($pass != $ver_pass){
                echo "Les mots de passe ne correspondent pas";
                exit();
            }

            elseif (strlen($tel) != 10) {
                echo "Numéro de téléphone incorrect !";
                exit();
            }

            elseif (!preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $mail)) {
                echo "Email incorect";
                exit();
            } 

            else {
                $error = false;
                $return = [$error, $createFile]; 
                return $return;
            }
        }
    }

    createAcc($user, $pass, $ver_pass, $lastname, $firstname, $tel, $mail, $city, $birthday, $date, $error, $database, $createFile);
}

?>