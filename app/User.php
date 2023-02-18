<?php

namespace App;

use App\Fine;
use App\Leave;
use App\Salary;
use App\Department;
use App\Designation;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use DarkGhostHunter\Larapass\WebAuthnAuthentication;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DarkGhostHunter\Larapass\Contracts\WebAuthnAuthenticatable;

class User extends Authenticatable implements WebAuthnAuthenticatable
{
    use Notifiable, HasRoles, WebAuthnAuthentication;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function designation(){
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }


    public function profile_img_path(){
        if($this->profile_img){
            return asset('storage/employee/' . $this->profile_img);
        }

        return null;
    }

    public function salaries(){
        return $this->hasMany(Salary::class, 'user_id', 'id');
    }

    public function fines(){
        return $this->hasMany(Fine::class, 'user_id', 'id');
    }

    public function leaves(){
        return $this->hasMany(Leave::class,'user_id','id');
    }

    
}
