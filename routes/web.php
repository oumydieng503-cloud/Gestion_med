<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as C;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ServiceController;

/*
|--------------------------------------------------------------------------
| ROUTES PUBLIQUES
|--------------------------------------------------------------------------
*/

// Page d’accueil
Route::get('/', function () {
    return view('welcome');
});

// Services visibles sans connexion
Route::get('/services', [C\ServiceController::class, 'index']);
Route::get('/services/{id}', [C\ServiceController::class, 'show']);

// Authentification
Route::get('/login', [C\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [C\AuthController::class, 'login']);
Route::post('/logout', [C\AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/register', [C\AuthController::class, 'showRegister']);
Route::post('/register', [C\AuthController::class, 'register'])->name('register');
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgot-password');



/*
|--------------------------------------------------------------------------
| DASHBOARD COMMUN
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [C\DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| ROUTES PATIENT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:patient'])->group(function () {

    // Voir les services
    Route::get('/patient/services', function () {
        $services = \App\Models\Service::all();
        return view('patient.services.index', compact('services'));
    })->name('patient.services.index');

    // Créer réservation
    Route::get('/reservations/create/{service_id}', [C\ReservationController::class, 'create'])
        ->name('reservations.create');

    Route::post('/reservations', [C\ReservationController::class, 'store'])
        ->name('reservations.store');

    // Voir ses réservations
    Route::get('/mes-reservations', [C\ReservationController::class, 'myReservations'])
        ->name('reservations.myReservations');

    // Annuler si en_attente
    Route::post('/reservations/{id}/cancel', [C\ReservationController::class, 'cancel'])
        ->name('reservations.cancel');
});


/*
|--------------------------------------------------------------------------
| ROUTES MEDECIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:medecin'])->group(function () {

    // Voir ses services
    Route::get('/medecin/services', [ServiceController::class, 'medecinIndex'])
        ->name('medecin.services.index');

    // Voir ses réservations
    Route::get('/medecin/reservations', [C\ReservationController::class, 'medecinReservations'])
        ->name('medecin.reservations');

    // Modifier statut réservation
    Route::put('/medecin/reservations/{reservation}/status',
        [C\ReservationController::class, 'updateStatus'])
        ->name('medecin.reservations.updateStatus');

    // Confirmer réservation
    Route::post('/medecin/reservations/{id}/confirm',
        [C\ReservationController::class, 'confirm'])
        ->name('medecin.reservations.confirm');
});


/*
|--------------------------------------------------------------------------
| ROUTES ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard admin
    Route::get('/dashboard/admin', function () {
        return view('dashboard.dashboardAdmin');
    });

    /*
    |------------------------
    | Gestion Utilisateurs
    |------------------------
    */
    Route::get('/admin/users', [C\AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [C\AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [C\AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [C\AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [C\AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [C\AdminUserController::class, 'destroy'])->name('admin.users.destroy');

    /*
    |------------------------
    | Gestion Services (CRUD complet)
    |------------------------
    */
    Route::get('/admin/services', [ServiceController::class, 'adminIndex'])
        ->name('admin.services.index');

    Route::get('/admin/services/{service}/edit', [ServiceController::class, 'adminEdit'])
        ->name('admin.services.edit');

    Route::put('/admin/services/{service}', [ServiceController::class, 'adminUpdate'])
        ->name('admin.services.update');

    Route::delete('/admin/services/{service}', [ServiceController::class, 'adminDestroy'])
        ->name('admin.services.destroy');

    /*
    |------------------------
    | Gestion Réservations
    |------------------------
    */
    Route::get('/admin/reservations', [C\ReservationController::class, 'index'])
        ->name('admin.reservations.index');

    Route::get('/admin/reservations/{reservation}/edit',
        [C\ReservationController::class, 'edit'])
        ->name('admin.reservations.edit');

    Route::put('/admin/reservations/{reservation}',
        [C\ReservationController::class, 'update'])
        ->name('admin.reservations.update');

    Route::delete('/admin/reservations/{reservation}',
        [C\ReservationController::class, 'destroy'])
        ->name('admin.reservations.destroy');
    Route::get('/admin/services/create', [ServiceController::class, 'adminCreate'])
    ->name('admin.services.create');

    Route::post('/admin/services', [ServiceController::class, 'adminStore'])
    ->name('admin.services.store');

});
