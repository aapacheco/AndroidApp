package com.CCSU.anthony.capstoneapp3;

import android.app.AlertDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;

public class RegisterActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
        final RequestQueue queue = Volley.newRequestQueue(RegisterActivity.this);
        final String registerUrl = "http://ec2-54-174-119-3.compute-1.amazonaws.com/registerUser.php";

        /* creates fields for the user to input information */

        final EditText etFName = (EditText) findViewById(R.id.etFName);
        final EditText etLName = (EditText) findViewById(R.id.etLName);
        final EditText etUsername = (EditText) findViewById(R.id.etUsername);
        final EditText etPassword = (EditText) findViewById(R.id.etPassword);

        /* creates a button to send the information to the database */
        final Button bRegister = (Button) findViewById(R.id.bRegister);

        bRegister.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {

                final Intent intent = new Intent(RegisterActivity.this, LoginActivity.class);
                final  AlertDialog.Builder builder = new AlertDialog.Builder(RegisterActivity.this);
                StringRequest rrequest = new StringRequest(Request.Method.POST, registerUrl, new Response.Listener<String>(){
                    @Override
                    public void onResponse(String response) {
                        Log.v(response, "Registration Response: ");
                        if((response.contains("Successful Registration")) || (response.contains("SR")) ||(response.contains("SR:Successful Registration")))
                        {
                            builder.setMessage("Successful Registration! ")
                                    .create()
                                    .show();
                            RegisterActivity.this.startActivity(intent);
                        }else{
                            if((response.contains("User Already Exists")) || (response.contains("UAE")) ||(response.contains("UAE:User Already Exists")))
                            {
                                builder.setMessage("User Already Exists... Try Different Credientals ")
                                        .setNegativeButton("Retry", null)
                                        .create()
                                        .show();
                            }else {
                                builder.setMessage("Registration Failed: \n Please check to make sure all fields have been filled out correctly. ")
                                        .setNegativeButton("Retry", null)
                                        .create()
                                        .show();
                            }
                        }

                    }
                }, new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError response) {

                    }
                }){
                    @Override
                    public Map<String, String> getParams() throws AuthFailureError {
                        Map<String, String> params = new HashMap<String, String>();
                            params.put("FirstName", etFName.getText().toString());
                            params.put("LastName", etLName.getText().toString());
                            params.put("Username", etUsername.getText().toString());
                            params.put("Password", etPassword.getText().toString());
                            Log.v(params.toString(), "VERBOSE params.put...");
                        return params;
                    }
                };
                queue.add(rrequest);

            }
        });
    }
}