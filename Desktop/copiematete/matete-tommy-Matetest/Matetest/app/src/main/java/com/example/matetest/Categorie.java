package com.example.matetest;

public class Categorie {
    private int id;
    private String libelle;



    public Categorie(int id, String libelle){
        this.id = id;
        this.libelle = libelle;

    }

    public int getId(){
        return id;
    }
    public String getLibelle(){
        return libelle;
    }

}
