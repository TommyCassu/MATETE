package com.example.matetest;

public class Producteur {

    private int id;
    private String nom;
    private String prenom;
    private String tel;
    private String mail;
    private String pass;

    public Producteur(int id,String nom, String prenom, String tel , String mail , String pass){
        this.id = id;
        this.nom = nom;
        this.prenom = prenom;
        this.tel = tel;
        this.mail = mail;
        this.pass = pass;
    }

    public int getId(){
        return id;
    }
    public String getNom(){
        return nom;
    }
    public String getPrenom(){
        return prenom;
    }
    public String getTel(){
        return tel;
    }
    public String getMail(){
        return mail;
    }
    public String getPass(){
        return pass;
    }

}
