@extends('layouts.main')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">

        <a href="{{ route('listLaporan')}}" class="btn btn-outline" >Kembali</a>

        <b><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
          </svg>{{ $report->user->name }} </b>

          <a href="{{ route('pertanyaan.detail', ['id' => $report->id_soal])}}" class="btn btn-outline" >Lihat Pertanyaan</a>
        
    </div>

    <div class="card-body">
        <p class="fs-2">judul : {{ $report->title }}</p>
        <p class="fs-4">Deskripsi : {{ $report->laporan }}</p>
        <span>{{$report->created_at->diffForHumans()}}</span>   
    </div>
@endsection