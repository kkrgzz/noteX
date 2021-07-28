package com.kkrgzz.notexgithub;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.content.res.Resources;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class MainActivity extends AppCompatActivity {

    public static Resources resources;

    private EditText usernameET, passwordET;
    Button loginButton;

    private String username, password;
    public String loginURL;

    // Variables get from server-side.
    public String usernameDB, emailDB, userIdDB, userLoginStatusDB;

    // To exit program with double back button
    boolean doubleBackToExitPressedOnce = false;

    String TAG = "TAG";
    String emptyFieldsMessage, incorrectInputsMessage, loginSuccessfulMessage, doubleBackMessage;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        /*
            Get the Toast messages from strings. Because when we translate the language of app,
            all of the Toast messages will change as language as change.
        */
        resources = getResources();
        emptyFieldsMessage = resources.getString(R.string.empty_fields_notification);
        incorrectInputsMessage = resources.getString(R.string.username_or_password_not_correct_message);
        loginSuccessfulMessage = resources.getString(R.string.login_successful_message);
        doubleBackMessage = resources.getString(R.string.double_back_notification);

        urlClass getURL = new urlClass();
        loginURL = getURL.getLocalMemberURL();

        usernameET = findViewById(R.id.usernameET);
        passwordET = findViewById(R.id.passwordET);
        loginButton = findViewById(R.id.loginButton);

        loginButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                login();
            }
        });
    }

    public void login(){
        username = usernameET.getText().toString().trim();
        password = passwordET.getText().toString().trim();
        RequestQueue queue = Volley.newRequestQueue(this);
        if(!username.isEmpty() && !password.isEmpty()){
            StringRequest stringRequest = new StringRequest(Request.Method.POST, loginURL, response -> {
                try {
                    JSONArray jsonArray = new JSONArray(response);
                    for(int i = 0; i < jsonArray.length(); i++){

                        JSONObject jsonObject = jsonArray.getJSONObject(i);
                        usernameDB = jsonObject.getString("username");
                        emailDB = jsonObject.getString("mail");
                        userIdDB = jsonObject.getString("userId");
                        userLoginStatusDB = jsonObject.getString("loginStatus");
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }

                // Login Successful
                if(userLoginStatusDB.equals("success")){
                    Toast.makeText(this, loginSuccessfulMessage, Toast.LENGTH_SHORT).show();
                    startNotesActivity();
                }else{
                    Toast.makeText(this, incorrectInputsMessage, Toast.LENGTH_SHORT).show();
                }
            }, error -> {
                Toast.makeText(this, "Error!"+error, Toast.LENGTH_SHORT).show();
            }){
                @Override
                public Map<String, String> getParams() {
                    Map<String, String> params = new HashMap<>();
                    params.put("login", "true");
                    params.put("username", username);
                    params.put("password", password);
                    return params;
                }
            };
            queue.add(stringRequest);
        }
        else{
            Toast.makeText(this, emptyFieldsMessage, Toast.LENGTH_SHORT).show();
        }
    }

    void startNotesActivity(){
        Intent intent = new Intent(MainActivity.this, NotesActivity.class);
        intent.putExtra("loginStatus", userLoginStatusDB);
        intent.putExtra("userId", userIdDB);
        intent.putExtra("username", usernameDB);
        intent.putExtra("email", emailDB);
        startActivity(intent);
        finish();
    }

    public void startRegisterActivity(View view) {
        Intent intent = new Intent(MainActivity.this, RegisterActivity.class);
        startActivity(intent);
        finish();
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