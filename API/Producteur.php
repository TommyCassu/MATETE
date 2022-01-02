<?php

class Producteur {
    private $id;
    private $nom;
    private $prenom;
    private $tel;
    private $mail;
    private $mdp;
    
    /**
     * __construct
     * Constructeur de la classe producteur
     * @param  mixed $_id
     * @param  mixed $_nom
     * @param  mixed $_prenom
     * @param  mixed $_tel
     * @param  mixed $_mail
     * @param  mixed $_mdp
     * @return void
     */
    function __construct( $_id, $_nom,$_prenom,$_tel,$_mail,$_mdp)
    {
        $this->id = $_id;
        $this->nom = $_nom;
        $this->prenom = $_prenom;
        $this->tel = $_tel;
        $this->mail = $_mail;
        $this->mdp = $_mdp;
    }
    
    /**
     * getId
     * Récupère L'id du producteur
     * @return void
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * getNom
     * Récupère le nom du producteur
     * @return void
     */
    public function getNom() {
        return $this->nom;
    }
        
    /**
     * getPrenom
     * Récupère le prénom du producteur
     * @return void
     */
    public function getPrenom() {
        return $this->prenom;
    }
    
    /**
     * getTel
     * Récupère le numéro de téléphone du producteur
     * @return void
     */
    public function getTel() {
        return $this->tel;
    }
        
    /**
     * getMail
     * Récupère le mail du producteur
     * @return void
     */
    public function getMail() {
        return $this->mail;
    }
    
}