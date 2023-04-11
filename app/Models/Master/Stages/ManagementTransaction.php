<?php

namespace App\Models\Master\Stages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementTransaction extends Model
{
    use HasFactory;

    protected $table = 't_manajemen';
    protected $primaryKey = 'id_t_manajemen';

    protected $fillable = [
        'id_tahun_anggaran',
        'id_tim',
        'pending_approver',
        'id_tahapan',
        'tingkat',
        'state',
        'created_by',
        'updated_by',
        'is_active'
    ];
}
