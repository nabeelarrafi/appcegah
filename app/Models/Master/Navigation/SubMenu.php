<?php

namespace App\Models\Master\Navigation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;

    protected $table = 'm_sub_menu';
    protected $primaryKey = 'id_sub_menu';

    protected $fillable = [
        'id_menu',
        'name',
        'description',
        'url',
        'created_by',
        'updated_by',
        'is_active',
    ];

    public function menu()
    {
        return $this->belongsTo('App\Models\Master\Navigation\Menu', 'id_menu', 'id_menu');
    }
}
