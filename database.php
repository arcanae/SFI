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
            echo "<img style='width:125px;height:125px;' src='".$user->image."'>";
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

    public function showUserPosts($type,$author) {
        $source = file_get_contents('posts/'.$type.'.json');
        $source = json_decode($source);
        $empty = true;
        if ($type == 'people') {
            foreach($source as $post) {
                if ($post->author == $author) {
                    $empty = false;
                    echo '
                        <article>
                            <p>Auteur : '.$post->author.'</p>
                            <p>Metier/Domaine recherché : '.$post->job.'
                            <p>Plages horraires : '.$post->schedule[0].' - '.$post->schedule[1];
                            if ($post->schedule[2] != '' && $post->schedule[3] != '') {
                                echo ' / '.$post->schedule[2].' - '.$post->schedule[3].'</p>';
                            }
                    echo '
                            <p>Tarif demandé : '.$post->price.'€/h</p>
                            <p>Commentaire de l\'annonceur : '.$post->comment.'
                        </article>
                    ';
                }
            }
            if ($empty == true) {
                echo '<p>L\'utilisateur n\'a pas d\'annonces dans ce domaine.';
            }
        }

        if ($type == 'transport') {
            foreach($source as $post) {
                if ($post->author == $author) {
                    $empty = false;
                    echo '
                        <article>
                            <p>Auteur : '.$post->author.'</p>
                            <p>Date : '.$post->date.'
                            <h4>Trajet :</h4>
                            <p>Départ : '.$post->start.' à '.$post->starthour.'</p>
                            <p>Arrivé : '.$post->finish.' à '.$post->endhour.'</p>
                            <p>Véhicule : '.$post->car.'</p>
                            <p>Nombre de places : '.$post->seats.'
                            <p>Tarif demandé : '.$post->price.'€</p>
                            <p>Commentaire de l\'annonceur : '.$post->comment.'
                        </article>
                    ';
                }
            }
            if ($empty == true) {
                echo '<p>L\'utilisateur n\'a pas d\'annonces dans ce domaine.';
            }
        }

        if ($type == 'housing') {
            foreach($source as $post) {
                if ($post->author == $author) {
                    $empty = false;
                    echo '
                        <article>
                            <p>Auteur : '.$post->author.'</p>
                            <p>Type de logement : '.$post->housetype.'   
                            <p>Commentaire de l\'annonceur : '.$post->comment.'
                            <p>Tarif demandé : '.$post->price.'€/'.$post->cycle.'/personne</p>
                        </article>
                    ';
                }
            }
            if ($empty == true) {
                echo '<p>L\'utilisateur n\'a pas d\'annonces dans ce domaine.';
            }
        }
    }
}

$database = new Database;

?>