<?php

class Categorie implements JsonSerializable {
    private $id;
    private $libelle;

    function __construct( $_id, $_libelle)
    {
        $this->id = $_id;
        $this->libelle = $_libelle;
    }

    public function jsonSerialize (){
        return [
            "id" => $this->id,
            "libelle" => $this->libelle,
        ];
    }

    
}