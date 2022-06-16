<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded;
    protected $filliable = ['id', 'role'];

    public function getRolenameAttribute()
    {

        /* return $this->getRoleOptionAttribute()[$this->id]; */
    }

    /*     public function getRoleAttribute($attributes)
    {
        return [
            0 => "",
            1 => "secrétaire",
            2 => "Comptable",
            3 => "Auditeur",
            4 => "Commissaire aux comptes"
        ][$attributes];
    } */



    public function getRoleOption()
    {
        return [
            1 => "",
            2 => "secrétaire",
            3 => "Comptable",
            4 => "Auditeur",
            5 => "Commissaire aux comptes"
        ];
    }
}