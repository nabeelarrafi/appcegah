<?php

namespace App\Models\Master\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkUnit extends Model
{
    use HasFactory;

    protected $table = 'm_satker';
    protected $primaryKey = 'id_satker';

    protected $fillable = [
        'name',
        'abbreviation',
        'description',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
