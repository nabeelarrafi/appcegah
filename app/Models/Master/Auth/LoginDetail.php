<?php

namespace App\Models\Master\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginDetail extends Model
{
    use HasFactory;

    protected $table = 't_login_detail';
    protected $primaryKey = 'id_login_detail';

    protected $fillable = [
        'id_user',
        'ip_address',
        'mac_address',
        'token',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
