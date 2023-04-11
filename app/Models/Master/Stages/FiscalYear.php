<?php

namespace App\Models\Master\Stages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiscalYear extends Model
{
    use HasFactory;

    protected $table = 'm_tahun_anggaran';
    protected $primaryKey = 'id_tahun_anggaran';

    protected $fillable = [
        'name',
        'description',
        'created_by',
        'updated_by',
        'is_active'
    ];
}
