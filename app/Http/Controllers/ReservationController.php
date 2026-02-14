<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('service', 'medecin', 'patient.medecin')->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    public function create($serviceId)
    {
        if (auth()->user()->role !== 'patient') {
            return redirect()->back()->with('error', 'Seuls les patients peuvent réserver.');
        }

        $service = Service::findOrFail($serviceId);
        return view('patient.reservations.create', compact('service'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'date_reservation' => 'required|date|after_or_equal:today',
            'heure_reservation' => 'required',
            'commentaire' => 'nullable|string',
        ]);
        // $validated['user_id'] = auth()->id();
        $validated['user_id'] = Auth::id();
        $validated['statut'] = 'en_attente';
        Reservation::create($validated);
        return redirect('/mes-reservations')
            ->with('success', 'Réservation enregistrée.');
    }
    public function myReservations()
    {
        $reservations = Reservation::with(['service', 'medecin'])
            ->where('user_id', auth()->id())
            ->get();

        // $reservations = Reservation::with('service')
        //->where('user_id', Auth::id())
        // ->where('user_id', auth()->id())
        // ->get();
        return view('patient.reservations.index', compact('reservations'));
    }
   
    public function medecinReservations()
    {
       $reservations = Reservation::with(['service','patient'])
    ->where('medecin_id', auth()->id())
    ->get();
    }
    public function confirm($id)
{
    $reservation = Reservation::findOrFail($id);

    if ($reservation->medecin_id !== auth()->id()) {
        abort(403);
    }

    $reservation->update(['statut' => 'confirmee']);

    return back()->with('success', 'Rendez-vous confirmé');
}



    // public function index()
    // {
    //    $reservations = Reservation::with('service', 'user')->get();
    //    return view('reservations.index', compact('reservations'));
    //}



    // 3. Enregistrer un nouvel utilisateur


    // 4. Formulaire pour éditer un utilisateur
    public function edit(Reservation $reservation)
    {
        $medecins = User::where('role', 'medecin')->get();
        return view('admin.reservations.edit', compact('reservation', 'medecins'));
    }

    // 5. Mettre à jour l’utilisateur
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            //'user_id' => 'required|int',
            //'service_id' => 'required|int,'.$reservation->id,
            'date_reservation' => 'required|date|after_or_equal:today',
            'heure_reservation' => 'required|date_format:H:i',
            'statut' => 'required|in:en_attente,confirmee,annulee,effectuee',
            'commentaire' => 'nullable|string',
            'medecin_id' => 'nullable|exists:users,id',

        ]);

        $reservation->update([
            //'user_id' => $request->user_id,
            //'service_id' => $request->service_id,
            'statut' => $request->statut,
            'date_reservation' => $request->date_reservation,
            'heure_reservation' => $request->heure_reservation,
            'commentaire' => $request->commentaire,
            'medecin_id' => $request->medecin_id,

        ]);

        return redirect()->route('admin.reservations.index')->with('success', 'Réservation mise à jour !');
    }

    // 6. Supprimer un utilisateur
    public function destroy(Reservation $reservation)
{
    $reservation->delete();

    return redirect()->route('admin.reservations.index')
        ->with('success', 'Réservation supprimée !');
}

    public function cancel($id)
{
    $reservation = Reservation::findOrFail($id);

    if ($reservation->user_id != auth()->id()) {
        abort(403);
    }

    if ($reservation->statut !== 'en_attente') {
        return back()->with('error', 'Impossible d’annuler cette réservation.');
    }

    $reservation->update([
        'statut' => 'annulee'
    ]);

    return back()->with('success', 'Réservation annulée.');
}
public function updateStatus(Request $request, Reservation $reservation)
{
    if ($reservation->medecin_id != auth()->id()) {
        abort(403);
    }

   // $reservation->update([
     //   'statut' => $request->statut
       $request->validate([
    'statut' => 'required|in:confirmee,effectuee'
]);
$reservation->update([
    'statut' => $request->statut
    ]);

    return back()->with('success', 'Statut mis à jour.');
}


}
