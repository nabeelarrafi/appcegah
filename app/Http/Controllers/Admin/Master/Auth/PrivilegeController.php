<?php

namespace App\Http\Controllers\Admin\Master\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Master\Auth\Role;
use App\Models\Master\Auth\Privilege;

class PrivilegeController extends Controller
{
    public function getSubMenu($id_menu, $id_role)
    {
        $data['sub_menu'] = \DB::table('m_sub_menu')->select('id_sub_menu', 'name')->where([
            ['is_active', 1],
            ['id_menu', $id_menu]
        ])->orderBy('name')->get();

        if($data['sub_menu']->isEmpty()) {
            $data['privilege'] = \DB::table('m_privilege')->select('is_create', 'is_read', 'is_update', 'is_delete')->where([
                ['is_active', 1],
                ['id_menu', $id_menu],
                ['id_role', $id_role]
            ])->first();

            return view('pages.master.auth.role.privilege', compact('data'));
        }

        return view('pages.master.auth.role.sub_menu', compact('data'));
    }

    public function getPrivilege($id_sub_menu, $id_role)
    {
        $data['privilege'] = \DB::table('m_privilege')->select('is_create', 'is_read', 'is_update', 'is_delete')->where([
            ['is_active', 1],
            ['id_sub_menu', $id_sub_menu],
            ['id_role', $id_role]
        ])->first();

        return view('pages.master.auth.role.privilege', compact('data'));
    }

    public function store(Request $request)
    {
        $is_create  = ($request->is_create) ? 1 : 0;
        $is_read    = ($request->is_read) ? 1 : 0;
        $is_update  = ($request->is_update) ? 1 : 0;
        $is_delete  = ($request->is_delete) ? 1 : 0;

        if($request->id_sub_menu) {
            $privilege  = \DB::table('m_privilege')->where([
                ['id_role', $request->id_role],
                ['id_menu', $request->id_menu],
                ['id_sub_menu', $request->id_sub_menu]
            ])->first();
        } else {
            $privilege  = \DB::table('m_privilege')->where([
                ['id_role', $request->id_role],
                ['id_menu', $request->id_menu]
            ])->first();
        }

        $role = Role::find($request->id_role);
        
        if($privilege) {
            Privilege::find($privilege->id_privilege)->update([
                'is_create' => $is_create,
                'is_read' => $is_read,
                'is_update' => $is_update,
                'is_delete' => $is_delete,
                'updated_by' => $request->id_user,
            ]);
        } else {
            Privilege::create([
                'id_role' => $request->id_role,
                'id_menu' => $request->id_menu,
                'id_sub_menu' => $request->id_sub_menu,
                'description' => $role->name,
                'is_create' => $is_create,
                'is_read' => $is_read,
                'is_update' => $is_update,
                'is_delete' => $is_delete,
                'created_by' => $request->id_user,
                'updated_by' => $request->id_user,
                'is_active' => 1,
            ]);
        }

        return redirect()->route('Admin:Dashboard:Master:Role:Edit', ['role' => $request->id_role])->with('success', 'Data successfully added!');
    }
}
