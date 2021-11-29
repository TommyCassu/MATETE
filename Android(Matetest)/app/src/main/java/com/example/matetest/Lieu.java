package com.example.matetest;

public class Lieu {

    private int id;
    private double cooX;
    private double cooY;
    private String descLieu;
    private String nom;

    public Lieu(int id, double cooX, double cooY,String descLieu, String nom){
        this.id = id;
        this.cooX = cooX;
        this.cooY = cooY;
        this.descLieu = descLieu;
        this.nom = nom;
    }

    public int getId(){
        return id;
    }
    public double getCooX(){
        return cooX;
    }
    public double getCooY(){
        return cooY;
    }
    public String getDescLieu(){
        return descLieu;
    }
    public String getNom(){
        return nom;
    }

}
