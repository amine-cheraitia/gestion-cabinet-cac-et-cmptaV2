<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;
    protected $fillable = [
        "designation",
        "title",
        "start",
        "end",
        "allDay",
        "color",
        "textColor",
        "status",
        "mission_id",
        "user_id",
        'num_tache',
    ];
    /* protected $dateFormat = 'd-m-Y H:i:s'; */
    /*     protected $casts = [
        'start' => 'datetime:d-m-Y H:i:s',
        'end' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s',
        'created_at' => 'datetime:d-m-Y H:i:s',
    ]; */

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class, 'mission_id');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'tache_id');
    }

    public function getStatusIntAttribute()
    {
        return [
            0 => '<span class="badge bg-warning text-dark">En cours</span>',
            1 => '<span class="badge bg-success">Achevé</span>'
        ][$this->status];
    }
    public function getStatustxtAttribute()
    {
        return [
            0 => 'En cours',
            1 => 'Achevé'
        ][$this->status];
    }
    /*     public function setStartAttribute($value)
    {
        $this->attributes['start'] = Carbon::parse($value)->format('Y-m-d H:i:s'); // Carbon::createFromFormat('d-m-Y H:i:s', $value)->format('Y-m-d H:i:s')
    } */

    public function getStarteAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['start'])->format('d-m-Y H:i:s');
    }
    //end a revoir
    /* public function setEndAttribute($value)
    {
        $this->attributes['end'] = Carbon::parse($value)->format('Y-m-d H:i:s');  //Carbon::createFromFormat('d-m-Y H:i:s', $value)->format('Y-m-d H:i:s');
    } */

    public function getEndeAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['end'])->format('d-m-Y H:i:s');
    }
}