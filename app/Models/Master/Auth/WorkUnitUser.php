<?php

namespace App\Models\Master\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkUnitUser extends Model
{
    use HasFactory;

    protected $table = 'm_satker_user';
    protected $primaryKey = 'id_satker_user';

    protected $fillable = [
        'id_user',
        'id_satker',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
