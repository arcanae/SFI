<?php

if(isset($_POST['user'])) {

    try {
        $db = new PDO('mysql:host=localhost;dbname=SFI','kiwi','banane');
        $sql = 'SELECT * FROM user';
        $req = $db->query($sql);

        $user = $_POST['user'];
        $user = str_replace(" ", "", $user);
        $pass = $_POST['pass'];
        $pass = md5($pass);
        $wrong = false;
        $wrong2 = false; 
        while($data = $req->fetch()) {
           $ver_user = htmlspecialchars($data['username']);
           $ver_pass = htmlspecialchars($data['pass']);
           if (strtolower($user) == strtolower($ver_user)) {
                $wrong2 = true;
                if ($pass != $ver_pass) {
                    echo "wrong password";
                }

                if ($pass == $ver_pass) {
                    session_start();
                    $_SESSION['user'] = $data;
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
    } catch(PDOException $exception) {
        echo 'Pas d\'utilisateurs crées';
    }
}

?>