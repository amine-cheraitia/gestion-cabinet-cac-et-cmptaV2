<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;
    protected $fillable = ["id", "num_devis", "date_devis", "exercice_id", "entreprise_id", "prestation_id", "total"];

    /**
     * Get the user that owns the Devis
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exercice()
    {
        return $this->belongsTo(Exercice::class, 'exercice_id');
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'entreprise_id');
    }

    public function prestation()
    {
        return $this->belongsTo(Prestation::class, 'prestation_id');
    }

    public function missions()
    {
        return $this->hasMany(Mission::class, 'devis_id');
    }
}