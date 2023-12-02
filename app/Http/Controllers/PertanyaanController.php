<?php

namespace App\Http\Controllers;

use App\Models\pertanyaan;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    public function index()
    {
        $pertanyaan = pertanyaan::all();
        return view('Index.index');
    }
}
