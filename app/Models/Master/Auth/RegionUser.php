<?php

namespace App\Models\Master\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionUser extends Model
{
    use HasFactory;

    protected $table = 'm_user_wilayah';
    protected $primaryKey = 'id_user_wilayah';

    protected $fillable = [
        'id_user',
        'id_negara',
        'id_provinsi',
        'id_kabupatenkota',
        'id_kecamatan',
        'type',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
