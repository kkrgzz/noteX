package com.kkrgzz.notexgithub;

import androidx.appcompat.app.AppCompatActivity;

import android.annotation.SuppressLint;
import android.content.res.Resources;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.widget.TextView;
import android.widget.Toast;

public class NotesActivity extends AppCompatActivity {

    public static Resources resources;

    String loginStatus, userId, username, email;
    TextView text;

    // To exit program with double back button
    boolean doubleBackToExitPressedOnce = false;
    String doubleBackMessage;

    @SuppressLint("SetTextI18n")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_notes);

        getInformationFromLastActivity();

        resources = getResources();
        doubleBackMessage = resources.getString(R.string.double_back_notification);

        text = findViewById(R.id.textView);
        text.setText(loginStatus+"\n"+userId+"\n"+username+"\n"+email);
    }

    private void getInformationFromLastActivity(){
        Bundle bundle = getIntent().getExtras();
        loginStatus = bundle.getString("loginStatus");
        userId = bundle.getString("userId");
        username = bundle.getString("username");
        email = bundle.getString("email");
    }

    @Override
    public void onBackPressed() {
        if (doubleBackToExitPressedOnce) {
            super.onBackPressed();
            return;
        }

        this.doubleBackToExitPressedOnce = true;
        Toast.makeText(this, doubleBackMessage, Toast.LENGTH_SHORT).show();

        new Handler(Looper.getMainLooper()).postDelayed(new Runnable() {

            @Override
            public void run() {
                doubleBackToExitPressedOnce=false;
            }
        }, 2000);
    }
}