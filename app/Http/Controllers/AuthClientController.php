<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthClientController extends Controller
{
    // afficher le formulaire d'inscription 
    public function showregisterForm()
    {
        return view("client.register");
    }

    //Inscription 
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Client::create([
            'name'=>$request->name,
            "prenom" => $request->prenom,
            "email" => $request-> email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('client.login')->with('success', 'Inscription reussie ! Connectez-vous');
    }

    //afficher le formulaire de connexion 
    public function showLoginForm()
    {
        return view('client.login');
    }

    //connexion
    public function login(Request $request) 
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Récupérer les credentials
        $credentials = $request->only('email', 'password');

        // Tenter l'authentification
        if (Auth::guard('clients')->attempt($credentials)) {
            // Regénérer la session après connexion
            $request->session()->regenerate();

            //Verifecation apres connexion 
            // dd(Auth::guard('clients')->user());
            
          

           return redirect()->route('accueil');
        }

        return back()->withErrors(['email' => 'Identifiants incorrects']);
    }


    // Deconnexion
    public function logout(Request $request)
    {
        auth()->guard('clients')->logout();
        return redirect()->route('client.login');
    }

    // Tableau de bord
    // public function dashboard()
    // {
    //     if (!session('client')) {
    //         return redirect()->route('client.login.form');
    //     }

    //     return view('client.dashboard', ['client' => session('client')]);
    // }
}
