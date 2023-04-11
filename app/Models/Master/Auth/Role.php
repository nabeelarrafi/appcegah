<?php

namespace App\Models\Master\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'm_role';
    protected $primaryKey = 'id_role';

    protected $fillable = [
        'name',
        'description',
        'created_by',
        'updated_by',
        'is_active',
    ];

    public function user()
    {
        return $this->hasMany('App\Models\User', 'id_role', 'id_role');
    }
}
