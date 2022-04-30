<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'permission_id', 'user_id',
    ];
        
    /**
     * Model Relationships.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }    

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }    

    public function user()
    {
        return $this->belongsTo(User::class);
    }    

}
