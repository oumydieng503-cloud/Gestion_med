<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Service;


class Reservation extends Model
{
    protected $fillable = [
        
        'user_id',
        'service_id',
        'date_reservation',
        'heure_reservation',
        'statut',
        'commentaire',
        'medecin_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function medecin()
    {
        return $this->belongsTo(User::class, 'medecin_id');
    }
    // Nouvelle relation : le profil complet du patient (table patients)
    public function patientProfil()
    {
        return $this->hasOneThrough(
            Patient::class, // On veut arriver à la table patients
            User::class,    // En passant par la table users
            'id',           // Clé sur users
            'user_id',      // Clé sur patients
            'user_id',      // Clé locale sur reservations
            'id'            // Clé locale sur users
        );
    }



}
