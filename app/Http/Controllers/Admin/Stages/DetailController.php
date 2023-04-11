<?php

namespace App\Http\Controllers\Admin\Stages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Master\Stages\GroupActivity;
use App\Models\Master\Auth\RegionUser;

class DetailController extends Controller
{
    public function getCity($id_province)
    {
        $data['ref_wil']  = \DB::table('ref_wilayah')->orderBy('nama')->get();
        $data['user_reg'] = RegionUser::select('id_provinsi', 'id_kabupatenkota', 'id_kecamatan', 'type')->where('id_user', \Session::get('id_user'))->get();
        $data['province'] = \DB::table('ref_wilayah')->where('id', $id_province)->orWhere('kode_wilayah', $id_province)->first();
        $data['city']     = [];

        foreach($data['ref_wil'] as $ref_wil) {
            $str_split  = str_split($ref_wil->kode_wilayah, 2);
            $prov_split = str_split($data['province']->kode_wilayah, 2);

            foreach($data['user_reg'] as $user_reg) {
                if($user_reg->type === 'KabupatenKota') {
                    if($prov_split[0] === $str_split[0] && $str_split[1] !== "00" && $user_reg->id_kabupatenkota === $ref_wil->id) array_push($data['city'], $ref_wil);
                } else {
                    if($prov_split[0] === $str_split[0] && $str_split[1] !== "00") array_push($data['city'], $ref_wil);
                }
            }
        }

        return view('pages.stages.detail.city', compact('data'));
    }

    public function getSubDistrict($id_city)
    {
        $data['sub_district'] = \DB::table('m_kecamatan')->select('id_kecamatan', 'name')->where([
            ['is_active', 1],
            ['id_kabupatenkota', $id_city]
        ])->orderBy('name')->get();

        return view('pages.stages.detail.sub_district', compact('data'));
    }

    public function getSchool($id_city)
    {
        $data['school'] = \DB::table('m_sekolah')->select('id_sekolah', 'name')->where([
            ['is_active', 1],
            ['id_kabupatenkota', $id_city]
        ])->orderBy('name')->get();

        return view('pages.stages.detail.school', compact('data'));
    }

    public function getFiscalYear($id_school)
    {
        $data['year'] = \DB::table('m_tahun_anggaran')->select('id_tahun_anggaran', 'name')->where('is_active', 1)->orderBy('name')->get();

        return view('pages.stages.detail.fiscal_year', compact('data'));
    }

    public function getWorksheet(Request $request) 
    {
        $data['fiscal_year'] = \DB::table('m_tahun_anggaran')->select('id_tahun_anggaran', 'name')->where('id_tahun_anggaran', $request->tahun_anggaran)->first();
        $data['worksheet']   = \DB::table('t_pengendalian')->where([
            ['npsn', $request->id_sekolah],
            ['id_tahun_anggaran', $request->tahun_anggaran],
            ['id_tahapan', $request->tahap],
            ['audit_type', $request->audit_type]
        ])->first();
        $data['activity_line'] = [];
        $data['user']        = User::find(\Session::get('id_user'));
        $data['tahap']       = \DB::table('m_tahapan')->where('id_tahapan', $request->tahap)->first();
        $data['audit_type']  = $request->audit_type;
        $data['group_act']   = GroupActivity::select('id_grup_kegiatan', 'name')->where([
            ['id_instrumen', 5],
            ['is_active', 1],
            ['audit_type', 1]
        ])->orderBy('name')->get();

        if(!$data['worksheet']) $data['status'] = 'Belum Dikerjakan';
        if($data['worksheet'] && $data['worksheet']->state === 'draft') {
            $data['activity_line'] = \DB::table('t_pengendalian_line')->select('id_pengendalian', 'id_kegiatan', 'id_aktivitas', 'answer', 'note')->where('id_pengendalian', $data['worksheet']->id_pengendalian)->get();
            $data['status']        = 'Sedang Dikerjakan';
        } elseif($data['worksheet'] && ($data['worksheet']->state === 'selesai' || $data['worksheet']->state === 'pending')) {
            $data['activity_line'] = \DB::table('t_pengendalian_line')->select('id_pengendalian', 'id_kegiatan', 'id_aktivitas', 'answer', 'note')->where('id_pengendalian', $data['worksheet']->id_pengendalian)->get();
            $data['status'] = 'Sudah Dikerjakan';
        }

        $data['school'] = \Http::withHeaders([
                'Authorization' => 'Bearer '.$request->access_token
        ])->post('https://apicon-rkas.kemdikbud.go.id/api/itjen/detail_sekolah', [
            'npsn' => $request->id_sekolah
        ])->json();

        $data['bos_salur'] = \Http::withHeaders([
            'token' => 'E9CC2CC884CFF7F4382C61B7276ABE9620C331F575CE193A5FE152483D001199',
            'id' => 'T001B001R002020A'
        ])->get('https://bos.kemdikbud.go.id/apiv1/sekolah/detail?npsn='.$request->id_sekolah.'&tahun='.$data['fiscal_year']->name.'&jenis=REGULER')->json();

        $data['nilai_salur'] = $this->getNilaiSalur($request->tahap, $data['bos_salur']);
        $data['nilai_lapor'] = $this->getNilaiLapor($request->tahap, $data['bos_salur']);

        // perhitungan jumlah alokasi
        if($data['school']['bentuk_pendidikan'] == "SMK" || $data['school']['bentuk_pendidikan'] == "SMA") $data['alokasi_siswa'] = 1500000;
        if($data['school']['bentuk_pendidikan'] == "SD" || $data['school']['bentuk_pendidikan'] == "SMP") $data['alokasi_siswa'] = 1200000;

        $data['total_alokasi']  = $data['alokasi_siswa'] * $data['bos_salur']['data'][0]['jumlah_siswa'];
        $data['tahap_1']        = $data['total_alokasi'] * 0.3;
        $data['tahap_2']        = $data['total_alokasi'] * 0.4;
        $data['tahap_3']        = $data['total_alokasi'] * 0.3;

        $view = view('pages.stages.detail.worksheet', compact('data'))->render();
        return response()->json($view);
    }

