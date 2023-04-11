<?php

namespace App\Http\Controllers\Admin\Stages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Master\Stages\GroupActivity;
use App\Models\Master\Navigation\Menu;
use App\Models\Master\Navigation\MenuCategory;
use App\Models\Master\Auth\LoginDetail;
use App\Models\Master\Auth\Privilege;
use App\Models\Master\Auth\RegionUser;
use App\Models\Master\Stages\ControlActivityTransaction;
use App\Models\Master\Stages\ControlActivityTransactionLine;

class ApprovalController extends Controller
{
    public function index(Request $request)
    {
        if(!\Session::has('id_user') && !\Session::has('token')) return redirect()->route('Admin:Login');
        $token              = LoginDetail::where([
            ['id_user', \Session::get('id_user')],
            ['is_active', 1]
        ])->latest()->first();
        if(!$token || \Session::get('token') !== $token->token) return redirect()->route('Admin:Logout');

        $data['user']       = User::find(\Session::get('id_user'));
        $data['route']      = \Route::currentRouteName();
        $data['user_reg']   = RegionUser::select('id_provinsi', 'id_kabupatenkota', 'id_kecamatan', 'type')->where('id_user', \Session::get('id_user'))->get();
        $data['user_type']  = $data['user_reg'][0]->type;
        $data['category']   = MenuCategory::select('id_menu_category', 'name')->where('is_active', 1)->orderBy('id_menu_category', 'desc')->get();
        $data['menu']       = Menu::select('id_menu', 'id_menu_category', 'name', 'url', 'fa_class')->where('is_active', 1)->orderBy('id_menu')->orderBy('name')->get();
        $data['privilege']  = Privilege::select('id_role', 'id_menu', 'id_sub_menu', 'is_create', 'is_read', 'is_update', 'is_delete')->where([
            ['id_role', $data['user']->id_role],
            ['is_active', 1]
        ])->get();
        $data['province']   = [];
        $data['ref_wil']    = \DB::table('ref_wilayah')->orderBy('nama')->get();
        $data['year']       = \DB::table('m_tahun_anggaran')->select('id_tahun_anggaran', 'name')->orderBy('name')->get();
        $data['stages']     = \DB::table('m_tahapan')->select('id_tahapan', 'name')->orderBy('id_tahapan')->get();
        
        if($data['route'] === 'Admin:Dashboard:Stages:Desk:Approval:Index') {
            if(empty($request->all())) {
                $data['approval']   = \DB::table('vw_ai_summary_audit')->select('id_pengendalian', 'id_sekolah', 'sekolah', 'auditor', 'id_tahun_anggaran', 'tahun', 'id_tahapan', 'tahap', 'nilai')->where([
                    ['pending_approver', \Session::get('id_user')],
                    ['audit_type', 1]
                ])->get();
            } else {
                if($request->risiko === 'Rendah') {
                    $data['query'] = [
                        ['pending_approver', \Session::get('id_user')],
                        ['audit_type', 1],
                        // ['id_sekolah', $request->id_sekolah],
                        ['id_tahun_anggaran', $request->id_tahun_anggaran],
                        ['id_tahapan', $request->id_tahapan],
                        ['nilai', '>=', 80]
                    ];
                } elseif ($request->risiko === 'Sedang') {
                    $data['query'] = [
                        ['pending_approver', \Session::get('id_user')],
                        ['audit_type', 1],
                        // ['id_sekolah', $request->id_sekolah],
                        ['id_tahun_anggaran', $request->id_tahun_anggaran],
                        ['id_tahapan', $request->id_tahapan],
                        ['nilai', '>', 50],
                        ['nilai', '<', 80]
                    ];
                } else {
                    $data['query'] = [
                        ['pending_approver', \Session::get('id_user')],
                        ['audit_type', 1],
                        // ['id_sekolah', $request->id_sekolah],
                        ['id_tahun_anggaran', $request->id_tahun_anggaran],
                        ['id_tahapan', $request->id_tahapan],
                        ['nilai', '<=', 50]
                    ];
                }
                $data['approval']   = \DB::table('vw_ai_summary_audit')->select('id_pengendalian', 'id_sekolah', 'sekolah', 'auditor', 'id_tahun_anggaran', 'tahun', 'id_tahapan', 'tahap', 'nilai')->where($data['query'])->get();
            }
        } else {
            if(empty($request->all()) && !$request->id_tahun_anggaran && !$request->id_tahapan && !$request->risiko) {
                $data['approval']   = \DB::table('vw_ai_summary_audit')->select('id_pengendalian', 'id_sekolah', 'sekolah', 'auditor', 'id_tahun_anggaran', 'tahun', 'id_tahapan', 'tahap', 'nilai')
                                        ->where('pending_approver', \Session::get('id_user'))
                                        ->where(function($query) {
                                            $query->where('audit_type', 2)->orWhere('audit_type', 3);
                                        })
                                        ->get();
            } else {
                if($request->risiko === 'Rendah') {
                    $data['query'] = [
                        ['pending_approver', \Session::get('id_user')],
                        // ['id_sekolah', $request->id_sekolah],
                        ['id_tahun_anggaran', $request->id_tahun_anggaran],
                        ['id_tahapan', $request->id_tahapan],
                        ['nilai', '>=', 80]
                    ];
                } elseif ($request->risiko === 'Sedang') {
                    $data['query'] = [
                        ['pending_approver', \Session::get('id_user')],
                        // ['id_sekolah', $request->id_sekolah],
                        ['id_tahun_anggaran', $request->id_tahun_anggaran],
                        ['id_tahapan', $request->id_tahapan],
                        ['nilai', '>', 50],
                        ['nilai', '<', 80]
                    ];
                } else {
                    $data['query'] = [
                        ['pending_approver', \Session::get('id_user')],
                        // ['id_sekolah', $request->id_sekolah],
                        ['id_tahun_anggaran', $request->id_tahun_anggaran],
                        ['id_tahapan', $request->id_tahapan],
                        ['nilai', '<=', 50]
                    ];
                }
                
                $data['approval']   = \DB::table('vw_ai_summary_audit')->select('id_pengendalian', 'id_sekolah', 'sekolah', 'auditor', 'id_tahun_anggaran', 'tahun', 'id_tahapan', 'tahap', 'nilai')
                                        ->where($data['query'])
                                        ->where(function($query) {
                                            $query->where('audit_type', 2)->orWhere('audit_type', 3);
                                        })
                                        ->get();

            }
        }

        foreach($data['ref_wil'] as $ref_wil) {
            $str_split  = str_split($ref_wil->kode_wilayah, 2);

            if($str_split[1] === "00") array_push($data['province'], $ref_wil);
        }

        return view('pages.stages.approval.approval', compact('data'));
    }

