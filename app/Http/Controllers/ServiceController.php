<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ServiceController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | MÉDECIN : Voir uniquement ses services
    |--------------------------------------------------------------------------
    */

    public function medecinIndex()
    {
        $services = Service::where('medecin_id', auth()->id())->get();
        return view('medecin.services.index', compact('services'));
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN : CRUD COMPLET SERVICES
    |--------------------------------------------------------------------------
    */

    // Voir tous les services
    public function adminIndex()
    {
        $services = Service::with('medecin')->get();
        return view('admin.services.index', compact('services'));
    }

    // Formulaire création
    public function adminCreate()
    {
        $medecins = \App\Models\User::where('role', 'medecin')->get();
        return view('admin.services.create', compact('medecins'));
    }

    // Enregistrer
    public function adminStore(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'nullable',
            'prix' => 'required|numeric',
            'duree' => 'required|integer',
            'medecin_id' => 'required|exists:users,id',
        ]);

        Service::create($request->all());

        return redirect()->route('admin.services.index')
            ->with('success', 'Service créé avec succès');
    }

    // Editer
    public function adminEdit(Service $service)
    {
        $medecins = \App\Models\User::where('role', 'medecin')->get();
        return view('admin.services.edit', compact('service','medecins'));
    }

    // Mettre à jour
    public function adminUpdate(Request $request, Service $service)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'nullable',
            'prix' => 'required|numeric',
            'duree' => 'required|integer',
            'medecin_id' => 'required|exists:users,id',
        ]);

        $service->update($request->all());

        return redirect()->route('admin.services.index')
            ->with('success', 'Service modifié avec succès');
    }

    // Supprimer
    public function adminDestroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service supprimé');
    }
}
