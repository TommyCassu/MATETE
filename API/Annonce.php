<?php

class Annonce implements JsonSerializable {
    private $id;
    private $lieu_id;
    private $categorie_id;
    private $producteur_id;
    private $creneaux_debut;
    private $creneaux_fin;
    private $libelle_produit;
    private $prix_unitaire;
    private $quantite;
    private $status;
    private $date_mise_en_ligne;
    private $lieu;
    private $categorie;
    private $producteur;
    
    /**
     * __construct
     * Constructeur de la table Annonce 
     * @param  mixed $_id
     * @param  mixed $lieu_id
     * @param  mixed $categorie_id
     * @param  mixed $producteur_id
     * @param  mixed $_creneaux_debut
     * @param  mixed $_creneaux_fin
     * @param  mixed $_libelle_produit
     * @param  mixed $_prix_unitaire
     * @param  mixed $_quantite
     * @param  mixed $_status
     * @param  mixed $_date_mise_en_ligne
     * @param  mixed $_lieu
     * @param  mixed $_categorie
     * @return void
     */
    function __construct( $_id,$lieu_id,$categorie_id,$producteur_id, $_creneaux_debut,$_creneaux_fin,$_libelle_produit,$_prix_unitaire,$_quantite,$_status,$_date_mise_en_ligne,$_lieu,$_categorie,$_producteur)
    {
        $this->id = $_id;
        $this->lieu_id=$lieu_id;
        $this->categorie_id=$categorie_id;
        $this->producteur_id=$producteur_id;
        $this->creneaux_debut = $_creneaux_debut;
        $this->creneaux_fin = $_creneaux_fin;
        $this->libelle_produit = $_libelle_produit;
        $this->prix_unitaire = $_prix_unitaire;
        $this->quantite = $_quantite;
        $this->status = $_status;
        $this->date_mise_en_ligne = $_date_mise_en_ligne;
        $this->lieu = $_lieu;
        $this->categorie = $_categorie;
        $this->producteur = $_producteur;
    }
    
    /**
     * jsonSerialize
     * Permet de mettre les données au format JSON 
     * @return void
     */
    public function jsonSerialize (){
        return [
            "id" => $this->id,
            "lieu_id"=> $this->lieu_id,
            "categorie_id"=> $this->categorie_id,
            "producteur_id"=> $this->producteur_id,
            "creneaux_debut" => $this->creneaux_debut,
            "creneaux_fin" => $this->creneaux_fin,
            "libelle_produit" => $this->libelle_produit,
            "prix_unitaire" => $this->prix_unitaire,
            "quantite" => $this->quantite,
            "status" => $this->status,
            "date_mise_en_ligne" => $this->date_mise_en_ligne,
            "lieu" => $this->lieu,
            "categorie" => $this->categorie,
            "producteur" => $this->producteur,
        ];
    }

    
}