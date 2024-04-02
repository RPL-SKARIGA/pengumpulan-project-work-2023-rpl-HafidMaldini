
@extends('layouts.main')

@section('content')
    <h1>Buat Pertanyaan Baru</h1>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <span>{{ $error }}</span>
        </div>
    @endforeach
@endif
    <form method="POST" action="{{ route('Index.store') }}">
        @csrf

        <div class="form-group">
            <label for="description">Isi Pertanyaan:</label>
            <textarea class="form-control" id="description" name="isiPertanyaan" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
