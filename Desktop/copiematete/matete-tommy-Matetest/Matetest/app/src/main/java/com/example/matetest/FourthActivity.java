package com.example.matetest;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;
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

import java.io.Serializable;
import java.util.ArrayList;
import java.util.HashMap;

public class FourthActivity extends AppCompatActivity {
    private Controller controller = new Controller(this);
    RecyclerView adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_fourth);





        //récupération des paramètres
        int id = getIntent().getIntExtra("id",0);
        //annonce correspondante
        Annonce a = controller.hm.get(id);
        Toast.makeText(FourthActivity.this,"Hi " + id ,Toast.LENGTH_SHORT).show();






        String libelle = a.getLibelle_produit();
        String nom = a.getProducteur().getNom();
        String prenom = a.getProducteur().getPrenom();
        String nomLieu = a.getLieu().getNom();
        String desclieu = a.getLieu().getDescLieu();
        //String quantite = a.getQuantite();
        String creneaux_debut = a.getCreneaux_debut();
        String creneaux_fin = a.getCreneaux_fin();
        TextView libelleV = findViewById(R.id.libelle);
        libelleV.setText(libelle);

        //récupération des composants
        ImageView photoV = findViewById(R.id.photo);
        String uri = "@drawable/"+libelle; // where myresource (without the extension) is the file
        int imageResource = getResources().getIdentifier(uri, null, getPackageName());
        photoV.setImageResource(imageResource);

        TextView nomV = findViewById(R.id.nom);
        nomV.setText(nom);
        TextView prenomV = findViewById(R.id.prenom);
        prenomV.setText(prenom);

        //TextView quantiteV = findViewById(R.id.quantite);
        //quantiteV.setText(quantite);
        TextView cdV = findViewById(R.id.cd);
        cdV.setText(creneaux_debut);
        TextView cfV = findViewById(R.id.cf);
        cfV.setText(creneaux_fin);

        ImageButton btClose = (ImageButton) findViewById(R.id.imageButton);

        btClose.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(FourthActivity.this, SecondActivity.class));
            }
        });

        Button buttonAjoutPanier = (Button) findViewById(R.id.buttonAjoutPanier);

        buttonAjoutPanier.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                controller.MonPanier.put(a.getId(),a);
                Intent detailsActivity = new Intent(FourthActivity.this,FifthActivity.class);


                detailsActivity.putExtra("id",a.getId());
                startActivity(detailsActivity);
            }
        });
    }


}

