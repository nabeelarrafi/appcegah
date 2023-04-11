<?php

namespace App\Http\Controllers\Admin\Master\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Master\Auth\RegionUser;
use App\Models\Master\Navigation\Menu;
use App\Models\Master\Navigation\MenuCategory;
use App\Models\Master\Auth\LoginDetail;
use App\Models\Master\Auth\Privilege;

class RegionUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!\Session::has('id_user') && !\Session::has('token')) return redirect()->route('Admin:Login');
        $token              = LoginDetail::where([
            ['id_user', \Session::get('id_user')],
            ['is_active', 1]
        ])->latest()->first();
        if(!$token || \Session::get('token') !== $token->token) return redirect()->route('Admin:Logout');

        $data['user']           = User::find(\Session::get('id_user'));
        $data['user_reg']       = RegionUser::select('id_provinsi', 'id_kabupatenkota', 'id_kecamatan', 'type')->where('id_user', \Session::get('id_user'))->get();
        $data['user_type']      = $data['user_reg'][0]->type;
        $data['category']       = MenuCategory::select('id_menu_category', 'name')->where('is_active', 1)->orderBy('id_menu_category', 'desc')->get();
        $data['menu']           = Menu::select('id_menu', 'id_menu_category', 'name', 'url', 'fa_class')->where('is_active', 1)->orderBy('name')->get();
        $data['privilege']      = Privilege::select('id_role', 'id_menu', 'id_sub_menu', 'is_create', 'is_read', 'is_update', 'is_delete')->where([
            ['id_role', $data['user']->id_role],
            ['is_active', 1]
        ])->get();
        $data['region_user']    = \DB::table('vw_user_wilayah')->select('id_user_wilayah', 'username', 'wilayah', 'is_active')->where('is_active', 1)->orderBy('username')->get();
        $data['users']          = \DB::table('m_user')->select('id_user', 'username')->where('is_active', 1)->orderBy('username')->get();

        return view('pages.master.auth.region_user.region_user', compact('data'));
    }

    public function getCountry($type)
    {
        $data['country'] = \DB::table('m_negara')->select('id_negara', 'name')->where('is_active', 1)->orderBy('name')->get();
        $data['type']    = $type;

        return view('pages.master.auth.region_user.select.country', compact('data'));
    }

    public function getProvince($type, $id_negara)
    {
        $data['ref_wil']  = \DB::table('ref_wilayah')->orderBy('nama')->get();
        $data['province'] = [];
        $data['type'] = $type;
        
        foreach($data['ref_wil'] as $ref_wil) {
            $str_split = str_split($ref_wil->kode_wilayah, 2);

            if($str_split[1] === "00") array_push($data['province'], $ref_wil);
        }

        return view('pages.master.auth.region_user.select.province', compact('data'));
    }

    public function getCity($type, $id_provinsi)
    {
        $data['province']   = \DB::table('ref_wilayah')->where('id', $id_provinsi)->first();
        $data['ref_wil']    = \DB::table('ref_wilayah')->orderBy('nama')->get();
        $data['city']       = [];
        $data['type']       = $type;

        foreach($data['ref_wil'] as $ref_wil) {
            $str_split  = str_split($ref_wil->kode_wilayah, 2);
            $prov_split = str_split($data['province']->kode_wilayah, 2);

            if($prov_split[0] === $str_split[0] && $str_split !== "00") array_push($data['city'], $ref_wil);
        }

        return view('pages.master.auth.region_user.select.city', compact('data'));
    }

    public function getSubDistrict($type, $id_kabupatenkota)
    {
        $data['sub_district'] = \DB::table('m_kecamatan')->select('id_kecamatan', 'name')->where([
            ['is_active', 1],
            ['id_kabupatenkota', $id_kabupatenkota]
        ])->orderBy('name')->get();

        return view('pages.master.auth.region_user.select.sub_district', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id_user' => ['required'],
            'id_users' => ['required'],
        ]);

        if($validator->fails()) return redirect()->route('Admin:Dashboard:Master:Region:User:Index')->with('error', 'All input must be filled!')->withInput();

        RegionUser::create([
            'id_user' => $request->id_users,
            'id_negara' => $request->id_negara,
            'id_provinsi' => $request->id_provinsi,
            'id_kabupatenkota' => $request->id_kabupatenkota,
            'id_kecamatan' => $request->id_kecamatan,
            'type' => $request->type,
            'created_by' => $request->id_user,
            'updated_by' => $request->id_user,
            'is_active' => 1,
        ]);

        return redirect()->route('Admin:Dashboard:Master:Region:User:Index')->with('success', 'Data successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!\Session::has('id_user') && !\Session::has('token')) return redirect()->route('Admin:Login');
        $token              = LoginDetail::where([
            ['id_user', \Session::get('id_user')],
            ['is_active', 1]
        ])->latest()->first();
        if(!$token || \Session::get('token') !== $token->token) return redirect()->route('Admin:Logout');

        $data['user']           = User::find(\Session::get('id_user'));
        $data['user_reg']   = RegionUser::select('id_provinsi', 'id_kabupatenkota', 'id_kecamatan', 'type')->where('id_user', \Session::get('id_user'))->get();
        $data['user_type']  = $data['user_reg'][0]->type;
        $data['category']       = MenuCategory::select('id_menu_category', 'name')->where('is_active', 1)->orderBy('id_menu_category', 'desc')->get();
        $data['menu']           = Menu::select('id_menu', 'id_menu_category', 'name', 'url', 'fa_class')->where('is_active', 1)->orderBy('name')->get();
        $data['privilege']      = Privilege::select('id_role', 'id_menu', 'id_sub_menu', 'is_create', 'is_read', 'is_update', 'is_delete')->where([
            ['id_role', $data['user']->id_role],
            ['is_active', 1]
        ])->get();
        $data['region_user']    = \DB::table('vw_user_wilayah')->select('id_user_wilayah', 'username', 'wilayah', 'is_active')->where('is_active', 1)->orderBy('username')->get();
        $data['users']          = \DB::table('m_user')->select('id_user', 'username')->where('is_active', 1)->orderBy('username')->get();
        $data['city']           = \DB::table('m_kabupatenkota')->select('id_kabupatenkota', 'name')->where('is_active', 1)->orderBy('name')->get();
        $data['edit']           = RegionUser::find($id);

        return view('pages.master.auth.region_user.region_user_edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'id_user' => ['required'],
            'id_users' => ['required'],
            'id_kabupatenkota' => ['required'],
        ]);

        if($validator->fails()) return redirect()->route('Admin:Dashboard:Master:Region:User:Edit', ['user' => $id])->with('error', 'All input must be filled!');

        RegionUser::find($id)->update([
            'id_user' => $request->id_users,
            'id_kabupatenkota' => $request->id_kabupatenkota,
            'updated_by' => $request->id_user,
        ]);

        return redirect()->route('Admin:Dashboard:Master:Region:User:Index')->with('success', 'Data successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RegionUser::find($id)->delete();

        return redirect()->route('Admin:Dashboard:Master:Region:User:Index')->with('success', 'Data successfully deleted!');
    }
}