    private function getNilaiSalur($tahap, $bos_salur) {
        if($tahap == 1) $salur = $bos_salur['data'][0]['nilai_salur'];
        if($tahap == 2) $salur = $bos_salur['data'][1]['nilai_salur'];
        if($tahap == 3) $salur = $bos_salur['data'][2]['nilai_salur'];
        if($tahap == 4) $salur = $bos_salur['data'][0]['nilai_salur'] + $bos_salur['data'][1]['nilai_salur'];
        if($tahap == 5) $salur = $bos_salur['data'][1]['nilai_salur'] + $bos_salur['data'][2]['nilai_salur'];
        if($tahap == 6) $salur = $bos_salur['data'][0]['nilai_salur'] + $bos_salur['data'][1]['nilai_salur'] + $bos_salur['data'][2]['nilai_salur'];

        return $salur;
    }

    private function getNilaiLapor($tahap, $bos_salur) {
        if($tahap == 1) $lapor = $bos_salur['data'][0]['nilai_lapor'];
        if($tahap == 2) $lapor = $bos_salur['data'][1]['nilai_lapor'];
        if($tahap == 3) $lapor = $bos_salur['data'][2]['nilai_lapor'];
        if($tahap == 4) $lapor = $bos_salur['data'][0]['nilai_lapor'] + $bos_salur['data'][1]['nilai_lapor'];
        if($tahap == 5) $lapor = $bos_salur['data'][1]['nilai_lapor'] + $bos_salur['data'][2]['nilai_lapor'];
        if($tahap == 6) $lapor = $bos_salur['data'][0]['nilai_lapor'] + $bos_salur['data'][1]['nilai_lapor'] + $bos_salur['data'][2]['nilai_lapor'];

        return $lapor;
    }

    public function getWorksheet2(Request $request) 
    {
        $data['fiscal_year'] = \DB::table('m_tahun_anggaran')->select('id_tahun_anggaran', 'name')->where('id_tahun_anggaran', $request->tahun_anggaran)->first();
        $data['tahap']       = $request->tahap;
        $data['school']      = \DB::table('m_sekolah')->select('id_sekolah', 'name', 'npsn')->where('id_sekolah', $request->id_sekolah)->first();
        $data['status']      = $request->status;

        $view = view('pages.stages.detail.worksheet2', compact('data'))->render();
        return response()->json($view);
    }

    public function getWorksheetManagement(Request $request) 
    {
        $data['fiscal_year'] = \DB::table('m_tahun_anggaran')->select('id_tahun_anggaran', 'name')->where('id_tahun_anggaran', $request->tahun_anggaran)->first();
        $data['worksheet']   = \DB::table('t_manajemen')->where([
            ['id_tahapan', $request->tahap],
            ['id_tahun_anggaran', $request->tahun_anggaran],
            ['tingkat', $request->user_reg]
        ])->first();
        $data['tahap']       = \DB::table('m_tahapan')->where('id_tahapan', $request->tahap)->first();
        $data['user']        = User::find(\Session::get('id_user'));
        $data['user_reg']    = $request->user_reg;
        $data['management_line'] = [];

        if(!$data['worksheet']) $data['status'] = 'Belum Dikerjakan';
        if($data['worksheet'] && $data['worksheet']->state === 'draft') {
            $data['management_line'] = \DB::table('t_manajemen_line')->select('id_manajemen', 'id_kegiatan', 'id_aktivitas', 'answer', 'note')->where('id_manajemen', $data['worksheet']->id_t_manajemen)->get();
            $data['status']        = 'Sedang Dikerjakan';
        } elseif($data['worksheet'] && ($data['worksheet']->state === 'selesai' || $data['worksheet']->state === 'pending')) {
            $data['management_line'] = \DB::table('t_manajemen_line')->select('id_manajemen', 'id_kegiatan', 'id_aktivitas', 'answer', 'note')->where('id_manajemen', $data['worksheet']->id_t_manajemen)->get();
            $data['status'] = 'Sudah Dikerjakan';
        }

        if($request->user_reg === 'Nasional') {
            $data['group_act']   = GroupActivity::select('id_grup_kegiatan', 'name')->where([
                ['id_instrumen', 2],
                ['is_active', 1]
            ])->orderBy('name')->get();
        } else if($request->user_reg === 'Provinsi') {
            $data['group_act']   = GroupActivity::select('id_grup_kegiatan', 'name')->where([
                ['id_instrumen', 3],
                ['is_active', 1]
            ])->orderBy('name')->get();
        } else {
            $data['group_act']   = GroupActivity::select('id_grup_kegiatan', 'name')->where([
                ['id_instrumen', 4],
                ['is_active', 1]
            ])->orderBy('name')->get();
        }

        $view = view('pages.stages.detail.worksheet_management', compact('data'))->render();
        return response()->json($view);
    }

    
}
