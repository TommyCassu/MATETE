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
        return $this->_id;
    }

    function getCooX(){
        return $this->_cooX;
    }

    function getCooY(){
        return $this->_cooY;
    }

    function getdesclieu(){
        return $this->_descLieu;
    }

    function getnom(){
        return $this->_nom;
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