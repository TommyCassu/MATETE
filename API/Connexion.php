<?php

class Connexion{
    private $bdd;

    function __construct(){
        try {
            $this->bdd = new PDO('mysql:host=localhost; dbname=matete; charset=utf8', "root", "");
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //récupérer toute les annonces
    function RecupererAnnonces(){
        
        $dateActuelle = new DateTime();
        $intervalplus30jours = new DateInterval("PT30D");

        $dateActuelleFormate = $dateActuelle->format('Y-m-d H:i:s');

        $datePlus30jours = $dateActuelle->sub($intervalplus30jours)->format('Y-m-d H:i:s');

        $requete = $this->bdd->prepare('SELECT * FROM annonce WHERE dateAcutelleFormate < date_mise_en_ligne < datePlus30jours');
        $requete->execute();
        $annoncesPOO = array();
        while ($row = $stmt->fetch()) { 
            array_push($annoncesPOO,$annonce = new annonce($row['id'],$row['creneauxDébut'],$row['creneauxFin'],$row['libelleProduit'],$row['creneauxDébut'],$row['prixUnitaire'],$row['qte']));
        }
        
    }
    function recherche($lestags){
        for(i=0,$lestags<i,i++){

        }
    }

}
?>