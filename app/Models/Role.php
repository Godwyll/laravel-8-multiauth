<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    /**
     * Model Relationships.
     */
    public function permissions() {

        return $this->belongsToMany(Permission::class, 'role_permissions');
            
     }
     
     public function users() {
     
        return $this->belongsToMany(User::class, 'user_roles');
            
     }

}
