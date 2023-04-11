<?php

namespace App\Http\Controllers\Admin\Stages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Master\Navigation\Menu;
use App\Models\Master\Navigation\MenuCategory;
use App\Models\Master\Auth\LoginDetail;
use App\Models\Master\Auth\Privilege;
use App\Models\Master\Auth\RegionUser;
use App\Models\Master\Region\School;
use App\Models\Master\Stages\GroupActivity;
use App\Models\Master\Stages\ControlActivityTransaction;
use App\Models\Master\Stages\ControlActivityTransactionLine;

class ImplementationController extends Controller
{
    public function index(Request $request)
    {
        if(!\Session::has('id_user') && !\Session::has('token')) return redirect()->route('Admin:Login');
        $token              = LoginDetail::where([
            ['id_user', \Session::get('id_user')],
            ['is_active', 1]
        ])->latest()->first();
        if(!$token || \Session::get('token') !== $token->token) return redirect()->route('Admin:Logout');

        $data['user'] = User::find(\Session::get('id_user'));
        $data['user_reg']   = RegionUser::select('id_provinsi', 'id_kabupatenkota', 'id_kecamatan', 'type')->where('id_user', \Session::get('id_user'))->get();
        $data['user_type']  = $data['user_reg'][0]->type;
        $data['category']   = MenuCategory::select('id_menu_category', 'name')->where('is_active', 1)->orderBy('id_menu_category', 'desc')->get();
        $data['menu']       = Menu::select('id_menu', 'id_menu_category', 'name', 'url', 'fa_class')->where('is_active', 1)->orderBy('id_menu')->orderBy('name')->get();
        $data['privilege']  = Privilege::select('id_role', 'id_menu', 'id_sub_menu', 'is_create', 'is_read', 'is_update', 'is_delete')->where([
            ['id_role', $data['user']->id_role],
            ['is_active', 1]
        ])->get();
        $data['tahap']      = \DB::table('m_tahapan')->select('id_tahapan', 'name')->where('is_active', 1)->get();
        $data['route']      = \Route::currentRouteName();
        $data['province']   = [];
        $data['ref_wil']    = \DB::table('ref_wilayah')->orderBy('nama')->get();
        foreach($data['ref_wil'] as $ref_wil) {
            $str_split  = str_split($ref_wil->kode_wilayah, 2);

            foreach($data['user_reg'] as $user_reg) {
                if($user_reg->type !== 'Nasional') {
                    if($str_split[1] === "00" && $user_reg->id_provinsi === $ref_wil->id) array_push($data['province'], $ref_wil);
                } else {
                    if($str_split[1] === "00") array_push($data['province'], $ref_wil);
                }
            }
        }

        if($data['route'] === "Admin:Dashboard:Stages:Desk:Implementation:Index") {
            $data['audit_type'] = 1;
            return view('pages.stages.implementation.implementation', compact('data'));
        }

        if($data['route'] === "Admin:Dashboard:Stages:Field:Implementation:Index") {
            $data['audit_type'] = 2;
            $data['year']       = \DB::table('m_tahun_anggaran')->select('id_tahun_anggaran', 'name')->orderBy('name')->get();
            $data['stages']     = \DB::table('m_tahapan')->select('id_tahapan', 'name')->orderBy('id_tahapan')->get();
            
            if(!empty($request->all()) && $request->id_tahun_anggaran && $request->id_tahapan && $request->risiko) {
                if($request->risiko === 'Rendah') {
                    $data['query'] = [
                        ['id_user', \Session::get('id_user')],
                        // ['id_sekolah', $request->id_sekolah],
                        ['id_tahun_anggaran', $request->id_tahun_anggaran],
                        ['id_tahapan', $request->id_tahapan],
                        ['nilai', '>=', 80]
                    ];
                } elseif ($request->risiko === 'Sedang') {
                    $data['query'] = [
                        ['id_user', \Session::get('id_user')],
                        // ['id_sekolah', $request->id_sekolah],
                        ['id_tahun_anggaran', $request->id_tahun_anggaran],
                        ['id_tahapan', $request->id_tahapan],
                        ['nilai', '>', 50],
                        ['nilai', '<', 80]
                    ];
                } else {
                    $data['query'] = [
                        ['id_user', \Session::get('id_user')],
                        // ['id_sekolah', $request->id_sekolah],
                        ['id_tahun_anggaran', $request->id_tahun_anggaran],
                        ['id_tahapan', $request->id_tahapan],
                        ['nilai', '<=', 50]
                    ];
                }

                $data['school'] = \DB::table('vw_ai_summary_audit')->select('id_pengendalian', 'sekolah', 'auditor', 'tahun', 'tahap', 'nilai')->where($data['query'])->get();
            } else {
                $data['school'] = \DB::table('vw_ai_summary_audit')->select('id_pengendalian', 'sekolah', 'auditor', 'tahun', 'tahap', 'nilai')->where([
                    ['id_user', \Session::get('id_user')],
                    ['state', 'selesai'],
                    ['tahun', '2020'],
                    ['audit_type', 1]
                ])->get();
            }
            return view('pages.stages.implementation.implementation_field', compact('data'));
        }
    }

