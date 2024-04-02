<?php

namespace App\Http\Controllers;

use App\Models\jawaban;
use App\Models\like;
use App\Models\pertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

public function likeJawaban(jawaban $jawaban)
{

    

    $user = auth()->user();

    // return view("test", [
    //     "test" => like::where('id_jawaban', $jawaban->id)->first()
    // ]);

    $like = like::where('id_user', Auth::id())->where('id_jawaban', $jawaban->id)->first();
    if (!$like) {
        $like = new like();
        $like->id_user = Auth::id();
        $like->id_jawaban = $jawaban->id;
        $like->save();

        $jawaban->increment('like_count');
    }

    return back();
}

public function unlikeJawaban(jawaban $jawaban)
{   
    $like = like::where('id_jawaban', $jawaban->id)->where('id_user', Auth::id())->first();

    if ($like) {
        $like->delete();
        $jawaban->decrement('like_count');
    }

    return back();
}

}
