<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Admin extends Authenticatable
{
    use Notifiable, HasPermissionsTrait, SoftDeletes, CascadeSoftDeletes;

    protected $guard = 'admin';

    protected $hidden = [
        'password',
    ];        

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'username', 'email', 'password',
    ];

    /**
     * Model Relationships.
     */

    /**
     * Model Methods.
     */   
    public function fullname()
    {
        return $this->firstname .' '.$this->lastname;
    }

}
