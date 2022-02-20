package si.uni_lj.fe.seminar.gymfit;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;

import java.util.HashMap;

public class SessionManager {
    SharedPreferences sharedPreferences;
    public SharedPreferences.Editor editor;
    public Context context;
    int PRIVATE_MODE = 0;

    private static final String PREF_NAME = "LOGIN";
    private static final String LOGIN = "IS_LOGIN";
    public static final String IME = "IME";
    public static final String EMAIL = "EMAIL";
    public static final String ID = "ID";
    public static final String DATUM = "DATUM";
    public static final String SPOL = "SPOL";
    public static final String TEL = "TEL";
    public static final String PRIIMEK = "PRIIMEK";



    public SessionManager(Context context){
        this.context = context;
        sharedPreferences = context.getSharedPreferences(PREF_NAME, PRIVATE_MODE);
        editor = sharedPreferences.edit();
    }

    public void createSession(String ime, String email, String id, String datum, String spol, String tel, String priimek){
        editor.putBoolean(LOGIN,true);
        editor.putString(IME,ime);
        editor.putString(EMAIL,email);
        editor.putString(ID,id);
        editor.putString(DATUM,datum);
        editor.putString(SPOL,spol);
        editor.putString(TEL,tel);
        editor.putString(PRIIMEK,priimek);
        editor.apply();
    }

    public boolean isLogin(){
        return sharedPreferences.getBoolean(LOGIN, false);
    }

    public void checkLogin(){
        if (!this.isLogin()) {
            Intent i = new Intent(this.context, Login.class);
            this.context.startActivity(i);
            ((MainActivity) this.context).finish();
        }
    }

    public HashMap<String, String> getUserDetail() {
        HashMap<String, String> user = new HashMap<>();
        user.put(IME, sharedPreferences.getString(IME, null));
        user.put(EMAIL, sharedPreferences.getString(EMAIL, null));
        user.put(ID, sharedPreferences.getString(ID, null));
        user.put(DATUM, sharedPreferences.getString(DATUM, null));
        user.put(SPOL, sharedPreferences.getString(SPOL, null));
        user.put(TEL, sharedPreferences.getString(TEL, null));
        user.put(PRIIMEK, sharedPreferences.getString(PRIIMEK, null));
        return user;
    }

    public void logout(){
        editor.clear();
        editor.commit();
        Intent i = new Intent(context, Login.class);
        context.startActivity(i);
        ((MainActivity) context).finish();
    }
}
