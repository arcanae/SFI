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

    public function addUserSQL($user) {
        try {
            $db = new PDO('mysql:host=localhost;dbname=SFI','kiwi','banane');
            $sql = 'INSERT INTO user(username,pass,lastname,firstname,tel,mail,city,birthday,date) VALUES ("'.$user->username.'","'.md5($user->pass).'","'.$user->lastname.'","'.$user->firstname.'",'.$user->tel.',"'.$user->mail.'","'.$user->city.'","'.$user->birthday.'","'.date('d/m/Y').'");'; 
            echo $sql;
            $req = $db->exec($sql); 
            $db = null;
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
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

    public function showLastPosts(){
        $post1 = 0;
        $post2 = 0;

        $source = file_get_contents("posts/people.json");
        $source = json_decode("$source");

        foreach($source as $value) {
            if (strtotime($value->creationDate) > $post1) {
                $post2 = $post1;
                if (isset($post1cont)){
                    $post2cont = $post1cont;
                    $post2type = $post1type;
                }
                $post1 = strtotime($value->creationDate);
                $post1cont = $value;
                $post1type = "people";
            } else if(strtotime($value->creationDate) > $post2) {
                $post2 = strtotime($value->creationDate);
                $post2cont = $value;
                $post2type = "people";
            }
        }

        $source = file_get_contents("posts/transport.json");
        $source = json_decode("$source");

        foreach($source as $value) {
            if (strtotime($value->creationDate) > $post1) {
                $post2 = $post1;
                if (isset($post1cont)){
                    $post2cont = $post1cont;
                    $post2type = $post1type;                    
                }
                $post1 = strtotime($value->creationDate);
                $post1cont = $value;
                $post1type = "transport";
            } else if(strtotime($value->creationDate) > $post2) {
                $post2 = strtotime($value->creationDate);
                $post2cont = $value;
                $post2type = "transport";
            }
        }

        $source = file_get_contents("posts/housing.json");
        $source = json_decode("$source");

        foreach($source as $value) {
            if (strtotime($value->creationDate) > $post1) {
                $post2 = $post1;
                if (isset($post1cont)){
                    $post2cont = $post1cont;
                    $post2type = $post1type;
                }
                $post1 = strtotime($value->creationDate);
                $post1cont = $value;
                $post1type = "housing";
            } else if(strtotime($value->creationDate) > $post2) {
                $post2 = strtotime($value->creationDate);
                $post2cont = $value;
                $post2type = "housing";
            }
        }

        if ($post1type === "people") {
            echo '
                <article>
                    <p>Auteur : '.$post1cont->author.'</p>
                    <p>Metier/Domaine recherché : '.$post1cont->job.'
                    <p>Plages horraires : '.$post1cont->schedule[0].' - '.$post1cont->schedule[1];
                    if ($post1cont->schedule[2] != '' && $post1cont->schedule[3] != '') {
                        echo ' / '.$post1cont->schedule[2].' - '.$post1cont->schedule[3].'</p>';
                    }
            echo '
                    <p>Tarif demandé : '.$post1cont->price.'€/h</p>
                    <p>Commentaire de l\'annonceur : '.$post1cont->comment.'
                </article>
            ';
        }

        if ($post2type === "people") {
            echo '
                <article>
                    <p>Auteur : '.$post2cont->author.'</p>
                    <p>Metier/Domaine recherché : '.$post2cont->job.'
                    <p>Plages horraires : '.$post2cont->schedule[0].' - '.$post2cont->schedule[1];
                    if ($post2cont->schedule[2] != '' && $post2cont->schedule[3] != '') {
                        echo ' / '.$post2cont->schedule[2].' - '.$post2cont->schedule[3].'</p>';
                    }
            echo '
                    <p>Tarif demandé : '.$post2cont->price.'€/h</p>
                    <p>Commentaire de l\'annonceur : '.$post2cont->comment.'
                </article>
            ';
        }

        if ($post1type === "transport") {
            echo '
                <article>
                    <p>Auteur : '.$post1cont->author.'</p>
                    <p>Date : '.$post1cont->date.'
                    <h4>Trajet :</h4>
                    <p>Départ : '.$post1cont->start.' à '.$post1cont->starthour.'</p>
                    <p>Arrivé : '.$post1cont->finish.' à '.$post1cont->endhour.'</p>
                    <p>Véhicule : '.$post1cont->car.'</p>
                    <p>Nombre de places : '.$post1cont->seats.'
                    <p>Tarif demandé : '.$post1cont->price.'€</p>
                    <p>Commentaire de l\'annonceur : '.$post1cont->comment.'
                </article>
            ';
        }

        if ($post2type === "transport") {
            echo '
                <article>
                    <p>Auteur : '.$post2cont->author.'</p>
                    <p>Date : '.$post2cont->date.'
                    <h4>Trajet :</h4>
                    <p>Départ : '.$post2cont->start.' à '.$post2cont->starthour.'</p>
                    <p>Arrivé : '.$post2cont->finish.' à '.$post2cont->endhour.'</p>
                    <p>Véhicule : '.$post2cont->car.'</p>
                    <p>Nombre de places : '.$post2cont->seats.'
                    <p>Tarif demandé : '.$post2cont->price.'€</p>
                    <p>Commentaire de l\'annonceur : '.$post2cont->comment.'
                </article>
            ';
        }

        if ($post1type === "housing") {
            echo '
                <article>
                    <p>Auteur : '.$post1cont->author.'</p>
                    <p>Type de logement : '.$post1cont->housetype.'   
                    <p>Commentaire de l\'annonceur : '.$post1cont->comment.'
                    <p>Tarif demandé : '.$post1cont->price.'€/'.$post1cont->cycle.'/personne</p>
                </article>
            ';
        }

        if ($post2type === "housing") {
            echo '
                <article>
                    <p>Auteur : '.$post2cont->author.'</p>
                    <p>Type de logement : '.$post2cont->housetype.'   
                    <p>Commentaire de l\'annonceur : '.$post2cont->comment.'
                    <p>Tarif demandé : '.$post2cont->price.'€/'.$post2cont->cycle.'/personne</p>
                </article>
            ';
        }
    }
}

$database = new Database;

?>