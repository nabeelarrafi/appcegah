<?php

namespace App\Models\Master\Stages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupActivity extends Model
{
    use HasFactory;

    protected $table = 'm_grup_kegiatan';
    protected $primaryKey = 'id_grup_kegiatan';

    protected $fillable = [
        'id_instrumen',
        'name',
        'description',
        'created_by',
        'updated_by',
        'is_active',
    ];

    public function activity()
    {
        return $this->hasMany('App\Models\Master\Stages\Activity', 'id_grup_kegiatan', 'id_grup_kegiatan');
    }
}
