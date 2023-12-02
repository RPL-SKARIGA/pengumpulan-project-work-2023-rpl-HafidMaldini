

@extends('layouts.main')

@section('content')
    <h1>Edit Tugas</h1>

    <form method="POST" action="{{ route('Index.update', $pertanyaan->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Judul Pertanyaan:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $pertanyaan->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Isi Pertanyaan:</label>
            <textarea class="form-control" id="description" name="description" rows="4">{{ $pertanyaan->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
@endsection
