<?php 

include_once("user.php");


class Database {
    public function addUser($user, $pass, $lastname, $firstname, $tel, $mail, $city, $birthday, $date, $data) {
        $pass = md5($pass);
        $obj = new User($user, $pass, $lastname, $firstname, $tel, $mail, $city, $birthday, $date); 
        array_push($data, $obj);
        $encode = json_encode($data);
        unlink("users.json");
        $open = fopen("users.json", "w");
        fwrite($open, $encode);
        fclose($open);
    }

    public function createUsersFile() {
        $create = fopen("users.json", "w");
        fwrite($create, json_encode([]));
        fclose($create);
        $source = file_get_contents("users.json");
        $data = json_decode($source);
        return $data;
    }
}

$database = new Database;




?>