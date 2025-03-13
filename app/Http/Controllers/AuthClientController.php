<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
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

        $client = Client::where('email', $request->email)->first();

        if($client && Hash::check($request->password, $client->password)) {
            session(['client'=> $client]);

            return redirect()->route('accueil');
        }

        return back()->withErrors(['email' => 'Identifiants incorrects']);
    
    }

    // Deconnexion
    public function logout(Request $request)
    {
        // supprimer la sessoin du client
        $request->session()->forget('client');
        
        // INvalider la session  laravel 
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect vers la page d'accueil apres a Deconnexion

        return redirect()->route('accueil')->with('success', 'Deconnexion resussie.');
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