    public function approve($id_pengendalian)
    {
        $data['user']           = User::find(\Session::get('id_user'));
        $data['pengendalian']   = ControlActivityTransaction::find($id_pengendalian);

        if($data['user']->id_atasan) {
            $data['pengendalian']->update([
                'pending_approver' => $data['user']->id_atasan,
                'updated_by' => \Session::get('id_user')
            ]);
        } else {
            $data['pengendalian']->update([
                'state' => 'selesai',
                'pending_approver' => null,
                'updated_by' => \Session::get('id_user')
            ]);
        }

        ($data['pengendalian']->audit_type === 1) ? $data['route'] = 'Admin:Dashboard:Stages:Desk:Approval:Index' : $data['route'] = 'Admin:Dashboard:Stages:Field:Approval:Index';

        return redirect()->route($data['route'])->with('success', 'Data Pengawasan berhasil disetujui!');
    }

    public function reject(Request $request)
    {
        $data['pengendalian'] = ControlActivityTransaction::find($request->id_pengendalian);

        // if($data['pengendalian']->created_by === $data['pengendalian']->updated_by) {
        //     $data['pengendalian']->update([
        //         'pending_approver' => $data['pengendalian']->created_by,
        //         'note' => $request->note,
        //         'updated_by' => \Session::get('id_user')
        //     ]);
        // } else {
        //     $data['pengendalian']->update([
        //         'pending_approver' => $data['pengendalian']->updated_by,
        //         'note' => $request->note,
        //         'updated_by' => \Session::get('id_user')
        //     ]);
        // }
        $data['pengendalian']->update([
            'pending_approver' => $data['pengendalian']->created_by,
            'note' => $request->note,
            'updated_by' => \Session::get('id_user')
        ]);

        ($data['pengendalian']->audit_type === 1) ? $data['route'] = 'Admin:Dashboard:Stages:Desk:Approval:Index' : $data['route'] = 'Admin:Dashboard:Stages:Field:Approval:Index';

        return redirect()->route($data['route'])->with('success', 'Data Pengawasan berhasil ditolak!');
    }

    public function resend(Request $request, $id_pengendalian)
    {
        $pengendalian = ControlActivityTransaction::find($request->id_pengendalian);
        $activity_line = \DB::table('t_pengendalian_line')->where('id_pengendalian', $id_pengendalian)->get();
        $user          = User::find(\Session::get('id_user'));
        
        ($user->id_atasan) ? $state = 'pending' : $state = 'selesai';
        $pengendalian->update([
            'note' => null,
            'pending_approver' => $user->id_atasan,
            'state' => $state,
            'updated_by' => $user->id_user
        ]);

        foreach($activity_line as $activity_line) {
            foreach($request->answer as $answer_key => $answer) {
                $answer_index = explode('-', $answer_key);

                foreach($request->note as $note_key => $note) {
                    $note_index = explode('-', $note_key);

                    if(count($answer_index) === 1 || count($note_index) === 1) {
                        if($answer_index[0] === $note_index[0] && $activity_line->id_kegiatan === (int)$answer_index[0]) {
                            ControlActivityTransactionLine::find($activity_line->id_pengendalian_line)->update([
                                'answer' => $answer,
                                'note' => $note,
                                'updated_by' => $user->id_user
                            ]);
                        }
                    } else {
                        if($answer_index[1] === $note_index[1] && $activity_line->id_kegiatan === (int)$answer_index[0] && $activity_line->id_aktivitas === (int)$answer_index[1]) {
                            ControlActivityTransactionLine::find($activity_line->id_pengendalian_line)->update([
                                'answer' => $answer,
                                'note' => $note,
                                'updated_by' => $user->id_user
                            ]);
                        }
                    }
                }
            }
        }

        ($pengendalian->audit_type === 1) ? $data['route'] = 'Admin:Dashboard:Stages:Desk:Approval:Index' : $data['route'] = 'Admin:Dashboard:Stages:Field:Approval:Index';
        return redirect()->route($data['route'])->with('success', 'Data Pengawasan berhasil di kirim ulang!');
    }

