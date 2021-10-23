<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Set up Relationships.
     */
    public function roles() {

    return $this->belongsToMany(Role::class, 'role_permissions');
        
    }

    public function users() {

    return $this->belongsToMany(User::class, 'user_permissions');
        
    }

}
