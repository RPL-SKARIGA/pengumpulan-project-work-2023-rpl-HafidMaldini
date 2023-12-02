@extends('layouts.main')

@section('content')

<div class="container">
    <h2 style="text-align: center">Buat Laporan</h2>

    <form action="{{ route('laporan.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="title">Judul Laporan</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Masukkan judul laporan" required>
        </div>

        <div class="form-group">
            <label for="content">Isi Laporan</label>
            <textarea class="form-control" style="resize: none" id="content" name="laporan" placeholder="Masukkan isi laporan" rows="5" required></textarea>
            <input type="hidden" name="id_soal" value="{{ $pertanyaan->id }}">
        </div>

        <button type="submit" class="btn btn-primary">Kirim Laporan</button>
    </form>
</div>


@endsection