    public function approveDetail($id_pengendalian)
    {
        if(!\Session::has('id_user') && !\Session::has('token')) return redirect()->route('Admin:Login');
        $token              = LoginDetail::where([
            ['id_user', \Session::get('id_user')],
            ['is_active', 1]
        ])->latest()->first();
        if(!$token || \Session::get('token') !== $token->token) return redirect()->route('Admin:Logout');

        $data['user']       = User::find(\Session::get('id_user'));
        $data['route']      = \Route::currentRouteName();
        $data['user_reg']   = RegionUser::select('id_provinsi', 'id_kabupatenkota', 'id_kecamatan', 'type')->where('id_user', \Session::get('id_user'))->get();
        $data['user_type']  = $data['user_reg'][0]->type;
        $data['category']   = MenuCategory::select('id_menu_category', 'name')->where('is_active', 1)->orderBy('id_menu_category', 'desc')->get();
        $data['menu']       = Menu::select('id_menu', 'id_menu_category', 'name', 'url', 'fa_class')->where('is_active', 1)->orderBy('id_menu')->orderBy('name')->get();
        $data['privilege']  = Privilege::select('id_role', 'id_menu', 'id_sub_menu', 'is_create', 'is_read', 'is_update', 'is_delete')->where([
            ['id_role', $data['user']->id_role],
            ['is_active', 1]
        ])->get();
        $data['activity_line']   = \DB::table('t_pengendalian_line')->select('id_pengendalian', 'id_kegiatan', 'id_aktivitas', 'answer', 'note')->where('id_pengendalian', $id_pengendalian)->get();
        $data['pengendalian']    = \DB::table('vw_ai_summary_audit')->where('id_pengendalian', $id_pengendalian)->first();
        $data['id_pengendalian'] = $id_pengendalian;
        $data['tahap']           = $data['pengendalian']->tahap;

        ($data['pengendalian']->audit_type === 1) ? $audit_type = 1 : $audit_type = 2;
        $data['group_act']     = GroupActivity::select('id_grup_kegiatan', 'name')->where([
            ['id_instrumen', 5],
            ['is_active', 1],
            ['audit_type', $audit_type]
        ])->orderBy('name')->get();

        if($data['pengendalian']->nilai < 80 || $data['pengendalian']->nilai > 50) {
            $data['risiko'] = "Sedang";
            $data['patuh']  = "Sedang";
        }
        if($data['pengendalian']->nilai >= 80) {
            $data['risiko'] = "Rendah";
            $data['patuh']  = "Tinggi";
        }
        if($data['pengendalian']->nilai <= 50) {
            $data['risiko'] = "Tinggi";
            $data['patuh']  = "Rendah";
        }

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

        $data['nilai_salur'] = $this->getNilaiSalur($data['pengendalian']->id_tahapan, $data['bos_salur']);
        $data['nilai_lapor'] = $this->getNilaiLapor($data['pengendalian']->id_tahapan, $data['bos_salur']);

        // perhitungan jumlah alokasi
        if($data['school']['bentuk_pendidikan'] == "SMK" || $data['school']['bentuk_pendidikan'] == "SMA") $data['alokasi_siswa'] = 1500000;
        if($data['school']['bentuk_pendidikan'] == "SD" || $data['school']['bentuk_pendidikan'] == "SMP") $data['alokasi_siswa'] = 1200000;

        $data['total_alokasi']  = $data['alokasi_siswa'] * $data['bos_salur']['data'][0]['jumlah_siswa'];
        $data['tahap_1']        = $data['total_alokasi'] * 0.3;
        $data['tahap_2']        = $data['total_alokasi'] * 0.4;
        $data['tahap_3']        = $data['total_alokasi'] * 0.3;

        ($data['pengendalian']->audit_type === 1) ? $data['route'] = 'Admin:Dashboard:Stages:Desk:Approval:Index' : $data['route'] = 'Admin:Dashboard:Stages:Field:Approval:Index';

        return view('pages.stages.approval.approval_detail', compact('data'));
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
}
