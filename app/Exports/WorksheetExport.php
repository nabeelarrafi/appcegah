<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class WorksheetExport implements FromView
{
    use Exportable;

    private $wilayah;
    private $kode_wilayah;

    public function __construct($wilayah, $kode_wilayah)
    {
        $this->wilayah      = $wilayah;
        $this->kode_wilayah = $kode_wilayah;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        if($this->wilayah === 'Nasional') {
            $data['region']     = $this->wilayah;
            $data['worksheet']  = \DB::table('vw_ai_data_audit_provinsi_tahap')->where('tahun', '2020')->get();
            return view('pages.data_progress.export.worksheet', compact('data'));
        }

        if($this->wilayah === 'Provinsi') {
            $data['region']         = $this->wilayah;
            $data['worksheet']      = [];
            $data['data_worksheet'] = \DB::table('vw_ai_data_audit_kabupaten_tahap')->where('tahun', '2020')->get();
            foreach($data['data_worksheet'] as $data_worksheet) {
                $str_split = str_split($data_worksheet->kode_kab, 2);
                $wil_split = str_split($this->kode_wilayah, 2);
    
                if($str_split[0] === $wil_split[0] && $str_split[1] !== "00") array_push($data['worksheet'], $data_worksheet);
            }

            return view('pages.data_progress.export.worksheet', compact('data'));
        }

        if($this->wilayah === 'KabupatenKota') {
            $data['region']     = $this->wilayah;
            $data['worksheet']     = \DB::table('vw_ai_summary_audit')->where([
                ['tahun', '2020'],
                ['kode_kab', $this->kode_wilayah]
            ])->get();
            
            return view('pages.data_progress.export.worksheet', compact('data'));
        }
    }
}
