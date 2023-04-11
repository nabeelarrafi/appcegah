<?php

namespace App\Models\Master\Stages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'm_kegiatan';
    protected $primaryKey = 'id_kegiatan';

    protected $fillable = [
        'id_grup_kegiatan',
        'name',
        'audit_type',
        'description',
        'created_by',
        'updated_by',
        'is_active'
    ];

    public function groupActivity()
    {
        return $this->belongsTo('App\Models\Master\Stages\GroupActivity', 'id_grup_kegiatan', 'id_grup_kegiatan');
    }

    public function controlActivity()
    {
        return $this->hasMany('App\Models\Master\Stages\ControlActivity', 'id_kegiatan', 'id_kegiatan');
    }
}
