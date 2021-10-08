<?php

class Annonce {
    private $id;
    private $creneauxDébut;
    private $creneauxFin;
    private $libelleProduit;
    private $prixUnitaire;
    private $qte;

    function __construct( $_id, $_creneauxDébut,$_creneauxFin,$_libelleproduit,$_prixUnitaire,$_qte)
    {
        $this->id = $_id;
        $this->creneauxDébut = $_creneauxDébut;
        $this->creneauxFin = $_creneauxFin;
        $this->libelleProduit = $_libelleproduit;
        $this->prixUnitaire = $_prixUnitaire;
        $this->qte = $_qte;
    }

    
}