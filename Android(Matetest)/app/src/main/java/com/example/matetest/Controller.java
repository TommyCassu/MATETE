package com.example.matetest;


import android.content.Context;
import android.graphics.drawable.Drawable;
import android.util.Log;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.osmdroid.util.GeoPoint;
import org.osmdroid.views.MapView;
import org.osmdroid.views.overlay.Marker;
import org.osmdroid.views.overlay.OverlayItem;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class Controller {
    private static ArrayList<Annonce> lesAnnonces = new ArrayList<>();

    private static ArrayList<Annonce> LesAnnoncesFiltre = new ArrayList<>();
    public static HashMap<Integer,Annonce> MonPanier =new HashMap<Integer,Annonce>();
    private static ArrayList<Lieu> lesLieux = new ArrayList<>();
    Context context;
    public Controller(Context context) {
        this.context = context;
    }
    public ArrayList<Annonce> getLesAnnonces() {
        return lesAnnonces;
    }
    public ArrayList<Annonce> getLesAnnoncesFiltrees() {
        return LesAnnoncesFiltre;
    }
    public static HashMap<Integer,Annonce> hm =new HashMap<Integer,Annonce>();
    public ArrayList<OverlayItem> getLesMarker(){
        ArrayList<OverlayItem> lesMarker = new ArrayList<OverlayItem>();
        for (Annonce f : LesAnnoncesFiltre) {
            OverlayItem i = new OverlayItem(f.getLibelle_produit(), "Nom : "+f.getProducteur().getNom()+"\n"+"Prenom : "+f.getProducteur().getPrenom()+"\n"+"Lieu : "+f.getLieu().getNom()+"\n"+"Quantite : "+f.getQuantite()+"\n"+"Disponible du : "+f.getCreneaux_debut()+"\n"+"Au : "+f.getCreneaux_fin()+"\n", new
                    GeoPoint(f.getLieu().getCooX(), f.getLieu().getCooY()));



            lesMarker.add(i);
        }
        return lesMarker;
    }

    public static void setLesAnnoncesFiltre(ArrayList<Annonce> lesAnnoncesFiltre) {
        LesAnnoncesFiltre = lesAnnoncesFiltre;
    }

    public void recupererLesAnnonces(final VolleyCallback callback){
        //String url = "http://172.20.10.2/matete-API/API/?action=all";
        String url = "http://192.168.17.1/matete-API/API/?action=all";
        JsonObjectRequest jsonObjectRequest = new JsonObjectRequest
                (Request.Method.GET, url, null, new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        parseJsonToAnnonce(response);
                        callback.onSuccess();

                    }
                }, new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Log.e("","Erreur RecupererLesAnnonces !!!!!!!!!"+error);
                    }
                }
                ) {
            //Ajout du header d'authentification
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map<String, String> params = new HashMap<String, String>();
                params.put("X-AUTH-TOKEN", "monToken");
                return params;
            }
        };
        // Access the RequestQueue through your singleton class.
        MySingleton.getInstance(context).addToRequestQueue(jsonObjectRequest,"headerRequest");
    }

    private void parseJsonToAnnonce(JSONObject json){
        try {
            JSONArray lesAnnoncesJSON = json.getJSONArray("annonces");
            for (int i=0;i<lesAnnoncesJSON.length();i++) {
                JSONObject uneAnnonce = lesAnnoncesJSON.getJSONObject(i);
                lesAnnonces.add(new Annonce(uneAnnonce.getInt("id"),uneAnnonce.getString("creneaux_debut"),uneAnnonce.getString("creneaux_fin"),uneAnnonce.getString("libelle_produit"),uneAnnonce.getDouble("prix_unitaire"),uneAnnonce.getInt("quantite"),uneAnnonce.getString("status"),new Lieu(uneAnnonce.getJSONObject("lieu").getInt("id"), uneAnnonce.getJSONObject("lieu").getDouble("cooX"),uneAnnonce.getJSONObject("lieu").getDouble("cooY"),uneAnnonce.getJSONObject("lieu").getString("descLieu"),uneAnnonce.getJSONObject("lieu").getString("nom")),new Categorie(uneAnnonce.getJSONObject("categorie").getInt("id"),uneAnnonce.getJSONObject("categorie").getString("libelle")), new Producteur(uneAnnonce.getJSONObject("producteur").getInt("id"),uneAnnonce.getJSONObject("producteur").getString("nom"),uneAnnonce.getJSONObject("producteur").getString("prenom"),uneAnnonce.getJSONObject("producteur").getString("tel"),uneAnnonce.getJSONObject("producteur").getString("mail"),uneAnnonce.getJSONObject("producteur").getString("pass"))));
                LesAnnoncesFiltre.add(new Annonce(uneAnnonce.getInt("id"),uneAnnonce.getString("creneaux_debut"),uneAnnonce.getString("creneaux_fin"),uneAnnonce.getString("libelle_produit"),uneAnnonce.getDouble("prix_unitaire"),uneAnnonce.getInt("quantite"),uneAnnonce.getString("status"),new Lieu(uneAnnonce.getJSONObject("lieu").getInt("id"), uneAnnonce.getJSONObject("lieu").getDouble("cooX"),uneAnnonce.getJSONObject("lieu").getDouble("cooY"),uneAnnonce.getJSONObject("lieu").getString("descLieu"),uneAnnonce.getJSONObject("lieu").getString("nom")),new Categorie(uneAnnonce.getJSONObject("categorie").getInt("id"),uneAnnonce.getJSONObject("categorie").getString("libelle")), new Producteur(uneAnnonce.getJSONObject("producteur").getInt("id"),uneAnnonce.getJSONObject("producteur").getString("nom"),uneAnnonce.getJSONObject("producteur").getString("prenom"),uneAnnonce.getJSONObject("producteur").getString("tel"),uneAnnonce.getJSONObject("producteur").getString("mail"),uneAnnonce.getJSONObject("producteur").getString("pass"))));
            }
        } catch (JSONException e) {
            e.printStackTrace();
            Log.e("","vraie erreur PArseJsonToAnnonce !!!!!!!!!"+e.getLocalizedMessage());
        }
    }

    public interface VolleyCallback{
        void onSuccess();
    }


}
