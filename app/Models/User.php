<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',
        'last_logon_on',
        'role_id',
        'is_admin',
        'status',
        'email_verified_at',
        'employee_id',
        'backend_id',
        'is_horizontal',
        'is_light'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function sidebar()
    {
        return $this->belongsTo(Role::class);
    }

    public function getFullNameAttribute()
    {
        $full_name = $this->first_name . ' ' . $this->last_name;
        return $full_name;
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }

    public function backend()
    {
        return $this->hasOne(backend::class, 'id', 'backend_id');
    }
}
