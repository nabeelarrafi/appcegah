<?php

namespace App\Models\Master\Region;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'm_kabupatenkota';
    protected $primaryKey = 'id_kabupatenkota';

    protected $fillable = [
        'id_provinsi',
        'name',
        'description',
        'created_by',
        'updated_by',
        'is_active'
    ];
}
