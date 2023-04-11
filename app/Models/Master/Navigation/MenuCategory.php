<?php

namespace App\Models\Master\Navigation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    use HasFactory;

    protected $table = 'm_menu_category';
    protected $primaryKey = 'id_menu_category';

    protected $fillable = [
        'name',
        'description',
        'created_by',
        'updated_by',
        'is_active',
    ];

    public function menu()
    {
        return $this->hasMany('App\Models\Master\Navigation\Menu', 'id_menu_category', 'id_menu_category');
    }
}
