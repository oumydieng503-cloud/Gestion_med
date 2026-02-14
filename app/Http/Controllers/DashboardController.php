<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('dashboard.dashboardAdmin');
        }

        if ($user->role === 'medecin') {
            return view('dashboard.dashboardMedecin');
        }

        return view('dashboard.dashboardPatient');
    }



}
