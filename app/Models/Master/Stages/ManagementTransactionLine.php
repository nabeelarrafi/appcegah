<?php

namespace App\Models\Master\Stages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementTransactionLine extends Model
{
    use HasFactory;

    protected $table = 't_manajemen_line';
    protected $primaryKey = 'id_manajemen_line';

    protected $fillable = [
        'id_manajemen',
        'id_kegiatan',
        'id_aktivitas',
        'answer',
        'note',
        'created_by',
        'updated_by',
        'is_active'
    ];
}
