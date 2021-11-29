package com.example.matetest;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;

import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class ThirdActivity extends AppCompatActivity implements RecyclerView.ItemClickListener{

    RecyclerView adapter;

    ArrayList<String> LesFiltres = new ArrayList<>() ;
    ArrayList<Annonce> ToutesLesAnnonces = new ArrayList<>() ;
    ArrayList<Annonce> total = new ArrayList<>() ;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_third);

        recupererLesLivresJSON();

        androidx.recyclerview.widget.RecyclerView recyclerView = findViewById(R.id.rvAnimals);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));
        adapter = new RecyclerView(this, new Controller(this).getLesAnnonces());
        recyclerView.setAdapter(adapter);



        ImageButton buttonRetour = (ImageButton) findViewById(R.id.imageButton);

        buttonRetour.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(ThirdActivity.this, SecondActivity.class));
            }
        });

        Button buttonValidez = (Button) findViewById(R.id.buttonValidez);

        buttonValidez.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                LesFiltres = (ArrayList<String>) adapter.ListeLesFiltre();
                Toast toast = Toast.makeText(getApplicationContext(), LesFiltres.toString(), Toast.LENGTH_LONG);
                toast.show();
                Log.d("La liste est: ",total.toString());

                ArrayList<Annonce> lesAnnoncesFiltrees = new ArrayList<>();
                lesAnnoncesFiltrees.clear();
                for(int k=0;k<LesFiltres.size();k++){
                    String filtre = LesFiltres.get(k);
                    for (int i=0; i<ToutesLesAnnonces.size();i++) {
                        Annonce currentannonce = ToutesLesAnnonces.get(i);
                        if(currentannonce.getLibelle_produit().contains(filtre)){
                            lesAnnoncesFiltrees.add(currentannonce);
                            Log.e("eee",currentannonce.toString());
                        }

                    }


                }
                //on met à jour les annonces filtrées du controleur
                new Controller(getApplicationContext()).setLesAnnoncesFiltre(lesAnnoncesFiltrees);
                startActivity(new Intent(ThirdActivity.this, SecondActivity.class));








            }
        });
    }


    public void recupererLesLivresJSON() {

        //String url = "http://172.20.10.6/matete-API/API/?action=all";
        String url = "http://192.168.17.1/matete-API/API/?action=all";

        // Instantiate the RequestQueue.
        RequestQueue queue = Volley.newRequestQueue(this);

        // Request a string response from the provided URL.
        JsonObjectRequest jsonObjectRequest = new JsonObjectRequest
                (Request.Method.GET, url, null, new Response.Listener<JSONObject>() {

                    @Override
                    public void onResponse(JSONObject response) {
                        // Display the first 500 characters of the response string.
                        parseJsonToAnnonce(response);
                    }
                }, new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Log.e("", "Response: " + error.getLocalizedMessage());
                    }
                });

        // Add the request to the RequestQueue.
        queue.add(jsonObjectRequest);


    }

    private void parseJsonToAnnonce(JSONObject json){
        try {
            JSONArray lesAnnoncesJSON = json.getJSONArray("annonces");
            for (int i=0;i<lesAnnoncesJSON.length();i++) {
                JSONObject uneAnnonce = lesAnnoncesJSON.getJSONObject(i);
                Producteur unProducteur = new Producteur(uneAnnonce.getJSONObject("producteur").getInt("id"),uneAnnonce.getJSONObject("producteur").getString("nom"),uneAnnonce.getJSONObject("producteur").getString("prenom"),uneAnnonce.getJSONObject("producteur").getString("tel"),uneAnnonce.getJSONObject("producteur").getString("mail"),uneAnnonce.getJSONObject("producteur").getString("pass"));
                Categorie UneCategorie = new Categorie(uneAnnonce.getJSONObject("categorie").getInt("id"),uneAnnonce.getJSONObject("categorie").getString("libelle"));
                Lieu UnLieu =  new Lieu(uneAnnonce.getJSONObject("lieu").getInt("id"), uneAnnonce.getJSONObject("lieu").getDouble("cooX"), uneAnnonce.getJSONObject("lieu").getDouble("cooY"), uneAnnonce.getJSONObject("lieu").getString("descLieu"), uneAnnonce.getJSONObject("lieu").getString("nom"));
                Annonce A = new Annonce(uneAnnonce.getInt("id"), uneAnnonce.getString("creneaux_debut"), uneAnnonce.getString("creneaux_fin"), uneAnnonce.getString("libelle_produit"), uneAnnonce.getDouble("prix_unitaire"), uneAnnonce.getInt("quantite"), uneAnnonce.getString("status"),UnLieu,UneCategorie,unProducteur);
                ToutesLesAnnonces.add(A);
                total.add(A);
            }


            //tvTitre = (TextView)findViewById(R.id.affichageTitre);
            //tvTitre.setText("Le Titre est : "+l.getTitre());


            androidx.recyclerview.widget.RecyclerView recyclerView = findViewById(R.id.rvAnimals);
            recyclerView.setLayoutManager(new LinearLayoutManager(this));
            adapter = new RecyclerView(this, ToutesLesAnnonces);
            recyclerView.setAdapter(adapter);

            recyclerView.addOnItemTouchListener(new RecyclerItemClickListener(this, recyclerView, new RecyclerItemClickListener.OnItemClickListener() {
                        @Override
                        public void onItemClick(View view, int position) {
                            // do whatever

                        }

                        @Override
                        public void onLongItemClick(View view, int position) {
                            // do whatever

                        }
                    })
            );







        } catch (JSONException e) {
            e.printStackTrace();
            Log.e("", "vraie erreur parseToAnnonce !!!!!!!!!" + e.getLocalizedMessage());
        }
    }


    @Override
    public void onItemClick(View view, int position) {

    }
}