<?php
require('Annonce.php');
require('Categorie.php');
require('Lieu.php');
require('Producteur.php');
class Connexion{
    private $bdd;

    function __construct(){
        try {
            $this->bdd = new PDO('mysql:host=localhost; dbname=matete; charset=utf8', "root", "Lurcat2020");
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //récupérer toute les annonces
    function RecupererAnnonces(){
        
        $dateActuelle = new DateTime();
        $intervalplus30jours = new DateInterval("P30D");

        $dateActuelleFormate = $dateActuelle->format('Y-m-d H:i:s');

        $datePlus30jours = $dateActuelle->sub($intervalplus30jours)->format('Y-m-d H:i:s');

        $requete = $this->bdd->prepare('SELECT * FROM annonce a INNER JOIN lieu l ON l.id = a.lieu_id INNER JOIN categorie c ON c.id = a.categorie_id');
        $requete->execute();
        $annoncesPOO = array();

        while ($row = $requete->fetch()) {
            $c = new Categorie($row['id'],$row['libelle']); 
            $l = new Lieu($row['id'],$row['coo_x'],$row['coo_y'],$row['desc_lieu'],$row['nom']);
            array_push($annoncesPOO, new Annonce($row['id'],$row['lieu_id'],$row['categorie_id'],$row['producteur_id'],$row['creneaux_debut'],$row['creneaux_fin'],$row['libelle_produit'],$row['prix_unitaire'],$row['quantite'],$row['status'],$row['date_mise_en_ligne'],$l,$c));
        }
        return $annoncesPOO;
    }
    }

?>