<?php

namespace App\Models\Master\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    use HasFactory;

    protected $table = 'm_privilege';
    protected $primaryKey = 'id_privilege';

    protected $fillable = [
        'id_role',
        'id_menu',
        'id_sub_menu',
        'description',
        'is_create',
        'is_read',
        'is_update',
        'is_delete',
        'created_by',
        'updated_by',
        'is_active',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Master\Auth\Role', 'id_role', 'id_role');
    }

    public function menu()
    {
        return $this->belongsTo('App\Models\Master\Navigation\Menu', 'id_menu', 'id_menu');
    }

    public function subMenu()
    {
        return $this->belongsTo('App\Models\Master\Navigation\SubMenu', 'id_sub_menu', 'id_sub_menu');
    }
}