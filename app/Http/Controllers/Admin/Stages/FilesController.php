<?php

namespace App\Http\Controllers\Admin\Stages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function rkas($npsn)
    {
        $data['npsn'] = $npsn;

        return view('pages.stages.related_files.rkas', compact('data'));
    }

    public function rkas221($npsn)
    {
        $data['npsn'] = $npsn;

        return view('pages.stages.related_files.rkas221', compact('data'));
    }

    public function sptmh($npsn)
    {
        $data['npsn'] = $npsn;

        return view('pages.stages.related_files.sptmh', compact('data'));
    }

    public function bku($npsn)
    {
        $data['npsn'] = $npsn;

        return view('pages.stages.related_files.bku', compact('data'));
    }

    public function bkuSilpa($npsn)
    {
        $data['npsn'] = $npsn;

        return view('pages.stages.related_files.bkuSilpa', compact('data'));
    }

    public function penggunaan($npsn)
    {
        $data['npsn'] = $npsn;

        return view('pages.stages.related_files.penggunaan', compact('data'));
    }
}
