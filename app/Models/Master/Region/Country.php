<?php

namespace App\Models\Master\Region;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'm_negara';
    protected $primaryKey = 'id_negara';

    protected $fillable = ['name', 'description', 'created_by', 'updated_by', 'is_active'];
}
