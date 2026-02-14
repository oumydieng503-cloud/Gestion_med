<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // Afficher MES patients (médecin connecté)
    public function index()
    {
        $patients = Patient::where('medecin_id', Auth::id())->get();
        return view('medecin.patients.index', compact('patients'));
    }

    // Formulaire ajout patient
    public function create()
    {
        return view('medecin.patients.create');
    }

    // Enregistrer patient
    public function store(Request $request)
    {
        Patient::create([
            'medecin_id' => Auth::id(),
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
        ]);

        return redirect()->route('medecin.patients.index');
    }

    // Formulaire d'édition patient
    public function edit(Patient $patient)
    {
        // Vérifie que le médecin connecté est bien le propriétaire
        if ($patient->medecin_id !== Auth::id()) {
            abort(403);
        }

        return view('medecin.patients.edit', compact('patient'));
    }

    // Mettre à jour patient
    public function update(Request $request, Patient $patient)
    {
        if ($patient->medecin_id !== Auth::id()) {
            abort(403);
        }

        $patient->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
        ]);

        return redirect()->route('medecin.patients.index');
    }

    // Supprimer patient
    public function destroy(Patient $patient)
    {
        if ($patient->medecin_id !== Auth::id()) {
            abort(403);
        }

        $patient->delete();
        return redirect()->route('medecin.patients.index');
    }
}
