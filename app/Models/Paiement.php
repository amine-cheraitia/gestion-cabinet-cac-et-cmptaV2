<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function facture()
    {
        return $this->belongsTo(Facture::class, 'facture_id');
    }

    public function typepaiement()
    {
        return $this->belongsTo(TypePaiement::class, 'type_paiement_id');
    }
}