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
use App\Models\Master\Stages\ManagementTransaction;
use App\Models\Master\Stages\ManagementTransactionLine;

class ManagementController extends Controller
{
    public function index()
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
        $data['tahap']      = \DB::table('m_tahapan')->select('id_tahapan', 'name')->where('is_active', 1)->get();
        $data['category']   = MenuCategory::select('id_menu_category', 'name')->where('is_active', 1)->orderBy('id_menu_category', 'desc')->get();
        $data['menu']       = Menu::select('id_menu', 'id_menu_category', 'name', 'url', 'fa_class')->where('is_active', 1)->orderBy('id_menu')->orderBy('name')->get();
        $data['privilege']  = Privilege::select('id_role', 'id_menu', 'id_sub_menu', 'is_create', 'is_read', 'is_update', 'is_delete')->where([
            ['id_role', $data['user']->id_role],
            ['is_active', 1]
        ])->get();
        $data['province']    = [];
        $data['ref_wil']     = \DB::table('ref_wilayah')->orderBy('nama')->get();
        $data['fiscal_year'] = \DB::table('m_tahun_anggaran')->orderBy('name')->get();

        foreach($data['ref_wil'] as $ref_wil) {
            $str_split  = str_split($ref_wil->kode_wilayah, 2);

            foreach($data['user_reg'] as $user_reg) {
                if($str_split[1] === "00" && $user_reg->id_provinsi === $ref_wil->id) array_push($data['province'], $ref_wil);
            }
        }

        return view('pages.stages.management.management', compact('data'));
    }

    public function storeManagement($request)
    {
        if($request->state === 'pending') {
            $user = User::find($request->id_user);
            (!$user->id_atasan) ? $state = 'selesai' : $state = 'pending';

            $id_manajemen = ManagementTransaction::create([
                'id_tahun_anggaran' => $request->tahun,
                'id_tim' => $user->id_tim,
                'pending_approver' => $user->id_atasan,
                'id_tahapan' => $request->tahap,
                'tingkat' => $request->user_reg,
                'created_by' => $request->id_user,
                'updated_by' => $request->id_user,
                'is_active' => 1,
                'state' => $state,
            ])->id_t_manajemen;
        }

        return $id_manajemen;
    }

    public function store(Request $request)
    {
        $id_manajemen = $this->storeManagement($request);
        
        foreach($request->answer as $answer_key => $answer) {
            foreach($request->note as $note_key => $note) {
                if($answer_key === $note_key) {
                    ManagementTransactionLine::create([
                        'id_manajemen' => $id_manajemen,
                        'id_kegiatan' => $answer_key,
                        'answer' => $answer,
                        'note' => $note,
                        'created_by' => $request->id_user,
                        'updated_by' => $request->id_user,
                        'is_active' => 1,
                    ]);
                }
            }
        }

        return redirect()->route('Admin:Dashboard:Stages:Field:Management:Index')->with('success', 'Pengisian lembar kerja telah dikerjakan');
    }
}
