<?php

namespace App\Models\Master\Stages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlActivity extends Model
{
    use HasFactory;

    protected $table = 'm_aktivitas';
    protected $primaryKey = 'id_aktivitas';

    protected $fillable = [
        'id_kegiatan',
        'name',
        'audit_type',
        'description',
        'created_by',
        'updated_by',
        'is_active'
    ];

    public function activity()
    {
        return $this->belongsTo('App\Models\Master\Stages\Activity', 'id_kegiatan', 'id_kegiatan');
    }
}
