<?php 

include_once("user.php");
include_once("posts.php");

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

    public function userInfoProfile($user) {
        if($user->image == null) {
            echo "<img src='user-icon.jpg'>";
        } else {
            echo "<img src='".$user->image."'>";
        }

        echo "<h1>".$user->username."</h1>";
        echo "<h2>".$user->lastname." ".$user->firstname."</h2>";
        echo "<p>Date de naissance : ".$user->birthday."</p>";
        echo "<p>Habite : ".$user->city."</p>";
        echo "<p>Tel : ".$user->tel."</p>";
        echo "<p>Mail : ".$user->mail."</p>";
        echo "<p>Inscrit depuis le : ".$user->date."</p>";
        if($user->rating == null){
            echo "<p>Note des utilisateurs : Pas encore noté.";
        } else {
            echo "<p>Note des utilisateurs : ".$user->rating."/10</p>";
        }
    }

    public function createPostFolder(){
        mkdir("posts");
        $array = [];
        $array = json_encode($array);
        $people = fopen("posts/people.json","w");
        fwrite($people,$array);
        fclose($people);
        $transport = fopen("posts/transport.json","w");
        fwrite($transport,$array);
        fclose($transport);
        $housing = fopen("posts/housing.json","w");
        fwrite($housing,$array);
        fclose($housing);
    }

    public function addPost($var, $type, $data) {
        array_push($data, $var);
        $encode = json_encode($data);
        unlink("posts/".$type.".json");
        $open = fopen("posts/".$type.".json", "w");
        fwrite($open, $encode);
        fclose($open);
    }

}

$database = new Database;

?>