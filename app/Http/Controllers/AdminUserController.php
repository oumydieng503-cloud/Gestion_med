<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // 1. Afficher tous les utilisateurs
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // 2. Formulaire pour créer un nouvel utilisateur
    public function create()
    {
        return view('admin.users.create');
    }

    // 3. Enregistrer un nouvel utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|string|in:admin,medecin,patient',
            'medecin_id' => 'nullable|exists:users,id',
            
        ]);
        

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur ajouté avec succès !');
    }

    // 4. Formulaire pour éditer un utilisateur
    public function edit(User $user)
    {
        $medecins = User::where('role', 'medecin')->get();
        return view('admin.users.edit', compact('user', 'medecins'));

    }

    // 5. Mettre à jour l’utilisateur
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'medecin_id' => 'nullable|exists:users,id',
            'role' => 'required|string|in:admin,medecin,patient'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'medecin_id' => $request->role === 'patient'
                ? $request->medecin_id
                : null,
            //'medecin_id' => $request->medecin_id,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Patient mis à jour !');
    }

    // 6. Supprimer un utilisateur
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé !');
    }
}
