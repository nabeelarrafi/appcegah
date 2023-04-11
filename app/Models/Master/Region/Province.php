<?php

namespace App\Models\Master\Region;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'm_provinsi';
    protected $primaryKey = 'id_provinsi';

    protected $fillable = ['name', 'description', 'created_by', 'updated_by', 'is_active', 'id_negara'];
}
