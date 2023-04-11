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

class DashboardController extends Controller
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
        $data['category']   = MenuCategory::select('id_menu_category', 'name')->where('is_active', 1)->orderBy('id_menu_category', 'desc')->get();
        $data['menu']       = Menu::select('id_menu', 'id_menu_category', 'name', 'url', 'fa_class')->where('is_active', 1)->orderBy('id_menu')->orderBy('name')->get();
        $data['privilege']  = Privilege::select('id_role', 'id_menu', 'id_sub_menu', 'is_create', 'is_read', 'is_update', 'is_delete')->where([
            ['id_role', $data['user']->id_role],
            ['is_active', 1]
        ])->get();
        // dd($data['user']->role->name);

        if($data['user_type'] === 'Nasional') {
            $data['title']          = 'Nasional';
            $data['alokasi_url']    = 'https://bos.kemdikbud.go.id/apiv1/rekap/nasional?tahun=2020&jenis=REGULER';
            $data['pelaporan_url']  = 'https://bos.kemdikbud.go.id/apiv1/rekap/pelaporan/nasional?tahun=2020&jenis=REGULER';
            $data['rkas']           = \DB::table('vw_ai_data_rkas_nasional')->first();
            $data['worksheet']      = \DB::table('vw_ai_data_audit_nasional')->where('tahun', '2020')->first();
        }
        if($data['user_type'] === 'Provinsi') {
            $data['ref_wil']        = \DB::table('ref_wilayah')->where('id', $data['user_reg'][0]->id_provinsi)->first();
            $data['title']          = $data['ref_wil']->nama;
            $data['alokasi_url']    = 'https://bos.kemdikbud.go.id/apiv1/rekap/propinsi?tahun=2020&jenis=REGULER&kode_prop='.$data['ref_wil']->kode_wilayah;
            $data['pelaporan_url']  = 'https://bos.kemdikbud.go.id/apiv1/rekap/pelaporan/propinsi?tahun=2020&jenis=REGULER&kode_prop='.$data['ref_wil']->kode_wilayah;
            $data['rkas']           = \DB::table('vw_ai_data_rkas_provinsi')->where('kode_prop', $data['ref_wil']->kode_wilayah)->first();
            $data['worksheet']      = \DB::table('vw_ai_data_audit_provinsi')->where([
                ['tahun', '2020'],
                ['kode_prop', $data['ref_wil']->kode_wilayah]
            ])->first();
        }
        if($data['user_type'] === 'KabupatenKota') {
            $data['ref_wil']        = \DB::table('ref_wilayah')->where('id', $data['user_reg'][0]->id_kabupatenkota)->first();
            $data['title']          = $data['ref_wil']->nama;
            $data['alokasi_url']    = 'https://bos.kemdikbud.go.id/apiv1/rekap/kabupaten?tahun=2020&jenis=REGULER&kode_kabkota='.$data['ref_wil']->kode_wilayah;
            $data['pelaporan_url']  = 'https://bos.kemdikbud.go.id/apiv1/rekap/pelaporan/kabupaten?tahun=2020&jenis=REGULER&kode_kabkota='.$data['ref_wil']->kode_wilayah;
            $data['rkas']           = \DB::table('vw_ai_data_rkas_kabupaten')->where('kode_kab', $data['ref_wil']->kode_wilayah)->first();
            $data['worksheet']      = \DB::table('vw_ai_data_audit_kabupaten')->where([
                ['tahun', '2020'],
                ['kode_kab', $data['ref_wil']->kode_wilayah]
            ])->first();
        }

        $data['alokasi']    = \Http::withHeaders([
            'token' => 'E9CC2CC884CFF7F4382C61B7276ABE9620C331F575CE193A5FE152483D001199',
            'id' => 'T001B001R002020A'
        ])->get($data['alokasi_url'])->json();
        $data['pelaporan']  = \Http::withHeaders([
            'token' => 'E9CC2CC884CFF7F4382C61B7276ABE9620C331F575CE193A5FE152483D001199',
            'id' => 'T001B001R002020A'
        ])->get($data['pelaporan_url'])->json();

        return view('pages.index', compact('data'));
    }
}
