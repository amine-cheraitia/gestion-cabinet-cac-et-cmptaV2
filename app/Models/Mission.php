<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;
    protected $fillable = [
        "devis_id",
        "entreprise_id",
        "prestation_id",
        "color",
        "textColor",
        "allDay",
        "status",
        "start",
        "end",
        "title",
        'num_missions',
        'total'
    ];
    protected $guarded = [];

    /**
     * Get the entreprise that owns the Mission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'entreprise_id');
    }

    public function prestation()
    {
        return $this->belongsTo(Prestation::class, 'prestation_id');
    }

    public function mandat()
    {
        return $this->hasOne(Mandat::class, 'mission_id');
    }

    public function convention()
    {
        return $this->hasOne(Convention::class, 'mission_id');
    }


    public function factures()
    {
        return $this->hasMany(Facture::class, 'mission_id');
    }

    public function getRaisonSocialAttribute($value)
    {
        return ucfirst($value);
    }
    public function getStatusIntAttribute()
    {
        return [
            0 => '<span class="badge badge-pill badge-warning">En cours</span>',
            1 => '<span class="badge badge-pill badge-success">Achevé</span>'
        ][$this->status];
    }
    public function getStatustxtAttribute()
    {
        return [
            0 => 'En cours',
            1 => 'Achevé'
        ][$this->status];
    }

    public function getEndeAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['end'])->format('d-m-Y H:i:s');
    }

    public function getStarteAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['start'])->format('d-m-Y H:i:s');
    }

    /*    public function getStatusAttribute($attribue)
    {


        /*         if(){
            '';

        }else{
                '<span class="badge bg-warning text-dark">En cours';
        } */
    /*} */

    /*    public function setStartAttribue(){
        return Carbon\Carbon::format('html');
    } */
}