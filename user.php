<?php

class User {
    public $username;
    public $pass;
    public $lastname;
    public $firstname;
    public $tel;
    public $mail;
    public $city;
    public $birthday;
    public $image;
    public $date;
    public $rating;

    public function __construct($username, $pass, $lastname, $firstname, $tel, $mail, $city, $birthday, $date) {
        $this->username = $username;
        $this->pass = $pass;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->tel = $tel;
        $this->mail = $mail;
        $this->city = $city;
        $this->birthday = $birthday;
        $this->date = $date;
    }
}

class Admin extends User {
    public $pro = "Admin";
}

?>