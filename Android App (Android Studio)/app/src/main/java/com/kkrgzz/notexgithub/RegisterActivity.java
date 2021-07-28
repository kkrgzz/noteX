package com.kkrgzz.notexgithub;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.content.res.Resources;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;

public class RegisterActivity extends AppCompatActivity {

    public static Resources resources;

    // To exit program with double back button
    boolean doubleBackToExitPressedOnce = false;
    String doubleBackMessage;

    // Toast Message Strings
    String passwordsNotMatch, emailNotValidMessage, emptyFieldsMessage,
            registrationSuccessful, registrationFailed;

    EditText usernameET, emailET, passwordET, passwordAgainET;
    Button signUpButton;

    // Input Values Variables
    String username, email, password;

    // Get URL from urlClass
    String memberURL;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        usernameET = findViewById(R.id.usernameET);
        emailET = findViewById(R.id.emailET);
        passwordET = findViewById(R.id.passwordET);
        passwordAgainET = findViewById(R.id.passwordAgainET);
        signUpButton = findViewById(R.id.signUpButton);

        urlClass getURL = new urlClass();
        memberURL = getURL.getLocalMemberURL();

        resources = getResources();
        doubleBackMessage = resources.getString(R.string.double_back_notification);
        passwordsNotMatch = resources.getString(R.string.passwords_not_match);
        emailNotValidMessage = resources.getString(R.string.email_not_valid);
        emptyFieldsMessage = resources.getString(R.string.empty_fields_notification);
        registrationSuccessful = resources.getString(R.string.registration_successful);
        registrationFailed = resources.getString(R.string.registration_failed);

        signUpButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                register();
            }
        });
    }

    private void register(){
        if(passwordET.getText().toString().trim().equals(passwordAgainET.getText().toString().trim())){
            username = usernameET.getText().toString().trim();
            email = emailET.getText().toString().trim();
            password = passwordET.getText().toString().trim();
            if(isEmailValid(email)){
                RequestQueue queue = Volley.newRequestQueue(this);

                if(!username.isEmpty() && !email.isEmpty() && !password.isEmpty()){
                    StringRequest stringRequest = new StringRequest(Request.Method.POST, memberURL, response -> {
                        if(response.equals("success")){
                            Toast.makeText(this, registrationSuccessful, Toast.LENGTH_SHORT).show();
                            startLoginActivityAfterRegistration();
                        }else{
                            Toast.makeText(this, registrationFailed, Toast.LENGTH_SHORT).show();
                        }
                    }, error -> {
                        Toast.makeText(this, "Error!", Toast.LENGTH_SHORT).show();
                    }){
                        public Map<String, String> getParams(){
                            Map<String, String> params = new HashMap<>();
                            params.put("register", "true");
                            params.put("username", username);
                            params.put("email", email);
                            params.put("password", password);
                            return params;
                        }
                    };
                    queue.add(stringRequest);
                }else {
                    Toast.makeText(this, emptyFieldsMessage, Toast.LENGTH_SHORT).show();
                }
            }else{
                Toast.makeText(this, emailNotValidMessage, Toast.LENGTH_SHORT).show();
            }
        }else{
            Toast.makeText(this, passwordsNotMatch, Toast.LENGTH_SHORT).show();
        }
    }

    public boolean isEmailValid(CharSequence email) {
        return android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches();
    }

    private void startLoginActivityAfterRegistration(){
        Intent intent = new Intent(RegisterActivity.this, MainActivity.class);
        startActivity(intent);
        finish();
    }

    public void startLoginActivity(View view) {
        Intent intent = new Intent(RegisterActivity.this, MainActivity.class);
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