<?php

namespace App\Models\Master\Stages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    use HasFactory;

    protected $table = 'm_instrumen';
    protected $primaryKey = 'id_instrumen';

    protected $fillable  = [
        'name',
        'description',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
