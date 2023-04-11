<?php

namespace App\Models\Master\Region;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $table = 'm_sekolah';
    protected $primaryKey = 'id_sekolah';

    protected $fillable = ['name', 'description', 'npsn', 'jenjang', 'status', 'created_by', 'updated_by', 'is_active', 'id_kabupatenkota'];
}
