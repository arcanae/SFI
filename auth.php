<?php

if(isset($_POST['user'])) {

    $source = file_get_contents("users.json");
    $data = json_decode($source);
    $user = $_POST['user'];
    $user = str_replace(" ", "", $user);
    $pass = $_POST['pass'];
    $pass = md5($pass);
    $wrong = false;
    $wrong2 = false; 
    foreach ($data as $key => $value) {
       $ver_user = htmlspecialchars($data[$key]->username);
       $ver_pass = htmlspecialchars($data[$key]->pass);
       if (strtolower($user) == strtolower($ver_user)) {
            $wrong2 = true;
            if ($pass != $ver_pass) {
                echo "wrong password";
            }

            if ($pass == $ver_pass) {
                session_start();
                $_SESSION['user'] = $data[$key];
                echo "<script>";
                echo "location.href = \"index.php\"";
                echo "</script>";
            }    
       } else {
               $wrong = true;    
       }
    }

    if ($wrong == true && $wrong2 == false) {
        echo "User doesn't exist";
    }
}

?>