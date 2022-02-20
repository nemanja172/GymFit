package si.uni_lj.fe.seminar.gymfit;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.view.View;
import android.widget.Button;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.material.textfield.TextInputEditText;
import com.vishnusivadas.advanced_httpurlconnection.PutData;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;
import java.util.Objects;

public class Login extends AppCompatActivity {


    private TextInputEditText textInputEditTextEmail, textInputEditTextGeslo;
    private Button buttonLogin;
    private TextView textViewSignup;
    private ProgressBar progressBar;
    private static final String URL_LOGIN = "http://192.168.64.104/gymfitApp/login.php";
    SessionManager sessionManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        sessionManager = new SessionManager(this);

        textInputEditTextEmail = findViewById(R.id.email);
        textInputEditTextGeslo = findViewById(R.id.geslo);
        buttonLogin = findViewById(R.id.btnLogin);
        textViewSignup = findViewById(R.id.signUpText);
        progressBar = findViewById(R.id.progress);


        textViewSignup.setOnClickListener(v -> {
            Intent intent = new Intent(getApplicationContext(), Signup.class);
            startActivity(intent);
            finish();
        });
        buttonLogin.setOnClickListener(v -> {

            String email = Objects.requireNonNull(textInputEditTextEmail.getText()).toString().trim();
            String geslo = Objects.requireNonNull(textInputEditTextGeslo.getText()).toString().trim();

            if (!email.isEmpty() || !geslo.isEmpty()) {
                Login(email, geslo);
            } else {
                textInputEditTextEmail.setError("Prosim, unesite email!");
                textInputEditTextGeslo.setError("Prosim, unesite geslo!");
            }
        });
    }

    private void Login(String email, String geslo) {

        progressBar.setVisibility(View.VISIBLE);
        buttonLogin.setVisibility(View.GONE);

        StringRequest stringRequest = new StringRequest(Request.Method.POST, URL_LOGIN,
                response -> {
                    try {
                        //Toast.makeText(Login.this, response, Toast.LENGTH_SHORT).show();
                        JSONObject jsonObject = new JSONObject(response);

                        String success = jsonObject.getString("success");
                        JSONArray jsonArray = jsonObject.getJSONArray("login");

                        if (success.equals("1")) {
                            for (int i = 0; i < jsonArray.length(); i++)
                            {

                                JSONObject object = jsonArray.getJSONObject(i);

                                String ime = object.getString("Ime").trim();
                                String email1 = object.getString("Email").trim();
                                String id = object.getString("Id").trim();
                                String tel = object.getString("Tel").trim();
                                String spol = object.getString("Spol").trim();
                                String datum = object.getString("Datum").trim();
                                String priimek = object.getString("Priimek").trim();

                                sessionManager.createSession(ime, email1, id, datum, spol, tel, priimek);

                                Intent intent = new Intent(Login.this, MainActivity.class);
                                intent.putExtra("Ime", ime);
                                intent.putExtra("Email", email1);
                                intent.putExtra("Id", id);
                                /*intent.putExtra("Datum", datum);
                                intent.putExtra("Spol", spol);
                                intent.putExtra("Tel", tel);*/


                                startActivity(intent);

                                progressBar.setVisibility(View.GONE);
                            }
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                        progressBar.setVisibility(View.GONE);
                        buttonLogin.setVisibility(View.GONE);
                        Toast.makeText(Login.this, "Neuspesna prijava! " + e.toString(), Toast.LENGTH_SHORT).show();
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        progressBar.setVisibility(View.GONE);
                        buttonLogin.setVisibility(View.GONE);
                        Toast.makeText(Login.this, "Greska " + error.toString(), Toast.LENGTH_SHORT).show();
                    }
                }) {
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("email", email);
                params.put("geslo", geslo);
                return params;
            }
        };

        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }
}
