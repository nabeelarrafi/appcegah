<?php

namespace App\Models\Master\Stages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlActivityTransaction extends Model
{
    use HasFactory;

    protected $table = 't_pengendalian';
    protected $primaryKey = 'id_pengendalian';

    protected $fillable = [
        'id_sekolah',
        'npsn',
        'id_tahun_anggaran',
        'id_tim',
        'pending_approver',
        'id_menu',
        'tahap',
        'id_tahapan',
        'audit_type',
        'note',
        'state',
        'created_by',
        'updated_by',
        'is_active'
    ];
}
