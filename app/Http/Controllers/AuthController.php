<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('auth.login');
    }

    # public function login(Request $request)
    # {
    #    $credentials = $request->validate([
    #       'email' => 'required|email',
    #      'password' => 'required',
    # ]);
    #if (Auth::attempt($credentials)) {
    #   $request->session()->regenerate();
    #  return redirect('/dashboard');
    #}
    #return back()->withErrors([
    #   'email' => 'Identifiants incorrects.',
    #   ]);
    # }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ]);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'patient',
        ]);
        return redirect('/login')->with('success', 'Compte créé avec succès.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

// 1. Redirige vers la page de connexion Google
public function redirectToGoogle()
{
    return Socialite::driver('google')->redirect();
}

// 2. Google renvoie ici avec les infos du user
public function handleGoogleCallback()
{
    try {
        $googleUser = Socialite::driver('google')->user();
    } catch (\Exception $e) {
        return redirect('/login')->with('error', 'Connexion Google échouée.');
    }

    // Cherche si l'utilisateur existe déjà avec cet email
    // Sinon le crée automatiquement avec le rôle "patient"
    $user = User::firstOrCreate(
        ['email' => $googleUser->getEmail()],
        [
            'name'     => $googleUser->getName(),
            'password' => bcrypt(\Str::random(24)), // mot de passe aléatoire
            'role'     => 'patient', // par défaut patient
        ]
    );

    // Connecte l'utilisateur
    Auth::login($user);

    // Redirige selon son rôle (comme ton login normal)
    return match($user->role) {
        'admin'   => redirect('/admin/users'),
        'medecin' => redirect('/medecin/reservations'),
        default   => redirect('/patient/services'),
    };
}
}
