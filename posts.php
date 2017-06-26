<?php

class Post {
    public $author;
    public $date;
    public $title;
    public $comment;
    public $price;
}

class People extends Annonces {
    public $job;  
    public $schedule;
}

class Transport extends Annonces {
    public $start;
    public $finish;
    public $seats;
}

class Housing extends Annonces {
    public $type;
    public $time;
    public $cycle;  
}

?>