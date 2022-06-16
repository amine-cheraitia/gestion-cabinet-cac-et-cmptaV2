<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the user that owns the Entreprise
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function RegimeFiscal()
    {
        return $this->belongsTo(RegimeFiscal::class, 'fiscal_id');
    }
    public function activiteType()
    {
        return $this->belongsTo(TypeActivite::class, 'activite_id');
    }
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function devis()
    {
        return $this->hasMany(Devis::class, 'entreprise_id');
    }
}