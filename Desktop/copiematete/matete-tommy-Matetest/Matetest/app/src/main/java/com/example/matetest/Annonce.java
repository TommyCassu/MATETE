package com.example.matetest;

public class Annonce {

    private int id;
    private String creneaux_debut;
    private String creneaux_fin;
    private String libelle_produit;
    private Double prix_unitaire;
    private int quantite;
    private String status;
    private Lieu unlieu;
    private Categorie unecategorie;
    private Producteur unproducteur;
    private boolean isSelected;


    public Annonce(int id, String creneaux_debut,String creneaux_fin,String libelle_produit, double prix_unitaire,int quantite,String status,Lieu unlieu,Categorie unecategorie,Producteur unproducteur){
        this.id = id;
        this.creneaux_debut = creneaux_debut;
        this.creneaux_fin = creneaux_fin;
        this.libelle_produit = libelle_produit;
        this.prix_unitaire = prix_unitaire;
        this.quantite = quantite;
        this.status = status;
        this.unlieu = unlieu;
        this.unecategorie = unecategorie;
        this.unproducteur = unproducteur;

    }

    public int getId(){
        return id;
    }
    public String getCreneaux_debut(){
        return creneaux_debut;
    }
    public String getCreneaux_fin(){
        return creneaux_fin;
    }
    public String getLibelle_produit(){
        return libelle_produit;
    }
    public Double getPrix_unitaire(){
        return prix_unitaire;
    }
    public int getQuantite(){
        return quantite;
    }
    public String getStatus(){
        return status;
    }
    public Lieu getLieu(){
        return unlieu;
    }
    public Categorie getCategorie(){
        return unecategorie;
    }
    public Producteur getProducteur(){
        return unproducteur;
    }


    public boolean isSelected() {
        return isSelected;
    }

    public void setSelected(boolean selected) {
        isSelected = selected;
    }

    @Override
    public String toString() {
        return "Annonce{" +
                "id=" + id +
                ", creneaux_debut='" + creneaux_debut + '\'' +
                ", creneaux_fin='" + creneaux_fin + '\'' +
                ", libelle_produit='" + libelle_produit + '\'' +
                ", prix_unitaire=" + prix_unitaire +
                ", quantite=" + quantite +
                ", status='" + status + '\'' +
                ", unlieu=" + unlieu +
                ", unecategorie=" + unecategorie +
                ", isSelected=" + isSelected +
                ", unproducteur=" + unproducteur +
                '}';
    }
}