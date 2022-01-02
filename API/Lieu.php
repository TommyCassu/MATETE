<?php

class Lieu implements JsonSerializable {
    private $id;
    private $cooX;
    private $cooY;
    private $descLieu;
    private $nom;
    
    /**
     * __construct
     * Constructeur de la classe lieu
     * @param  mixed $_id
     * @param  mixed $_cooX
     * @param  mixed $_cooY
     * @param  mixed $_descLieu
     * @param  mixed $_nom
     * @return void
     */
    function __construct( $_id, $_cooX,$_cooY,$_descLieu,$_nom)
    {
        $this->id = $_id;
        $this->cooX = $_cooX;
        $this->cooY = $_cooY;
        $this->descLieu = $_descLieu;
        $this->nom = $_nom;
    }
    
    /**
     * getId
     * id de la classe lieu
     * @return void
     */
    function getId(){
        return $this->_id;
    }
    
    /**
     * getCooX
     * Coordonnée X du lieu
     * @return void
     */
    function getCooX(){
        return $this->_cooX;
    }
    
    /**
     * getCooY
     * Coordonnée Y du lieu
     * @return void
     */
    function getCooY(){
        return $this->_cooY;
    }
    
    /**
     * getdesclieu
     * Déscription du lieu
     * @return void
     */
    function getdesclieu(){
        return $this->_descLieu;
    }
    
    /**
     * getnom
     * Nom du lieu
     * @return void
     */
    function getnom(){
        return $this->_nom;
    }
    
    /**
     * jsonSerialize
     * Permet de mettre les données au format JSON
     * @return void
     */
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