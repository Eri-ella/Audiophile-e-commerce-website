<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ConnexionController extends Controller
{
    public function showLoginForm() {
        return view('admin.connexion_admin');
    }

    public function login(Request $request) {
        $validated = $request->validate([
            "mail" => ['required', 'email'],
            "passe" => ['required', 'string']
        ]);

        if (Auth::attempt([
            "email" => $validated['mail'],
            "password" => $validated['passe'],
            "role" => 'admin',
        ], $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin'));
        } return back()->withErrors([
            'email' => 'Mot de passe ou identifiant incorrect',
        ])->onlyInput('email');

    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('connexion-admin.form');
    }
}