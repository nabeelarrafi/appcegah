<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\worksheetExport;

use App\Models\User;
use App\Models\Master\Navigation\Menu;
use App\Models\Master\Navigation\MenuCategory;
use App\Models\Master\Auth\LoginDetail;
use App\Models\Master\Auth\Privilege;
use App\Models\Master\Auth\RegionUser;
use App\Models\Master\Stages\GroupActivity;

class WorksheetController extends Controller
{
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
        $data['ref_wil']    = \DB::table('ref_wilayah')->orderBy('nama')->get();
        $data['category']   = MenuCategory::select('id_menu_category', 'name')->where('is_active', 1)->orderBy('id_menu_category', 'desc')->get();
        $data['menu']       = Menu::select('id_menu', 'id_menu_category', 'name', 'url', 'fa_class')->where('is_active', 1)->orderBy('id_menu')->orderBy('name')->get();
        $data['privilege']  = Privilege::select('id_role', 'id_menu', 'id_sub_menu', 'is_create', 'is_read', 'is_update', 'is_delete')->where([
            ['id_role', $data['user']->id_role],
            ['is_active', 1]
        ])->get();
        $data['region']        = 'Hasil Pengawasan';
        $data['chart_title']   = 'Persentase Penerimaan Kertas Kerja';
        $data['is_detail']     = true;
        $data['worksheet']     = \DB::table('vw_ai_summary_audit')->select('id_pengendalian', 'sekolah', 'npsn', 'id_user', 'auditor', 'id_tahun_anggaran', 'tahun', 'id_tahapan', 'tahap', 'nilai')->where([
            ['id_user', \Session::get('id_user')],
            ['state', 'selesai']
        ])->get();

