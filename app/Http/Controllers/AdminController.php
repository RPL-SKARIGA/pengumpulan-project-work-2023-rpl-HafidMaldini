<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\jawaban;
use App\Models\like;
use App\Models\pertanyaan;
use App\Models\report;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pertanyaans = Pertanyaan::all();
        $jawaban = jawaban::all()->toArray();
        $user = Auth::user();
        $laporan = report::all();
        $data = user::all()->where('role', "user");

        if($user->role == 'admin'){
        return view('Index.adminDashboard ', compact('pertanyaans','jawaban','user' ,'data','laporan'));
        }else{
            return view(route('index'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'isiPertanyaan' => 'required',
        ]);
    
        // Dapatkan ID user yang sedang login
        $user_id = Auth::user()->id;
    
        // Buat pertanyaan baru dan isi dengan data dari request
        $pertanyaan = new Pertanyaan([
            'isiPertanyaan' => $request->input('isiPertanyaan'),
            'id_user' => $user_id // Isi field id_user dengan ID user yang sedang login
        ]);
    
        // Simpan pertanyaan ke dalam tabel
        $pertanyaan->save();
    
        return redirect('Admin')->with('success', 'Pertanyaan Telah Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPertanyaan($id)
    {
        return view('Admin.show', [
            'pertanyaan' => pertanyaan::with(['user'])->find($id),
            'jawaban' => jawaban::with(['user', 'pertanyaan'])->where('id_soal', $id)->latest()->get(),
            'likes' => like::all()
        ]);
    }

    public function showUser($id)
    {
        return view('Admin.ListUser' , [
            'user' => user::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pertanyaan = pertanyaan::find($id);

        return view('EditPertanyaan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function show($id, Request $request)
    {
        $url_back = $request->url;
        
        return view('Index.show', [
            'pertanyaan' => pertanyaan::with(['user'])->find($id)   ,
            'url_back' => $url_back,
            'jawaban' => jawaban::with(['user', 'pertanyaan'])->where('id_soal', $id)->latest()->get(),
            'likes' => like::all()
        ]);
    }

    public function user()
    {
        return view('Index.listUser',[
            'user' => Auth::user(),
            'data' => user::all()
        ]);
    }

    public function pertanyaan()
    {
        $pertanyaan = pertanyaan::with(['user'])->orderBy('id', 'asc')->latest()->get();
        foreach($pertanyaan as $pty){
        $id[] = $pty->id;
        }
        // dd(pertanyaan::with(['user'])->latest()->get());
        return view('Index.ListPertanyaan',[
            'pertanyaan' => pertanyaan::with(['user'])->orderBy('id', 'asc')->latest()->get(),
            'jawaban' => jawaban::all(),
            'likes' => like::all(),
            'user' => Auth::user()
        ]);
    }

    public function jawaban()
    {
        return view('Index.ListJawaban',[
            'jawaban' => jawaban::all(),
            'user' => Auth::user() 
        ]);
    }

    public function report()
    {
        return view('Index.laporan', [
            'user' => Auth::user(),
            'report' => report::with(['user'])->latest()->get()
        ]);
    }

    public function userDestroy(Request $request){
        $id = $request->input('id');
        $user = user::find($id);
        $pertanyaan = pertanyaan::where(['id_user' => $id])->get();
        foreach ($pertanyaan as $p) {
            $jawaban = jawaban::where('id_soal' , $p->id)->get();
            foreach ($jawaban as $j) {
                $j->delete();
            }
        }
        $jawaban2 = jawaban::where('id_user' , $id)->get();
        foreach ($jawaban2 as $j) {
            $j->delete();
        }
        foreach ($pertanyaan as $p) {
            $p->delete();
        }
        

        $user->delete();

        return redirect()->route('listUser')->with('succes', 'user Berhasil Dihapus');
    }
    
    public function pertanyaanDestroy($id){
        $pertanyaan = pertanyaan::find($id);
        $jawaban = jawaban::where('id_soal', $id)->get();
        $report = report::where('id_soal', $id)->get();

        foreach($report as $u){
            $u->delete();
        }

        foreach($jawaban as $i){
            $i->delete();
        }

        $pertanyaan->delete();

        return redirect()->route('listPertanyaan')->with('succes', 'Pertanyaan Berhasil Dihapus');
    }

    public function jawabanDestroy($id){
        $jawaban = jawaban::find($id);

        $jawaban->delete();

        return redirect()->route('listPertanyaan')->with('succes', 'Jawaban Berhasil Dihapus');
    }

    public function laporanDestroy($id){
        $report = report::find($id);

        $report->delete();
        
        return redirect()->route('listLaporan')->with('succes', 'Laporan Berhasil Dihapus');
    }

    public function detailLaporan($id){
        
        return view('Index.reportDetail',[
            'report' => report::with(['user'])->find($id),
            'user' => Auth::user()
        ]);
    }

    public function detailPertanyaan($id){

        $pertanyaan = pertanyaan::with('user')->find($id);
        $report = report::where('id_soal', $id)->get()->first();

        return view('Index.detailPertanyaan', [
            'pertanyaan' => $pertanyaan,
            'report' => $report,
            'user' => auth::user()
        ]);
    }

    public function pertanyaanDestroy2($id){
        $pertanyaan = pertanyaan::find($id);
        $jawaban = jawaban::where('id_soal', $id)->get();
        $report = report::where('id_soal', $id)->get();

        foreach($report as $u){
            $u->delete();
        }

        foreach($jawaban as $i){
            $i->delete();
        }

        $pertanyaan->delete();

        return redirect()->route('listLaporan')->with('succes', 'Pertanyaan Berhasil Dihapus');
    }
}
