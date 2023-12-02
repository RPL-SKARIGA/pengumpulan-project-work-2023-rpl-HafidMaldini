<?php

namespace App\Http\Controllers;

use App\Models\jawaban;
use App\Models\like;
use App\Models\pertanyaan;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class jawabanController extends Controller
{

    public function store2(Request $request)
    {
        $request->validate([
            'isiJawaban' => 'required',
            'id_soal' => 'required',
        ]);

        $jwb = jawaban::create([
            'isiJawaban' => $request->textarea('isiJawaban'),
            'id_soal' => $request->input('id_soal'),
            'id_user' => auth()->user()->id, // Mengambil ID pengguna yang sedang login
        ]);

        $jwb->save();

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function store(Request $request) {

        $request->validate([
            'id_soal' => 'required',
            'isiJawaban' => 'required'
        ]);
        
        $user_id = Auth::user()->id;

        $pertanyaan = new jawaban([
            'id_soal' => $request->input('id_soal'),
            'id_user' => $user_id, 
            'isiJawaban' => $request->input('isiJawaban'),
            'like_count' => 0
        ]);

        $pertanyaan->save();

        return back()->with('success', 'Jawaban berhasil ditambahkan.');
    }
    public function show($id, Request $request)
    {
        $id_soal = $request('id_soal');
        return view('Index.show', [
            // 'jawaban' => jawaban::where('id_soal', $id_soal)->lastest()->get(),
            'jawaban' => 'ahi'
        ]);
    }
    

    public function destroy2($id, Request $request)
    {
        $url_back = $request->url;
        $jawaban = jawaban::find($id);

        if($jawaban->user_id != Auth::id()){
            $jawaban->delete();
            return redirect()->route('history')->with('error','Anda Bukan Pembuat Jawaban');
        }

        $jawaban->delete();

        return redirect()->route('history')->with('succes', 'jawaban Berhasil Dihapus');
    }

    // public function destroy2($id, Request $request)
    // {
    //     $url_back = $request->url;
    //     $jawaban = jawaban::find($id);
    //     $pertanyaan = pertanyaan::all();

    //     if($jawaban->user_id != Auth::id()){
    //         $jawaban->delete();
    //         return redirect()->route('show', ['id' => $jawaban->id_soal])->with('error','Anda Bukan Pembuat Jawaban');
    //     }

    //     $jawaban->delete();

    //     return redirect()->route('show' . $jawaban->id_soal)->with('succes', 'jawaban Berhasil Dihapus');
    // }

    public function edit(Request $request)
    {
        $jawabanId = $request->input('jawaban_id');
        $updatedJawabanText = $request->input('isiJawaban');

        $jwb = jawaban::find($jawabanId);
        $result = $jwb->update(['isiJawaban' => $updatedJawabanText]);

        if ($result) {
            return $updatedJawabanText;
        } else {
            echo 'error';
        }

    }

}