<?php

if(isset($_POST['user'])) {


    include_once("database.php");

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $obj = new User(
        $post['user'], $post['pass'], $post['lastname'],
        $post['firstname'], $post['tel'], $post['mail'], 
        $post['city'], $post['birthday'], date('d/m/Y')
        ); 
    $obj->username = str_replace(" ", "", $obj->username);

    function createAcc($obj, $database) {
        $return = verifErrorSQL($obj);
        if ($return['error'] == false) {
            if ($return['createfile'] != false){
            $data = $database->createUsersFile();
            }
            $database->addUserSQL($obj);
        }
    }

    function verifErrorSQL($obj) {
        $continue = true;
        $createFile = true;        
        $db = new PDO('mysql:host=localhost;dbname=mysql','kiwi','banane');

        $sql = 'SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = "SFI"';

        $req = $db->query($sql);
        if ($obj->username == "") {
        echo "Entrer un nom d'utilisateur";
        exit();
        }
         
        elseif ($req->fetch() != false) {
            $db = new PDO('mysql:host=localhost;dbname=SFI','kiwi','banane');
            
            $sql = 'SELECT * FROM user;';
            $req = $db->query($sql); 
            while($data = $req->fetch()) {
                $ver_user = htmlspecialchars($data['username']);
                if (strtolower($obj->username) == strtolower($ver_user)) {
                    echo "Ce pseudo est déjà utilisé";
                    exit();
                    $continue = false;
                }
            }
            $db = null;
            $createFile = false;
            $continue = true;
        }
        
        if ($continue == true) {
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);            
            $ver_pass = $post['verifpass'];            
            if ($obj->pass == "") {
                echo "Entrer un mot de passe";
                exit();
            } 

            elseif ($obj->pass != $ver_pass){
                echo "Les mots de passe ne correspondent pas";
                exit();
            }

            elseif (strlen($obj->tel) != 10) {
                echo "Numéro de téléphone incorrect !";
                exit();
            }

            elseif (!preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $obj->mail)) {
                echo "Email incorect";
                exit();
            } 

            else {
                $error = false;
                $return = ['error'=>$error, 'createfile'=>$createFile]; 
                return $return;
            }
        }
    }

    createAcc($obj, $database);
}

?>