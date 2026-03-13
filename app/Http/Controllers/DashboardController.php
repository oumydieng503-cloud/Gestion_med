<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Reservation;
class DashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();

    if ($user->role === 'admin') {
        $stats = [
            'total_users'        => User::count(),
            'total_medecins'     => User::where('role', 'medecin')->count(),
            'total_patients'     => User::where('role', 'patient')->count(),
            'total_reservations' => Reservation::count(),
            'en_attente'         => Reservation::where('statut', 'en_attente')->count(),
            'confirmees'         => Reservation::where('statut', 'confirmee')->count(),
            'annulees'           => Reservation::where('statut', 'annulee')->count(),
            'effectuees'         => Reservation::where('statut', 'effectuee')->count(),
            'dernieres_reservations' => Reservation::with(['user', 'service'])
                                        ->latest()->take(5)->get(),
        ];
        return view('dashboard.dashboardAdmin', compact('stats'));
    }

    if ($user->role === 'medecin') {
    $stats = [
        'total_patients'    => \App\Models\Reservation::where('medecin_id', $user->id)
                                ->distinct('user_id')->count('user_id'),
        'en_attente'        => \App\Models\Reservation::where('medecin_id', $user->id)
                                ->where('statut', 'en_attente')->count(),
        'confirmees'        => \App\Models\Reservation::where('medecin_id', $user->id)
                                ->where('statut', 'confirmee')->count(),
        'effectuees'        => \App\Models\Reservation::where('medecin_id', $user->id)
                                ->where('statut', 'effectuee')->count(),
        'prochains_rdv'     => \App\Models\Reservation::with(['user', 'service'])
                                ->where('medecin_id', $user->id)
                                ->where('statut', 'confirmee')
                                ->where('date_reservation', '>=', today())
                                ->orderBy('date_reservation')
                                ->take(5)->get(),
    ];
    return view('dashboard.dashboardMedecin', compact('stats'));
}

// Patient
$stats = [
    'total_reservations' => \App\Models\Reservation::where('user_id', $user->id)->count(),
    'en_attente'         => \App\Models\Reservation::where('user_id', $user->id)
                            ->where('statut', 'en_attente')->count(),
    'confirmees'         => \App\Models\Reservation::where('user_id', $user->id)
                            ->where('statut', 'confirmee')->count(),
    'mes_rdv'            => \App\Models\Reservation::with(['service', 'medecin'])
                            ->where('user_id', $user->id)
                            ->whereIn('statut', ['en_attente', 'confirmee'])
                            ->orderBy('date_reservation')
                            ->take(5)->get(),
];
return view('dashboard.dashboardPatient', compact('stats'));

}



}
