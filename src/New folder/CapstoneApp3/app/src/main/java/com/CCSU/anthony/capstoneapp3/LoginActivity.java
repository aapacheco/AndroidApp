package com.CCSU.anthony.capstoneapp3;

import android.app.AlertDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;

public class LoginActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        final RequestQueue queue = Volley.newRequestQueue(LoginActivity.this);
        final String loginUrl = "http://ec2-54-174-119-3.compute-1.amazonaws.com/loginUser.php";

        final EditText etUsername = (EditText) findViewById(R.id.etUsername);
        final EditText etPassword = (EditText) findViewById(R.id.etPassword);
        final Button bLogin = (Button) findViewById(R.id.bLogin);
        final TextView registerLink = (TextView) findViewById(R.id.tvRegisterHere);
        registerLink.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent registerIntent = new Intent(LoginActivity.this, RegisterActivity.class);
                LoginActivity.this.startActivity(registerIntent);
            }
        });

        bLogin.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {
                final AlertDialog.Builder builder = new AlertDialog.Builder(LoginActivity.this);
                final Intent intent = new Intent(LoginActivity.this, UserAreaActivity.class);
                final StringRequest lrequest = new StringRequest(Request.Method.POST, loginUrl, new Response.Listener<String>()
                {
                    @Override
                    public void onResponse(String response)
                    {
                        Log.v(response, "Server Response");
                        if((response.contains("Successful Login")) || (response.contains("SL")) ||(response.contains("SL:Successful Login")))
                        {
                            builder.setMessage("Successful Login! ")
                                    .create()
                                    .show();
                            LoginActivity.this.startActivity(intent);

                        }else{
                            Log.v(response, "Server Response");
                            builder.setMessage("Login Failed: \n Invalid Credentials....\t Please check to make sure all fields have been filled out correctly. ")
                                    .setNegativeButton("Retry", null)
                                    .create()
                                    .show();
                        }
                    }
                },
                        new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError response) {
                            }
                        })
                {
                    @Override
                    public Map<String, String> getParams() throws AuthFailureError {
                        Map<String, String> params = new HashMap<String, String>();
                            params.put("Username", etUsername.getText().toString());
                            params.put("Password", etPassword.getText().toString());
                        return params;
                    }
                };
                queue.add(lrequest);
            }
        });
    }
}
