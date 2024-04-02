@extends('layouts.main')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">

        <a href="{{ route('report.detail', ['id' => $report->id])}}" class="btn btn-outline" >Kembali</a>

        <b><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
          </svg>{{ $pertanyaan->user->name }} </b>
        
          <form action="{{ route('pertanyaan.destroy2', ['id' => $pertanyaan->id]) }}" method="POST">
            @csrf
            <button type="submit" style="background-color: red">Hapus</button>
        </form>
    </div>

    <div class="card-body">
        <p class="fs-4">{{ $pertanyaan->isiPertanyaan }}</p>
        <span>{{$pertanyaan->created_at->diffForHumans()}}</span>   
    </div>

@endsection