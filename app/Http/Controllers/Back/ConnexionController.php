<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
            return redirect()->intended(route('admin.tableau-bord'));
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

    public function update (Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mail' => 'required|email',
            'telephone' => 'required|string|max:255',
            'password' => 'nullable|string|max:255',
            'profil' => 'nullable|image',
        ]);

        $admin = User::findOrFail($id);

        $admin->name = $validated['name'];
        $admin->email = $validated['mail'];
        $admin->telephone = $validated['telephone'];

        if ($request->hasFile('profil')) {
            $admin->profil = $request->file('profil')->store('avatars', 'public');
        }

        if (!empty($validated['password'])) {
            $admin->password = Hash::make($validated['password']);
        }

        $admin->save();

        return redirect()->route('admin.setting')->with('success', 'Vos modifications ont été enregistrées.');
    }
}