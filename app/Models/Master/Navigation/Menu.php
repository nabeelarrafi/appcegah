<?php

namespace App\Models\Master\Navigation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'm_menu';
    protected $primaryKey = 'id_menu';

    protected $fillable = [
        'id_menu_category',
        'name',
        'description',
        'fa_class',
        'url',
        'created_by',
        'updated_by',
        'is_active',
    ];

    public function subMenu()
    {
        return $this->hasMany('App\Models\Master\Navigation\SubMenu', 'id_menu', 'id_menu');
    }

    // public function menuCategory()
    // {
    //     return $this->belongsTo('App\MenuCategory', 'id_menu_category', 'id_menu_category');
    // }
}
