<?php

class Utilisateur {
    public $pseudo;
    public $mdp;
    public $nom;
    public $prenom;
    public $tel;
    public $mail;
    public $ville;
    public $age;
    public $image;
    public $date;
    public $note;
}

class Admin extends User {
    public $titre = "Admin";
}

?>