    public function FieldWorksheet($id_pengendalian, $tahun)
    {
        if(!\Session::has('id_user') && !\Session::has('token')) return redirect()->route('Admin:Login');
        $token              = LoginDetail::where([
            ['id_user', \Session::get('id_user')],
            ['is_active', 1]
        ])->latest()->first();
        if(!$token || \Session::get('token') !== $token->token) return redirect()->route('Admin:Logout');

        $data['user'] = User::find(\Session::get('id_user'));
        $data['user_reg']   = RegionUser::select('id_provinsi', 'id_kabupatenkota', 'id_kecamatan', 'type')->where('id_user', \Session::get('id_user'))->get();
        $data['user_type']  = $data['user_reg'][0]->type;
        $data['category']   = MenuCategory::select('id_menu_category', 'name')->where('is_active', 1)->orderBy('id_menu_category', 'desc')->get();
        $data['menu']       = Menu::select('id_menu', 'id_menu_category', 'name', 'url', 'fa_class')->where('is_active', 1)->orderBy('id_menu')->orderBy('name')->get();
        $data['privilege']  = Privilege::select('id_role', 'id_menu', 'id_sub_menu', 'is_create', 'is_read', 'is_update', 'is_delete')->where([
            ['id_role', $data['user']->id_role],
            ['is_active', 1]
        ])->get();
        $data['group_act']    = GroupActivity::select('id_grup_kegiatan', 'name')->where([
            ['id_instrumen', 5],
            ['is_active', 1],
            ['audit_type', 2]
        ])->orderBy('name')->get();
        $data['audit_type']   = 2;
        $data['status']       = 'Belum Dikerjakan';
        $data['pengendalian'] = ControlActivityTransaction::find($id_pengendalian);
        $data['fiscal_year']  = $tahun;
        $data['worksheet']    = \DB::table('vw_ai_summary_audit')->where([
            ['npsn', $data['pengendalian']->npsn],
            ['id_tahun_anggaran', $data['pengendalian']->id_tahun_anggaran],
            ['id_tahapan', $data['pengendalian']->id_tahapan],
            ['audit_type', $data['audit_type']]
        ])->first();
        $data['tahap']        = $data['worksheet']->tahap;
        $data['id_tahun_anggaran'] = $data['worksheet']->id_tahun_anggaran;

        if(!$data['worksheet']) $data['status'] = 'Belum Dikerjakan';
        if($data['worksheet'] && $data['worksheet']->state === 'draft') {
            $data['activity_line'] = \DB::table('t_pengendalian_line')->select('id_pengendalian', 'id_kegiatan', 'id_aktivitas', 'answer', 'note')->where('id_pengendalian', $data['worksheet']->id_pengendalian)->get();
            $data['status']        = 'Sedang Dikerjakan';
        } elseif($data['worksheet'] && ($data['worksheet']->state === 'selesai' || $data['worksheet']->state === 'pending')) {
            $data['activity_line'] = \DB::table('t_pengendalian_line')->select('id_pengendalian', 'id_kegiatan', 'id_aktivitas', 'answer', 'note')->where('id_pengendalian', $data['worksheet']->id_pengendalian)->get();
            $data['status'] = 'Sudah Dikerjakan';
        }

        $data['token']      = \Http::asForm()->post('https://apicon-rkas.kemdikbud.go.id/token', [
            'userName' => 'itjen@kemdikbud.go.id',
            'password' => 'A0889E7BBA8A43249261C51B2AABAAA5',
            'grant_type' => 'password'
        ])->json();
        $data['school'] = \Http::withToken($data['token']['access_token'])->post('https://apicon-rkas.kemdikbud.go.id/api/itjen/detail_sekolah', [
            'npsn' => $data['pengendalian']->npsn
        ])->json();
        $data['bos_salur'] = \Http::withHeaders([
            'token' => 'E9CC2CC884CFF7F4382C61B7276ABE9620C331F575CE193A5FE152483D001199',
            'id' => 'T001B001R002020A'
        ])->get('https://bos.kemdikbud.go.id/apiv1/sekolah/detail?npsn='.$data['pengendalian']->npsn.'&tahun='.$tahun.'&jenis=REGULER')->json();

        

        return view('pages.stages.implementation.implementation_field_worksheet', compact('data'));
    }

