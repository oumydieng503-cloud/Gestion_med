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
    ];

    // Un patient appartient à un médecin
    public function medecin()
    {
        return $this->belongsTo(User::class, 'medecin_id');
    }
}
