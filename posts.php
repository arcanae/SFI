<?php

class Post {
    public $author;
    public $title;
    public $comment;
    public $price;
}

class People extends Post {
    public $job;  
    public $schedule;

    public function __construct($author, $title, $comment, $price, $job, $schedule){
        $this->author = $author;
        $this->title = $title;
        $this->comment = $comment;
        $this->price = $price;
        $this->job = $job;
        $this->schedule = $schedule;
    }
}

class Transport extends Post {
    public $date;
    public $start;
    public $starthour;
    public $finish;
    public $endhour;
    public $seats;
    public $car;

    public function __construct($author, $date, $title, $comment, $price, $start, $starthour, $finish, $endhour, $seats, $car){
        $this->author = $author;
        $this->date = $date;
        $this->title = $title;
        $this->comment = $comment;
        $this->price = $price;
        $this->start = $start;
        $this->starthour = $starthour;
        $this->finish = $finish;
        $this->endhour = $endhour;
        $this->seats = $seats;
        $this->car = $car;
    }
}

class Housing extends Post {
    public $housetype;
    public $time;
    public $cycle;

    public function __construct($author, $title, $comment, $price, $housetype, $cycle ){
        $this->author = $author;
        $this->title = $title;
        $this->comment = $comment;
        $this->price = $price;
        $this->housetype = $housetype;
        $this->cycle = $cycle;
    }
}

?>