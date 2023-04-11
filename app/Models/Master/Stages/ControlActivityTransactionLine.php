<?php

namespace App\Models\Master\Stages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlActivityTransactionLine extends Model
{
    use HasFactory;

    protected $table = 't_pengendalian_line';
    protected $primaryKey = 'id_pengendalian_line';

    protected $fillable = [
        'id_pengendalian',
        'id_kegiatan',
        'id_aktivitas',
        'answer',
        'note',
        'created_by',
        'updated_by',
        'is_active'
    ];
}
