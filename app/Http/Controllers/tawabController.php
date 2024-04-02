<?php

namespace App\Http\Controllers;

use App\Models\jawaban;
use App\Models\kategori;
use App\Models\like;
use App\Models\pertanyaan;
use App\Models\report;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class tawabController extends Controller
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
        $kategori = kategori::all();
        return view('Index.index',compact('pertanyaans', 'jawaban', 'user', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Index.create');
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
        'id_user' => $user_id, // Isi field id_user dengan ID user yang sedang login
        'id_kategori' => $request->input('kategori')
    ]);

    // Simpan pertanyaan ke dalam tabel
    $pertanyaan->save();

    return redirect('/')->with('success', 'Pertanyaan Telah Berhasil Dibuat');
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $url_back = $request->url;
        
        return view('Index.show', [
            'pertanyaan' => pertanyaan::with(['user'])->find($id),
            'url_back' => $url_back,
            'jawaban' => jawaban::with(['user', 'pertanyaan'])->where('id_soal', $id)->orderBy('like_count', 'desc')->latest()->get(),
            'likes' => like::all(),
            'user' => Auth::user()
        ]);
    }

    public function show2($id, Request $request)
    {
        $url_back = $request->url;
        return view('Index.show2', [
            'pertanyaan' => pertanyaan::with(['user'])->find($id),
            'url_back' => $url_back,
            'jawaban' => jawaban::with(['user', 'pertanyaan'])->where('id_soal', $id)->latest()->get(),
            'likes' => like::all(),
            'user' => Auth::user()
        ]);
    }

    public function show3($id, Request $request)
    {
        $url_back = $request->url;
        return view('Index.show3', [
            'pertanyaan' => pertanyaan::with(['user'])->find($id),
            'url_back' => $url_back,
            'jawaban' => jawaban::with(['user', 'pertanyaan'])->where('id_soal', $id)->latest()->get(),
            'likes' => like::all(),
            'user' => Auth::user()
        ]);
    }

    public function history(){
        $pertanyaan = pertanyaan::with(['user'])->orderBy('id', 'asc')->latest()->get();
        foreach($pertanyaan as $pty){
        $id[] = $pty->id;
        }
        // dd(pertanyaan::with(['user'])->latest()->get());
        return view('Index.history',[
            'pertanyaan' => pertanyaan::with(['user'])->where('id_user', Auth::id())->orderBy('id', 'asc')->latest()->get(),
            'jawaban' => jawaban::all(),
            'jawabans' => jawaban::with(['user', 'pertanyaan'])->where('id_user', Auth::id())->latest()->get(),
            'likes' => like::all(),
            'user' => Auth::user()
        ]);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pertanyaan = pertanyaan::find($id);

        if($pertanyaan->user_id !== Auth::id()){
            return redirect()->route('Index.index')->with('error','Anda Bukan Pembuat Pertanyaan');
        }

        return view('Index.edit', compact('pertanyaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pertanyaan $pertanyaan)
    {
        $request->validate([
            'title' => 'required',
            'isiPertanyaan' => 'required'
        ]);

        $pertanyaan->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pertanyaan = pertanyaan::find($id);

        if($pertanyaan->user_id !== Auth::id()){
            return redirect()->route('Index.index')->with('error','Anda Bukan Pembuat Pertanyaan');
        }

        $pertanyaan->delete();

        return redirect()->route('Index.index')->with('succes', 'Pertanyaan Berhasil Dihapus');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

public function search(Request $request)
{
    $keyword = $request->input('keyword');
    $jawaban = jawaban::all()->toArray();
    $pertanyaan = pertanyaan::where('isiPertanyaan', 'LIKE', '%' . $keyword . '%')
        ->get();
    return view('Index.search', [
        'pertanyaans' => $pertanyaan,
        'jawaban' => $jawaban,
        'user' => Auth::user()
    ]);
}

public function matematika(){
    $pertanyaans = Pertanyaan::all()->where('id_kategori' , 1);
        $jawaban = jawaban::all()->toArray();
        $user = Auth::user();
        $kategori = kategori::all();
        return view('Index.matematika',compact('pertanyaans', 'jawaban', 'user', 'kategori'));
}

public function Bindonesia(){
    $pertanyaans = Pertanyaan::all()->where('id_kategori' , 2);
        $jawaban = jawaban::all()->toArray();
        $user = Auth::user();
        $kategori = kategori::all();
        return view('Index.Bindonesia',compact('pertanyaans', 'jawaban', 'user', 'kategori'));
}

public function Binggris(){
    $pertanyaans = Pertanyaan::all()->where('id_kategori' , 3);
        $jawaban = jawaban::all()->toArray();
        $user = Auth::user();
        $kategori = kategori::all();
        return view('Index.Binggris',compact('pertanyaans', 'jawaban', 'user', 'kategori'));
}

public function Bdaerah(){
    $pertanyaans = Pertanyaan::all()->where('id_kategori' , 4);
        $jawaban = jawaban::all()->toArray();
        $user = Auth::user();
        $kategori = kategori::all();
        return view('Index.Bdaerah',compact('pertanyaans', 'jawaban', 'user', 'kategori'));
}

public function Agama(){
    $pertanyaans = Pertanyaan::all()->where('id_kategori' , 5);
        $jawaban = jawaban::all()->toArray();
        $user = Auth::user();
        $kategori = kategori::all();
        return view('Index.Agama',compact('pertanyaans', 'jawaban', 'user', 'kategori'));
}

public function IPA(){
    $pertanyaans = Pertanyaan::all()->where('id_kategori' , 6);
        $jawaban = jawaban::all()->toArray();
        $user = Auth::user();
        $kategori = kategori::all();
        return view('Index.IPA',compact('pertanyaans', 'jawaban', 'user', 'kategori'));
}

public function sbudaya(){
    $pertanyaans = Pertanyaan::all()->where('id_kategori' , 7);
        $jawaban = jawaban::all()->toArray();
        $user = Auth::user();
        $kategori = kategori::all();
        return view('Index.sbudaya',compact('pertanyaans', 'jawaban', 'user', 'kategori'));
}

public function IPS(){
    $pertanyaans = Pertanyaan::all()->where('id_kategori' , 8);
        $jawaban = jawaban::all()->toArray();
        $user = Auth::user();
        $kategori = kategori::all();
        return view('Index.IPS',compact('pertanyaans', 'jawaban', 'user', 'kategori'));
}

public function PPKN(){
    $pertanyaans = Pertanyaan::all()->where('id_kategori' , 9);
        $jawaban = jawaban::all()->toArray();
        $user = Auth::user();
        $kategori = kategori::all();
        return view('Index.PPKN',compact('pertanyaans', 'jawaban', 'user', 'kategori'));
}

public function PJOK(){
    $pertanyaans = Pertanyaan::all()->where('id_kategori' , 10);
        $jawaban = jawaban::all()->toArray();
        $user = Auth::user();
        $kategori = kategori::all();
        return view('Index.PJOK',compact('pertanyaans', 'jawaban', 'user', 'kategori'));
}
public function sejarah(){
    $pertanyaans = Pertanyaan::all()->where('id_kategori' , 11);
        $jawaban = jawaban::all()->toArray();
        $user = Auth::user();
        $kategori = kategori::all();
        return view('Index.sejarah',compact('pertanyaans', 'jawaban', 'user', 'kategori'));
}
public function search2(Request $request)
{
    $keyword = $request->input('keyword');
    $jawaban = jawaban::all()->toArray();
    $user = user::all();
    $pertanyaan = user::where('name', 'LIKE', '%' . $keyword . '%')
        ->get();
    return view('Index.userSearch', [
        'pertanyaans' => $pertanyaan,
        'user' => $user,
        'jawaban' => $jawaban,
        'user' => Auth::user()
    ]);
}

public function search3(Request $request)
{
    $keyword = $request->input('keyword');
    $jawaban = jawaban::all()->toArray();
    $pertanyaan = pertanyaan::where('isiPertanyaan', 'LIKE', '%' . $keyword . '%')
        ->get();
    return view('Index.search', [
        'pertanyaans' => $pertanyaan,
        'jawaban' => $jawaban,
        'user' => Auth::user()
    ]);
}

public function search4(Request $request)
{
    $keyword = $request->input('keyword');
    $jawaban = jawaban::all()->toArray();
    $pertanyaan = report::where('laporan', 'LIKE', '%' . $keyword . '%')
        ->get();
    return view('Index.search', [
        'pertanyaans' => $pertanyaan,
        'jawaban' => $jawaban,
        'user' => Auth::user()
    ]);
}

public function userDestroy($id){
    $user = user::find($id);
    $pertanyaan = pertanyaan::findOrFail(['id_user' => $id]);
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
}
