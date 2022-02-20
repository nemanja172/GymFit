package si.uni_lj.fe.seminar.gymfit;

import android.app.ProgressDialog;
import android.os.Bundle;

import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.material.textfield.TextInputEditText;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;


public class ProfileFragment extends Fragment {

    private static final String TAG = ProfileFragment.class.getSimpleName();
    TextInputEditText ime, priimek, geslo, datum, spol, tel, email;
    Button buttonUpdate;
    String getId;
    SessionManager sessionManager;
    private static final String URL_READ = "http://192.168.64.104/gymfitApp/update.php";


    public ProfileFragment() {
        // Required empty public constructor
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_profile, container, false);

        sessionManager = new SessionManager(getActivity());
        sessionManager.checkLogin();

        ime = view.findViewById(R.id.ime);
        priimek = view.findViewById(R.id.priimek);
        geslo = view.findViewById(R.id.geslo);
        datum = view.findViewById(R.id.datum);
        spol = view.findViewById(R.id.spol);
        tel = view.findViewById(R.id.tel);
        email = view.findViewById(R.id.email);
        buttonUpdate = view.findViewById(R.id.buttonUpdate);

        HashMap<String, String> user = sessionManager.getUserDetail();
        getId = user.get(sessionManager.ID);

        return view;
    }

    private void getUserDetail(){

        final ProgressDialog progressDialog = new ProgressDialog(getActivity());
        progressDialog.setMessage("Loading..");
        progressDialog.show();

        StringRequest stringRequest = new StringRequest(Request.Method.POST, URL_READ, response -> {
            progressDialog.dismiss();
            Log.i(TAG, response);


            try{
                JSONObject jsonObject = new JSONObject(response);
                String success = jsonObject.getString("success");
                JSONArray jsonArray = jsonObject.getJSONArray("read");

                if (success.equals("1")) {
                    for (int i = 0; i < jsonArray.length(); i++) {

                        JSONObject object = jsonArray.getJSONObject(i);

                        String strime = object.getString("Ime").trim();
                        String stremail = object.getString("Email").trim();
                        String strtel = object.getString("Tel").trim();
                        String strspol = object.getString("Spol").trim();
                        String strdatum = object.getString("Datum").trim();
                        String strpriimek = object.getString("Priimek").trim();

                        ime.setText(strime);
                        email.setText(stremail);
                        tel.setText(strtel);
                        spol.setText(strspol);
                        datum.setText(strdatum);
                        priimek.setText(strpriimek);
                    }
                }
            } catch (JSONException e){
                e.printStackTrace();
                progressDialog.dismiss();
                Toast.makeText(getActivity(), "Error reading detail "+e.toString(), Toast.LENGTH_SHORT).show();
            }
        },
                error -> {
                    progressDialog.dismiss();
                    Toast.makeText(getActivity(), "Error reading details: "+error.toString(), Toast.LENGTH_SHORT).show();
                })
        {
            @Nullable
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("ID_uporabnika", getId);
                return params;
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(getActivity());
        requestQueue.add(stringRequest);
    }

    @Override
    public void onResume() {
        super.onResume();
        getUserDetail();
    }
}