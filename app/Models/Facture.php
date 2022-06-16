<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    protected $guarded;


    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'facture_id');
    }

    public function typefacture()
    {
        return $this->belongsTo(TypeFacture::class, 'type_facture_id');
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class, 'mission_id');
    }

    public function exercice()
    {
        return $this->belongsTo(Exercice::class, 'exercice_id');
    }

    public function factureAvoir()
    {
        return $this->belongsTo(Facture::class, 'fact_avoir_id');
    }
}