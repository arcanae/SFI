<?php

class Annonces {
    public $date;
    public $titre;
    public $commentaire;
    public $tarif;
}

class Personnel extends Annonces {
    public $profession;  
    public $horraire;
}

class Transport extends Annonces {
    public $depart;
    public $arrive;
    public $places;
}

class Logement extends Annonces {
    public $type;
    public $duree;
    public $cycle;  
}

?>