        return view('pages.data_progress.progress_worksheet', compact('data'));
    }

    public function worksheetDetail($id_pengendalian)
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
        
        $data['pengendalian']  = \DB::table('vw_ai_summary_audit')->where('id_pengendalian', $id_pengendalian)->first();
        $data['group_act']     = GroupActivity::select('id_grup_kegiatan', 'name')->where([
            ['id_instrumen', 5],
            ['is_active', 1],
            ['audit_type', $data['pengendalian']->audit_type]
        ])->orderBy('name')->get();
        $data['activity_line']   = \DB::table('t_pengendalian_line')->select('id_pengendalian', 'id_kegiatan', 'id_aktivitas', 'answer', 'note')->where('id_pengendalian', $id_pengendalian)->get();

        $data['token']      = \Http::asForm()->post('https://apicon-rkas.kemdikbud.go.id/token', [
            'userName' => 'itjen@kemdikbud.go.id',
            'password' => 'A0889E7BBA8A43249261C51B2AABAAA5',
            'grant_type' => 'password'
        ])->json();
        $data['school']    = \Http::withToken($data['token']['access_token'])->post('https://apicon-rkas.kemdikbud.go.id/api/itjen/detail_sekolah', [
            'npsn' => $data['pengendalian']->npsn
        ])->json();
        $data['bos_salur']  = \Http::withHeaders([
            'token' => 'E9CC2CC884CFF7F4382C61B7276ABE9620C331F575CE193A5FE152483D001199',
            'id' => 'T001B001R002020A'
        ])->get('https://bos.kemdikbud.go.id/apiv1/sekolah/detail?npsn='.$data['pengendalian']->npsn.'&tahun=2020&jenis=REGULER')->json();

        return view('pages.data_progress.detail.worksheet_detail', compact('data'));
    }

    public function indexNational()
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
        $data['ref_wil']    = \DB::table('ref_wilayah')->orderBy('nama')->get();
        $data['category']   = MenuCategory::select('id_menu_category', 'name')->where('is_active', 1)->orderBy('id_menu_category', 'desc')->get();
        $data['menu']       = Menu::select('id_menu', 'id_menu_category', 'name', 'url', 'fa_class')->where('is_active', 1)->orderBy('id_menu')->orderBy('name')->get();
        $data['privilege']  = Privilege::select('id_role', 'id_menu', 'id_sub_menu', 'is_create', 'is_read', 'is_update', 'is_delete')->where([
            ['id_role', $data['user']->id_role],
            ['is_active', 1]
        ])->get();
        $data['region']        = 'Nasional';
        $data['chart_title']   = 'Persentase Penerimaan Kertas Kerja';
        $data['is_detail']     = true;
        $data['worksheet']     = [];

        $data['worksheet']     = \DB::table('vw_ai_data_audit_provinsi_tahap')->where('tahun', '2020')->get();
        
        return view('pages.data_progress.progress_worksheet', compact('data'));
    }

    public function indexProvince()
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
        $data['ref_wil']    = \DB::table('ref_wilayah')->orderBy('nama')->get();
        $data['category']   = MenuCategory::select('id_menu_category', 'name')->where('is_active', 1)->orderBy('id_menu_category', 'desc')->get();
        $data['menu']       = Menu::select('id_menu', 'id_menu_category', 'name', 'url', 'fa_class')->where('is_active', 1)->orderBy('id_menu')->orderBy('name')->get();
        $data['privilege']  = Privilege::select('id_role', 'id_menu', 'id_sub_menu', 'is_create', 'is_read', 'is_update', 'is_delete')->where([
            ['id_role', $data['user']->id_role],
            ['is_active', 1]
        ])->get();
        $data['region']        = 'Provinsi';
        $data['chart_title']   = 'Persentase Penerimaan Kertas Kerja';
        $data['is_detail']     = false;
        $data['province']      = [];

        foreach($data['ref_wil'] as $ref_wil) {
            $str_split = str_split($ref_wil->kode_wilayah, 2);

            if($str_split[1] === "00") array_push($data['province'], $ref_wil);
        }

        return view('pages.data_progress.progress_worksheet', compact('data'));
    }

    public function indexProvinceDetail(Request $request, $kode_wilayah)
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
        $data['ref_wil']    = \DB::table('ref_wilayah')->orderBy('nama')->get();
        $data['provinsi']   = \DB::table('ref_wilayah')->where('kode_wilayah', $kode_wilayah)->first();
        $data['category']   = MenuCategory::select('id_menu_category', 'name')->where('is_active', 1)->orderBy('id_menu_category', 'desc')->get();
        $data['menu']       = Menu::select('id_menu', 'id_menu_category', 'name', 'url', 'fa_class')->where('is_active', 1)->orderBy('id_menu')->orderBy('name')->get();
        $data['privilege']  = Privilege::select('id_role', 'id_menu', 'id_sub_menu', 'is_create', 'is_read', 'is_update', 'is_delete')->where([
            ['id_role', $data['user']->id_role],
            ['is_active', 1]
        ])->get();
        $data['region']        = 'Provinsi';
        $data['chart_title']   = 'Persentase Penerimaan Kertas Kerja '.$data['provinsi']->nama;
        $data['is_detail']     = true;
        $data['province']      = [];
        $data['worksheet']     = [];

        foreach($data['ref_wil'] as $ref_wil) {
            $str_split = str_split($ref_wil->kode_wilayah, 2);

            if($str_split[1] === "00") array_push($data['province'], $ref_wil);
        }

        $data['data_worksheet']     = \DB::table('vw_ai_data_audit_kabupaten_tahap')->where('tahun', '2020')->get();
        foreach($data['data_worksheet'] as $data_worksheet) {
            $str_split = str_split($data_worksheet->kode_kab, 2);
            $wil_split = str_split($kode_wilayah, 2);

            if($str_split[0] === $wil_split[0] && $str_split[1] !== "00") array_push($data['worksheet'], $data_worksheet);
        }

        if($request->isMethod('get')) return view('pages.data_progress.progress_worksheet', compact('data'));
        if($request->isMethod('post')) {
            $view = view('pages.data_progress.detail.worksheet', compact('data'))->render();
            return response()->json($view);
        }
    }

    public function indexCity()
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
        $data['ref_wil']    = \DB::table('ref_wilayah')->orderBy('nama')->get();
        $data['category']   = MenuCategory::select('id_menu_category', 'name')->where('is_active', 1)->orderBy('id_menu_category', 'desc')->get();
        $data['menu']       = Menu::select('id_menu', 'id_menu_category', 'name', 'url', 'fa_class')->where('is_active', 1)->orderBy('id_menu')->orderBy('name')->get();
        $data['privilege']  = Privilege::select('id_role', 'id_menu', 'id_sub_menu', 'is_create', 'is_read', 'is_update', 'is_delete')->where([
            ['id_role', $data['user']->id_role],
            ['is_active', 1]
        ])->get();
        $data['region']        = 'KabupatenKota';
        $data['chart_title']   = 'Persentase Penerimaan Kertas Kerja';
        $data['is_detail']     = false;
        $data['province']      = [];

        foreach($data['ref_wil'] as $ref_wil) {
            $str_split = str_split($ref_wil->kode_wilayah, 2);

            if($str_split[1] === "00") array_push($data['province'], $ref_wil);
        }

        return view('pages.data_progress.progress_worksheet', compact('data'));
    }

    public function indexCityDetail(Request $request, $kode_wilayah)
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
        $data['ref_wil']    = \DB::table('ref_wilayah')->orderBy('nama')->get();
        $data['kabkota']    = \DB::table('ref_wilayah')->where('kode_wilayah', $kode_wilayah)->first();
        $data['category']   = MenuCategory::select('id_menu_category', 'name')->where('is_active', 1)->orderBy('id_menu_category', 'desc')->get();
        $data['menu']       = Menu::select('id_menu', 'id_menu_category', 'name', 'url', 'fa_class')->where('is_active', 1)->orderBy('id_menu')->orderBy('name')->get();
        $data['privilege']  = Privilege::select('id_role', 'id_menu', 'id_sub_menu', 'is_create', 'is_read', 'is_update', 'is_delete')->where([
            ['id_role', $data['user']->id_role],
            ['is_active', 1]
        ])->get();
        $data['region']        = 'KabupatenKota';
        $data['chart_title']   = 'Persentase Penerimaan Kertas Kerja '.$data['kabkota']->nama;
        $data['is_detail']     = true;
        $data['province']      = [];
        $data['worksheet']     = [];

        foreach($data['ref_wil'] as $ref_wil) {
            $str_split = str_split($ref_wil->kode_wilayah, 2);

            if($str_split[1] === "00") array_push($data['province'], $ref_wil);
        }

        $data['worksheet']     = \DB::table('vw_ai_summary_audit')->where([
            ['tahun', '2020'],
            ['kode_kab', $kode_wilayah]
        ])->get();

        if($request->isMethod('get')) return view('pages.data_progress.progress_worksheet', compact('data'));
        if($request->isMethod('post')) {
            $view = view('pages.data_progress.detail.worksheet', compact('data'))->render();
            return response()->json($view);
        }
    }

    public function schoolDetail($npsn)
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
        $data['prev_route'] = \URL::previous();

        $data['token']      = \Http::asForm()->post('https://apicon-rkas.kemdikbud.go.id/token', [
            'userName' => 'itjen@kemdikbud.go.id',
            'password' => 'A0889E7BBA8A43249261C51B2AABAAA5',
            'grant_type' => 'password'
        ])->json();
        $data['school']    = \Http::withToken($data['token']['access_token'])->post('https://apicon-rkas.kemdikbud.go.id/api/itjen/detail_sekolah', [
            'npsn' => $npsn
        ])->json();
        $data[p]  = \Http::withHeaders([
            'token' => 'E9CC2CC884CFF7F4382C61B7276ABE9620C331F575CE193A5FE152483D001199',
            'id' => 'T001B001R002020A'
        ])->get('https://bos.kemdikbud.go.id/apiv1/sekolah/detail?npsn='.$npsn.'&tahun=2020&jenis=REGULER')->json();
        
        return view('pages.data_progress.detail.school', compact('data'));
    }

    public function worksheetDetailExport($wilayah = null, $kode_wilayah = null)
    {
        return Excel::download(new worksheetExport($wilayah, $kode_wilayah), 'worksheet.xlsx');
    }
}
