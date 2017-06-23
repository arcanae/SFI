<?php

class User {
    public $username;
    public $pass;
    public $lastname;
    public $firstname;
    public $tel;
    public $mail;
    public $city;
    public $age;
    public $image;
    public $date;
    public $rating;
}

class Admin extends User {
    public $pro = "Admin";
}

?>