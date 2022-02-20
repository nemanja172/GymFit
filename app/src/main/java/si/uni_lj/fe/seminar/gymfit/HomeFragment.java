package si.uni_lj.fe.seminar.gymfit;

import android.app.ProgressDialog;
import android.os.Bundle;

import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import java.util.HashMap;
import java.util.Map;


public class HomeFragment extends Fragment {

    private TextView ime, email;
    SessionManager sessionManager;

    public HomeFragment() {
        // Required empty public constructor
    }

    public static HomeFragment newInstance(String param1, String param2) {
        HomeFragment fragment = new HomeFragment();
        Bundle args = new Bundle();
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view =  inflater.inflate(R.layout.fragment_home, container, false);

        sessionManager = new SessionManager(getActivity());
        sessionManager.checkLogin();

        ime = view.findViewById(R.id.ime);
        email = view.findViewById(R.id.email);

        HashMap<String, String> user = sessionManager.getUserDetail();
        String mIme = user.get(sessionManager.IME);
        String mEmail = user.get(sessionManager.EMAIL);

        ime.setText(mIme);
        email.setText(mEmail);

        return view;
    }
}