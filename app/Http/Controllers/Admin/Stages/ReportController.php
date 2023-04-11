<?php

namespace App\Http\Controllers\Admin\Stages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

use App\Models\User;
use App\Models\Master\Navigation\Menu;
use App\Models\Master\Navigation\MenuCategory;
use App\Models\Master\Auth\LoginDetail;
use App\Models\Master\Auth\Privilege;
use App\Models\Master\Auth\RegionUser;

class ReportController extends Controller
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
        $data['year']       = \DB::table('m_tahun_anggaran')->select('id_tahun_anggaran', 'name')->where('is_active', 1)->orderBy('name')->get();

        return view('pages.stages.report.report', compact('data'));
    }

    public function download(Request $request)
    {
        $data['report_number']      = $request->report_number;
        $data['attachment']         = $request->attachment;
        $data['time']               = $this->date($request->time);
        $data['year']               = \DB::table('m_tahun_anggaran')->select('id_tahun_anggaran', 'name')->where('id_tahun_anggaran', $request->fiscal_year)->first();
        $data['assignment_number']  = $request->assignment_number;
        $data['audit_start']        = $this->date($request->audit_start);
        $data['audit_end']          = $this->date($request->audit_end);
        $data['position']           = $request->position;
        $data['name']               = $request->name;
        $data['nip']                = $request->nip;
        $data['user_reg']           = \DB::table('vw_user_wilayah')->where('id_user', \Session::get('id_user'))->first();
        $data['school_stages']      = \DB::table('vw_audit_sekolah_jenjang')->where('id_tim', $data['user_reg']->id_tim)->get();
        $data['school_detail']      = \DB::table('vw_ai_summary_audit')->select('id_pengendalian', 'sekolah', 'nilai')->where([
            ['id_tim', $data['user_reg']->id_tim],
            ['state', 'selesai']
        ])->orderBy('sekolah')->get();

        if($data['user_reg']->type === 'Provinsi') {
            $data['region']         = $data['user_reg']->provinsi;
            $data['school_type']    = "SMA/SMALB dan SMK";
            $data['school_count']   = \DB::table('t_pengendalian')->where([
                ['id_tim', $data['user_reg']->id_tim],
                ['state', 'selesai']
            ])->count();
        }

        if($data['user_reg']->type === 'KabupatenKota') {
            $data['region']         = $data['user_reg']->kabupatenkota;
            $data['school_type']    = "SLB/SD/SDLB/SMP dan SMPLB";
            $data['school_count']   = \DB::table('t_pengendalian')->where([
                ['id_tim', $data['user_reg']->id_tim],
                ['state', 'selesai']
            ])->count();
        }
        
        $pdf = PDF::loadView('pages.stages.report.report_download', compact('data'));

        return $pdf->download('Laporan Pengawasan '.$data['report_number'].'.pdf');
    }

    private function date($date) {
        $month = array (
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        );

        $date_explode = explode('-', $date);

        return $date_explode[2] . ' ' . $month[ (int)$date_explode[1] ] . ' ' . $date_explode[0];
    }
}
