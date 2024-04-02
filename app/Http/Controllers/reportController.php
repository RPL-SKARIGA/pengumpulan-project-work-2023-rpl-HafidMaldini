<?php

namespace App\Http\Controllers;

use App\Models\pertanyaan;
use App\Models\report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class reportController extends Controller
{
    public function report($id){
        $user = Auth::user();
        $pertanyaan = pertanyaan::with('user')->find($id);
        return view('Index.report', compact('pertanyaan', 'user'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'laporan' => 'required',
        ]);
        $report = report::all();
        $user_id = Auth::user()->id;
        
        $report = new report([
            'title' => $request->input('title'),
            'laporan' => $request->input('laporan'),
            'id_user' => $user_id,
            'id_soal' => $request->input('id_soal')
        ]);

        $report->save();
    
        return redirect()->route('index')->with('success', 'Laporan Berhasil Dibuat');
    }
}
