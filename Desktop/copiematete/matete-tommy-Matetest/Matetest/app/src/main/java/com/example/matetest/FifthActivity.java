package com.example.matetest;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.List;
import java.util.stream.Collectors;

public class FifthActivity extends AppCompatActivity {
    RecyclerViewPanier adapter;
    private Controller controller = new Controller(this);


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_fifth);

        int id = getIntent().getIntExtra("id",0);
        //annonce correspondante
        Annonce a = controller.hm.get(id);
        Toast.makeText(FifthActivity.this,"Hi " + id ,Toast.LENGTH_SHORT).show();



        ImageButton btClose = (ImageButton) findViewById(R.id.imageButton);

        btClose.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(FifthActivity.this, SecondActivity.class));
            }
        });




        androidx.recyclerview.widget.RecyclerView recyclerView = findViewById(R.id.rvAnimals);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));
        ArrayList arrayList = new ArrayList<Object>(controller.hm.values());
        Log.d(arrayList.toString(), "onCreate: ");
        adapter = new RecyclerViewPanier(this, arrayList);
        recyclerView.setAdapter(adapter);
    }
}