    public function storeControlActivity($request, $id_sekolah, $npsn)
    {
        $pengendalian = \DB::table('t_pengendalian')->where([
            ['id_sekolah', $id_sekolah],
            ['npsn', $npsn],
            ['id_tahun_anggaran', $request->id_tahun_anggaran],
            ['id_tahapan', $request->tahap],
            ['audit_type', $request->audit_type]
        ])->first();

        if(!$pengendalian) {
            if($request->state === 'pending') {
                $user = User::find($request->id_user);
                (!$user->id_atasan) ? $state = 'selesai' : $state = 'pending';
    
                $id_pengendalian  = ControlActivityTransaction::create([
                    'id_sekolah' => $id_sekolah,
                    'npsn' => $npsn,
                    'id_tahun_anggaran' => $request->id_tahun_anggaran,
                    'id_tim' => $user->id_tim,
                    'pending_approver' => $user->id_atasan,
                    'id_tahapan' => $request->tahap,
                    'created_by' => $request->id_user,
                    'updated_by' => $request->id_user,
                    'is_active' => 1,
                    'audit_type' => $request->audit_type,
                    'state' => $state,
                ])->id_pengendalian;
            } else {
                $id_pengendalian = ControlActivityTransaction::create([
                    'id_sekolah' => $id_sekolah,
                    'npsn' => $npsn,
                    'id_tahun_anggaran' => $request->id_tahun_anggaran,
                    'id_tim' => $user->id_tim,
                    'pending_approver' => null,
                    'id_tahapan' => $request->tahap,
                    'created_by' => $request->id_user,
                    'updated_by' => $request->id_user,
                    'is_active' => 1,
                    'audit_type' => $request->audit_type,
                    'state' => $request->state,
                ])->id_pengendalian;
            }
        } else {
            if($request->state === 'pending') {
                $user = User::find($request->id_user);
                (!$user->id_atasan) ? $state = 'selesai' : $state = 'pending';

                $id_pengendalian = ControlActivityTransaction::find($pengendalian->id_pengendalian)->update([
                    'state' => $state,
                    'pending_approver' => $user->id_atasan,
                ])->id_pengendalian;
            }
        }

        if($pengendalian) $id_pengendalian = $pengendalian->id_pengendalian;

        return $id_pengendalian;
    }

    public function storeSchool($request)
    {
        $school  = School::where('npsn', $request->npsn)->first();
        if($school) return [$school->id_sekolah, $school->npsn];

        $ref_wil = \DB::table('ref_wilayah')->where('nama', $request->kabkota)->first();

        $school = School::create([
            'name' => $request->nama_sekolah,
            'id_kabupatenkota' => $ref_wil->id,
            'description' => $request->nama_sekolah,
            'npsn' => $request->npsn,
            'jenjang' => $request->jenjang_sekolah,
            'status' => $request->status_sekolah,
            'created_by' => $request->id_user,
            'updated_by' => $request->id_user,
            'is_active' => 1,
        ]);

        return [$school->id_sekolah, $school->npsn];
    }

    public function store(Request $request)
    {
        $sekolah         = $this->storeSchool($request);
        $id_pengendalian = $this->storeControlActivity($request, $sekolah[0], $sekolah[1]);

        foreach($request->answer as $answer_key => $answer) {
            $answer_index = explode('-', $answer_key);

            foreach($request->note as $note_key => $note) {
                $note_index = explode('-', $note_key);

                if(count($answer_index) === 1 || count($note_index) === 1) {
                    if($answer_index[0] === $note_index[0]) {
                        ControlActivityTransactionLine::create([
                            'id_pengendalian' => $id_pengendalian,
                            'id_kegiatan' => $answer_index[0],
                            'answer' => $answer,
                            'note' => $note,
                            'created_by' => $request->id_user,
                            'updated_by' => $request->id_user,
                            'is_active' => 1,
                        ]);
                    }
                } else {
                    if($answer_index[1] === $note_index[1]) {
                        ControlActivityTransactionLine::create([
                            'id_pengendalian' => $id_pengendalian,
                            'id_kegiatan' => $answer_index[0],
                            'id_aktivitas' => $answer_index[1],
                            'answer' => $answer,
                            'note' => $note,
                            'created_by' => $request->id_user,
                            'updated_by' => $request->id_user,
                            'is_active' => 1,
                        ]);
                    }
                }
            }
        }
    
        $nilai      = \DB::table('vw_ai_summary_audit')->where('id_pengendalian', $id_pengendalian)->first();
        if($nilai->nilai < 80 || $nilai->nilai > 50) $risiko = "Sedang";
        if($nilai->nilai >= 80) $risiko = "Rendah";
        if($nilai->nilai <= 50) $risiko = "Tinggi";
        $message    = "Pengisian Lembar Kerja telah dikerjakan ".$nilai->sekolah." Nilai Akhir ".round($nilai->nilai, 2)." (Kategori Risiko ".$risiko.")";

        if($request->state === 'pending') return redirect()->route('Admin:Dashboard:Stages:Desk:Implementation:Index')->with('success', $message);
        if($request->state === 'draft') return redirect()->route('Admin:Dashboard:Stages:Desk:Implementation:Index')->with('success', 'Pengisian Lembar Kertas Kerja berhasil disimpan');
    }
}
