<?php

class Lieu implements JsonSerializable {
    private $id;
    private $cooX;
    private $cooY;
    private $descLieu;
    private $nom;

    function __construct( $_id, $_cooX,$_cooY,$_descLieu,$_nom)
    {
        $this->id = $_id;
        $this->cooX = $_cooX;
        $this->cooY = $_cooY;
        $this->descLieu = $_descLieu;
        $this->nom = $_nom;
    }
    function getId(){
        return $_id;
    }

    public function jsonSerialize (){
        return [
            "id" => $this->id,
            "cooX" => $this->cooX,
            "cooY" => $this->cooY,
            "descLieu" => $this->descLieu,
            "nom" => $this->nom,
        ];
    }
}