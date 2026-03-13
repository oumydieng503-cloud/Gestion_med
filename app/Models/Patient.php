<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'medecin_id',
        'nom',
        'prenom',
        'date_naissance',
        'telephone',
        'adresse',
        'user_id',       
    ];

    // Un patient appartient à un médecin
    public function medecin()
    {
        return $this->belongsTo(User::class, 'medecin_id');
    }
    // Un patient appartient à un utilisateur (compte)
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
