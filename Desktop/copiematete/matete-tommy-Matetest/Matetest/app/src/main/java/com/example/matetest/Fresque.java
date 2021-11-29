package com.example.matetest;

public class Fresque {
    private int id;
    private String nom;
    private String description;
    private double lattitude;
    private double longitude;
    private String nomPhoto;

    public Fresque(int id, String nom,String description,double lattitude, double longitude,String nomPhoto){
        this.id = id;
        this.nom = nom;
        this.description = description;
        this.lattitude = lattitude;
        this.longitude = longitude;
        this.nomPhoto = nomPhoto;

    }

    public int getId(){
        return id;
    }
    public String getNomFresque(){
        return nom;
    }
    public String getDescriptionFresque(){
        return description;
    }
    public double getLattitude(){
        return lattitude;
    }
    public double getLongitude(){
        return longitude;
    }
    public String getNomPhoto(){
        return nomPhoto;
    }


}

