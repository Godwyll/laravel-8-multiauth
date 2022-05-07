<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'user_id', 'created_by',
    ];
        
    /**
     * Model Relationships.
     */   
    public function role()
    {
        return $this->belongsTo(Role::class);
    }    
    public function user()
    {
        return $this->belongsTo(User::class);
    }    
    
}
