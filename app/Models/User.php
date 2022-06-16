<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'prenom',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }


    public function getFullnameAttribute()
    {
        return $this->name . " - " . $this->prenom;;
    }

    public function getRoleFAttribute()
    {

        return $this->name . " " . $this->prenom . "-" . $this->getRoleOptionAttribute()[$this->role_id];
    }

    public function getRoleTitleAttribute($attributes)
    {
        return  $this->getRoleOptionAttribute()[$this->role_id];
    }

    public function getRoleOptionAttribute()
    {
        return [
            1 => "-",
            2 => "secrétaire",
            3 => "Comptable",
            4 => "Auditeur",
            5 => "Commissaire aux comptes"
        ];
    }

    public function isAdmin()
    {
        return $this->role()->where('role', 'Admin')->first();
    }

    public function hasAnyRole($array)
    {
        return $this->role()->whereIn('role', $array)->first();
    }

    public function isSecretaire()
    {
        return $this->role()->where('role', 'Secrétaire')->first();
    }
}