<?php

namespace App\Http\Controllers\Admin\Master\Stages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Master\Stages\FiscalYear;
use App\Models\Master\Navigation\Menu;
use App\Models\Master\Navigation\MenuCategory;
use App\Models\Master\Auth\LoginDetail;
use App\Models\Master\Auth\Privilege;
use App\Models\Master\Auth\RegionUser;

class FiscalYearController extends Controller
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

        $data['user']       = User::find(\Session::get('id_user'));
        $data['user_reg']   = RegionUser::select('id_provinsi', 'id_kabupatenkota', 'id_kecamatan', 'type')->where('id_user', \Session::get('id_user'))->get();
        $data['user_type']  = $data['user_reg'][0]->type;
        $data['category']   = MenuCategory::select('id_menu_category', 'name')->where('is_active', 1)->orderBy('id_menu_category', 'desc')->get();
        $data['menu']       = Menu::select('id_menu', 'id_menu_category', 'name', 'url', 'fa_class')->where('is_active', 1)->orderBy('id_menu')->orderBy('name')->get();
        $data['privilege']  = Privilege::select('id_role', 'id_menu', 'id_sub_menu', 'is_create', 'is_read', 'is_update', 'is_delete')->where([
            ['id_role', $data['user']->id_role],
            ['is_active', 1]
        ])->get();
        $data['year'] = \DB::table('m_tahun_anggaran')->select('id_tahun_anggaran', 'name', 'description')->where('is_active', 1)->orderBy('name')->get();

        return view('pages.master.stages.fiscal_year.fiscal_year', compact('data'));
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
            'name' => ['required'],
        ]);

        if($validator->fails()) return redirect()->route('Admin:Dashboard:Master:Fiscal:Year:Index')->with('error', 'All input must be filled!')->withInput();

        FiscalYear::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => $request->id_user,
            'updated_by' => $request->id_user,
            'is_active' => 1,
        ]);

        return redirect()->route('Admin:Dashboard:Master:Fiscal:Year:Index')->with('success', 'Data successfully added!');
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

        $data['user']       = User::find(\Session::get('id_user'));
        $data['user_reg']   = RegionUser::select('id_provinsi', 'id_kabupatenkota', 'id_kecamatan', 'type')->where('id_user', \Session::get('id_user'))->get();
        $data['user_type']  = $data['user_reg'][0]->type;
        $data['category']   = MenuCategory::select('id_menu_category', 'name')->where('is_active', 1)->orderBy('id_menu_category', 'desc')->get();
        $data['menu']       = Menu::select('id_menu', 'id_menu_category', 'name', 'url', 'fa_class')->where('is_active', 1)->orderBy('id_menu')->orderBy('name')->get();
        $data['privilege']  = Privilege::select('id_role', 'id_menu', 'id_sub_menu', 'is_create', 'is_read', 'is_update', 'is_delete')->where([
            ['id_role', $data['user']->id_role],
            ['is_active', 1]
        ])->get();
        $data['year'] = \DB::table('m_tahun_anggaran')->select('id_tahun_anggaran', 'name', 'description')->where('is_active', 1)->orderBy('name')->get();
        $data['edit'] = FiscalYear::find($id);

        return view('pages.master.stages.fiscal_year.fiscal_year_edit', compact('data'));
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
            'name' => ['required'],
        ]);

        if($validator->fails()) return redirect()->route('Admin:Dashboard:Master:Fiscal:Year:Edit', ['year' => $id])->with('error', 'All input must be filled!');

        FiscalYear::find($id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'updated_by' => $request->id_user,
        ]);

        return redirect()->route('Admin:Dashboard:Master:Fiscal:Year:Index')->with('success', 'Data successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FiscalYear::find($id)->delete();

        return redirect()->route('Admin:Dashboard:Master:Fiscal:Year:Index')->with('success', 'Data successfully deleted!');
    }
}
