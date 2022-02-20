package si.uni_lj.fe.seminar.gymfit;

import android.content.Intent;
import android.os.Handler;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
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

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;
import java.util.Objects;

public class Signup extends AppCompatActivity {

    TextInputEditText textInputEditTextIme, textInputEditTextPriimek, textInputEditTextGeslo, textInputEditTextDatum, textInputEditTextSpol, textInputEditTextTel, textInputEditTextEmail;
    Button buttonSignUp;
    TextView textViewLogin;
    ProgressBar progressBar;
    public static String URL_REGIST = "http://192.168.64.104/gymfitApp/signup.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup);

        textInputEditTextIme = findViewById(R.id.ime);
        textInputEditTextPriimek = findViewById(R.id.priimek);
        textInputEditTextGeslo = findViewById(R.id.geslo);
        textInputEditTextDatum = findViewById(R.id.datum);
        textInputEditTextSpol = findViewById(R.id.spol);
        textInputEditTextTel = findViewById(R.id.tel);
        textInputEditTextEmail = findViewById(R.id.email);
        buttonSignUp = findViewById(R.id.buttonSignUp);
        textViewLogin = findViewById(R.id.loginText);
        progressBar = findViewById(R.id.progress);


        textViewLogin.setOnClickListener(v -> {
            Intent intent = new Intent(getApplicationContext(), Login.class);
            startActivity(intent);
            finish();
        });
        buttonSignUp.setOnClickListener(v -> {
            Regist();
        });
    }

    private void Regist(){
        progressBar.setVisibility(View.VISIBLE);
        buttonSignUp.setVisibility(View.GONE);

        final String ime = Objects.requireNonNull(this.textInputEditTextIme.getText()).toString().trim();
        final String priimek = Objects.requireNonNull(this.textInputEditTextPriimek.getText()).toString().trim();
        final String geslo = Objects.requireNonNull(this.textInputEditTextGeslo.getText()).toString().trim();
        final String datum = Objects.requireNonNull(this.textInputEditTextDatum.getText()).toString().trim();
        final String spol = Objects.requireNonNull(this.textInputEditTextSpol.getText()).toString().trim();
        final String tel = Objects.requireNonNull(this.textInputEditTextTel.getText()).toString().trim();
        final String email = Objects.requireNonNull(this.textInputEditTextEmail.getText()).toString().trim();

        if(!ime.equals("") && !priimek.equals("") && !geslo.equals("") && !datum.equals("") && !spol.equals("") && !tel.equals("") && !email.equals("")) {
            StringRequest stringRequest = new StringRequest(Request.Method.POST, URL_REGIST,
                    new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            try {
                                Toast.makeText(Signup.this, response, Toast.LENGTH_SHORT).show();
                                JSONObject jsonObject = new JSONObject(response);
                                String success = jsonObject.getString("Success");

                                if (success.equals("1")) {
                                    Toast.makeText(Signup.this, "Uspesna registracija", Toast.LENGTH_SHORT).show();
                                }
                            } catch (JSONException e) {
                                e.printStackTrace();
                                Toast.makeText(Signup.this, "Neuspesna registracija! " + e.toString(), Toast.LENGTH_SHORT).show();
                                progressBar.setVisibility(View.GONE);
                                buttonSignUp.setVisibility(View.VISIBLE);
                            }
                        }
                    },
                    new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            Toast.makeText(Signup.this, "Neuspesna registracija! " + error.toString(), Toast.LENGTH_SHORT).show();
                            progressBar.setVisibility(View.GONE);
                            buttonSignUp.setVisibility(View.VISIBLE);

                        }
                    }) {
                @Nullable
                @Override
                protected Map<String, String> getParams() throws AuthFailureError {
                    Map<String, String> params = new HashMap<>();
                    params.put("ime", ime);
                    params.put("priimek", priimek);
                    params.put("geslo", geslo);
                    params.put("Datum_rojstva", datum);
                    params.put("Spol", spol);
                    params.put("Tel_stevilka", tel);
                    params.put("email", email);
                    return params;
                }
            };
            RequestQueue requestQueue = Volley.newRequestQueue(this);
            requestQueue.add(stringRequest);
        }

        else{
            Toast.makeText(this, "Vsa polja so obvezna", Toast.LENGTH_SHORT).show();
        }
    }

}



