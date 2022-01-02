<?php

class Categorie implements JsonSerializable {
    private $id;
    private $libelle;
    
    /**
     * __construct
     * Constructeur de la classe Categorie
     * @param  mixed $_id
     * @param  mixed $_libelle
     * @return void
     */
    function __construct( $_id, $_libelle)
    {
        $this->id = $_id;
        $this->libelle = $_libelle;
    }
    
    /**
     * jsonSerialize
     * Permet de mettre les données au format JSON
     * @return void
     */
    public function jsonSerialize (){
        return [
            "id" => $this->id,
            "libelle" => $this->libelle,
        ];
    }

    
}