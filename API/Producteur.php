<?php

class Producteur {
    private $id;
    private $nom;
    private $prenom;
    private $tel;
    private $mail;
    private $mdp;

    function __construct( $_id, $_nom,$_prenom,$_tel,$_mail,$_mdp)
    {
        $this->id = $_id;
        $this->nom = $_nom;
        $this->prenom = $_prenom;
        $this->tel = $_tel;
        $this->mail = $_mail;
        $this->mdp = $_mdp;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getTel() {
        return $this->tel;
    }
    
    public function getMail() {
        return $this->mail;
    }
    
}