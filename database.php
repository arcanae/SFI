<?php 

include_once("user.php");


class Database {
    public function addUser($user, $data) {
        $user->pass = md5($user->pass);
        array_push($data, $user);
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

    // public function userProfile() {

    // }

}

$database = new Database;

?>