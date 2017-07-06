<?php

class Post {
    public $author;
    public $title;
    public $comment;
    public $price;
    public $creationDate;
}

class People extends Post {
    public $job;  
    public $schedule;

    public function __construct($author, $title, $comment, $price, $creationDate, $job, $schedule){
        $this->author = $author;
        $this->title = $title;
        $this->comment = $comment;
        $this->price = $price;
        $this->creationDate = $creationDate;
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

    public function __construct($author, $date, $title, $comment, $price, $creationDate, $start, $starthour, $finish, $endhour, $seats, $car){
        $this->author = $author;
        $this->date = $date;
        $this->title = $title;
        $this->comment = $comment;
        $this->price = $price;
        $this->creationDate = $creationDate;
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
    public $address;

    public function __construct($author, $title, $comment, $price, $creationDate, $housetype, $cycle, $address ){
        $this->author = $author;
        $this->title = $title;
        $this->comment = $comment;
        $this->price = $price;
        $this->creationDate = $creationDate;
        $this->housetype = $housetype;
        $this->cycle = $cycle;
        $this->address = $address;
    }
}

?>