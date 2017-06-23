<?php

if (is_file("users.json")) {
    $source = file_get_contents("auth.json");
    $data = json_decode($source);
} else {
    $create = fopen("users.json", "w");
}

foreach ($data as $key => $value) {
        $ver_user = htmlspecialchars($data[$key]->user);
        if (strtolower($user) === $ver_user) {
            echo "This username is already taken";
            $wrong = true;
        }
     }
     if ($wrong === false) {
        if ($pass === "") {
           echo "Enter a password";
        } else {
           $pass = md5($pass);
           $obj = new class {};
           $obj->user = $user;
           $obj->password = $pass; 
           array_push($data, $obj);
           $encode = json_encode($data);
           unlink("auth.json");
           $open = fopen("auth.json", "w") or die();
           fwrite($open, $encode);
           fclose($open);
        } 
     }

?>