<?php

class Producteur {
    private $id;
    private $cooX;
    private $cooY;
    private $descLieu;
    private $nom;

    function __construct( $_id, $_cooX,$_cooY,$_descLieu)
    {
        $this->id = $_id;
        $this->cooX = $_cooX;
        $this->cooY = $_cooY;
        $this->descLieu = $_descLieu;
    }
}