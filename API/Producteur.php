<?php

class Producteur {
    private $id;
    private $nom;
    private $prenom;
    private $tel;
    private $mail;
    private $pass;

    function __construct( $_id, $_nom,$_prenom,$_tel,$_mail,$_pass)
    {
        $this->id = $_id;
        $this->nom = $_nom;
        $this->prenom = $_prenom;
        $this->tel = $_tel;
        $this->mail = $_mail;
        $this->pass = $_pass;
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
    redirect
    public function getMail() {
        return $this->mail;
    }
    
}