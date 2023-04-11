<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Master\Navigation\Menu;
use App\Models\Master\Navigation\MenuCategory;
use App\Models\Master\Auth\LoginDetail;
use App\Models\Master\Auth\Privilege;
use App\Models\Master\Auth\RegionUser;

class RealizationController extends Controller
{
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
        $data['chart_title']   = 'Penyaluran & Realisasi Dana Bos';
        $data['is_detail']     = true;
        $data['province']      = [];
        $data['salur_lapor']   = [];

        foreach($data['ref_wil'] as $ref_wil) {
            $str_split = str_split($ref_wil->kode_wilayah, 2);

            if($str_split[1] === "00") array_push($data['province'], $ref_wil);
        }

        $data['penyaluran']    = \Http::withHeaders([
            'token' => 'E9CC2CC884CFF7F4382C61B7276ABE9620C331F575CE193A5FE152483D001199',
            'id' => 'T001B001R002020A'
        ])->get('https://bos.kemdikbud.go.id/apiv1/rekap/pelaporan/list/nasional?tahun=2020&jenis=REGULER')->json();
        
        foreach($data['penyaluran']['data']['salur'] as $salur) {
            foreach($data['penyaluran']['data']['lapor'] as $lapor) {
                foreach($data['ref_wil'] as $ref_wil) {
                    if($salur['kode_prop'] === $lapor['kode_prop'] && $salur['tahap'] === $lapor['tahap'] && $ref_wil->kode_wilayah === $salur['kode_prop']) {
                        $nilai = [
                            'kode_prop' => $salur['kode_prop'],
                            'prop' => $ref_wil->nama,
                            'tahap' => 'Tahap '.$salur['tahap'],
                            'total_sekolah' => $salur['total_sekolah'],
                            'nilai_salur' => $salur['nilai_salur'],
                            'nilai_penggunaan' => $lapor['nilai_penggunaan'],
                        ];

                        array_push($data['salur_lapor'], $nilai);
                    }
                }
            }
        }

        return view('pages.data_progress.progress_realization', compact('data'));
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
        $data['chart_title']   = 'Penyaluran & Realisasi Dana Bos';
        $data['is_detail']     = false;
        $data['province']      = [];

        foreach($data['ref_wil'] as $ref_wil) {
            $str_split = str_split($ref_wil->kode_wilayah, 2);

            if($str_split[1] === "00") array_push($data['province'], $ref_wil);
        }

        return view('pages.data_progress.progress_realization', compact('data'));
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
        $data['chart_title']   = 'Penyaluran & Realisasi Dana Bos '.$data['provinsi']->nama;
        $data['is_detail']     = true;
        $data['province']      = [];
        $data['salur_lapor']   = [];

        foreach($data['ref_wil'] as $ref_wil) {
            $str_split = str_split($ref_wil->kode_wilayah, 2);

            if($str_split[1] === "00") array_push($data['province'], $ref_wil);
        }

        $data['penyaluran']    = \Http::withHeaders([
            'token' => 'E9CC2CC884CFF7F4382C61B7276ABE9620C331F575CE193A5FE152483D001199',
            'id' => 'T001B001R002020A'
        ])->get('https://bos.kemdikbud.go.id/apiv1/rekap/pelaporan/list/propinsi?tahun=2020&jenis=REGULER&kode_prop='.$kode_wilayah)->json();

        foreach($data['penyaluran']['data']['salur'] as $salur) {
            foreach($data['penyaluran']['data']['lapor'] as $lapor) {
                foreach($data['ref_wil'] as $ref_wil) {
                    if($salur['kode_kabkota'] === $lapor['kode_kabkota'] && $salur['tahap'] === $lapor['tahap'] && $ref_wil->kode_wilayah === $salur['kode_kabkota']) {
                        $nilai = [
                            'kode_kabkota' => $salur['kode_kabkota'],
                            'kabkota' => $ref_wil->nama,
                            'tahap' => 'Tahap '.$salur['tahap'],
                            'total_sekolah' => $salur['total_sekolah'],
                            'nilai_salur' => $salur['nilai_salur'],
                            'nilai_penggunaan' => $lapor['nilai_penggunaan'],
                        ];

                        array_push($data['salur_lapor'], $nilai);
                    }
                }
            }
        }

        if($request->isMethod('get')) return view('pages.data_progress.progress_realization', compact('data'));
        if($request->isMethod('post')) {
            $view = view('pages.data_progress.detail.realization', compact('data'))->render();
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
        $data['chart_title']   = 'Penyaluran & Realisasi Dana Bos';
        $data['is_detail']     = false;
        $data['province']      = [];

        foreach($data['ref_wil'] as $ref_wil) {
            $str_split = str_split($ref_wil->kode_wilayah, 2);

            if($str_split[1] === "00") array_push($data['province'], $ref_wil);
        }

        return view('pages.data_progress.progress_realization', compact('data'));
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
        $data['chart_title']   = 'Penyaluran & Realisasi Dana Bos '.$data['kabkota']->nama;
        $data['is_detail']     = true;
        $data['province']      = [];
        $data['salur_lapor']   = [];

        foreach($data['ref_wil'] as $ref_wil) {
            $str_split = str_split($ref_wil->kode_wilayah, 2);

            if($str_split[1] === "00") array_push($data['province'], $ref_wil);
        }

        $data['token']      = \Http::asForm()->post('https://apicon-rkas.kemdikbud.go.id/token', [
            'userName' => 'itjen@kemdikbud.go.id',
            'password' => 'A0889E7BBA8A43249261C51B2AABAAA5',
            'grant_type' => 'password'
        ])->json();
        $data['sekolah']    = \Http::withToken($data['token']['access_token'])->post('https://apicon-rkas.kemdikbud.go.id/api/itjen/sekolah', [
            'kode_wilayah' => $kode_wilayah
        ])->json();
        $data['penyaluran']    = \Http::withHeaders([
            'token' => 'E9CC2CC884CFF7F4382C61B7276ABE9620C331F575CE193A5FE152483D001199',
            'id' => 'T001B001R002020A'
        ])->get('https://bos.kemdikbud.go.id/apiv1/rekap/pelaporan/sekolah/kabupaten?tahun=2020&jenis=REGULER&kode_kabkota='.$kode_wilayah)->json();
        
        foreach($data['penyaluran']['data']['salur'] as $salur) {
            foreach($data['sekolah'] as $sekolah) {
                if($salur['npsn'] === $sekolah['npsn']) {
                    $nilai = [
                        'npsn' => $salur['npsn'],
                        'sekolah' => $sekolah['nama'],
                        'tahap' => 'Tahap '.$salur['tahap'],
                        'nilai_salur' => $salur['total_penggunaan'],
                        'nilai_penggunaan' => $salur['total_penggunaan']
                    ];

                    array_push($data['salur_lapor'], $nilai);
                }
            }
        }

        if($request->isMethod('get')) return view('pages.data_progress.progress_realization', compact('data'));
        if($request->isMethod('post')) {
            $view = view('pages.data_progress.detail.realization', compact('data'))->render();
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
        $data['bos_salur']  = \Http::withHeaders([
            'token' => 'E9CC2CC884CFF7F4382C61B7276ABE9620C331F575CE193A5FE152483D001199',
            'id' => 'T001B001R002020A'
        ])->get('https://bos.kemdikbud.go.id/apiv1/sekolah/detail?npsn='.$npsn.'&tahun=2020&jenis=REGULER')->json();
        
        return view('pages.data_progress.detail.school', compact('data'));
    }
}
