
@extends('layouts.main')

@section('content')
    {{-- @dd($jawaban) --}}
    <style>
        /* .btn-pertanyaan:hover {
            background-color: black
        } */

        .hai {
            all: unset
        }
    </style>

    <p style="text-align: center; font-size: 30px" ><b>Daftar Pertanyaan</b></p>
    <div style="height: 5px; background-color: black; border-radius: 50px;"></div>
    <br>
    <h1>Buat Pertanyaan Baru</h1>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <span>Pertanyaan harus diisi</span>
        </div>
    @endforeach
@endif
    <form method="POST" action="{{ route('Index.store') }}">
        @csrf

        <div class="input-group mb-3">
  <input  type="text" class="form-control rounded-start-pill" placeholder="Pertanyaan" aria-label="Pertanyaan" aria-describedby="button-addon2" id="description" name="isiPertanyaan">
  <select name="kategori" id="kategori">
    @foreach($kategori as $tag)
        <option value="{{$tag->id}}">{{$tag->name}}</option>
    @endforeach
</select>
  <div id="liveAlertPlaceholder">
  <button class="btn btn-outline-secondary" type="submit" id="liveAlertBtn">Simpan</button>
  </div>
</div>
    </form>

    <br>
    <br>
    <div class="dropdown">
        <button style="background-color: greenyellow; color: black; border-radius: 50px;" class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
            Pilih Kategori
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu2">
            <li><a class="dropdown-item" href="{{ route('index') }}">all</a></li>
            <li><a class="dropdown-item" href="{{ route('matematika') }}">Matematika</a></li>
            <li><a class="dropdown-item" href="{{ route('Bindonesia') }}">Bahasa Indonesia</a></li>
            <li><a class="dropdown-item" href="{{ route('Binggris') }}">Bahasa Inggris</a></li>
            <li><a class="dropdown-item" href="{{ route('Bdaerah') }}">Bahasa Daerah</a></li>
            <li><a class="dropdown-item" href="{{ route('agama') }}">Agama</a></li>
            <li><a class="dropdown-item" href="{{ route('IPA') }}">IPA</a></li>
            <li><a class="dropdown-item" href="{{ route('sbudaya') }}">Seni Budaya</a></li>
            <li><a class="dropdown-item" href="{{ route('IPS') }}">IPS</a></li>
            <li><a class="dropdown-item" href="{{ route('PPKN') }}">PPKN</a></li>
            <li><a class="dropdown-item" href="{{ route('PJOK') }}">PJOK</a></li>
            <li><a class="dropdown-item" href="{{ route('sejarah') }}">Sejarah</a></li>
        </ul>
    </div>
    <br>    

    
    

    <div class="container">
    <!-- Form Pencarian -->
    <div class="row">


    @foreach ($pertanyaans as $task)
    <a class="btn-pertanyaan col-md-6" style=" text-decoration: none;" href={{ url('/pertanyaan/'. $task->id) }}>
        <div class="m-1" style="background-color: white;border-radius: 50px;border:1px solid black; padding: 20px; font-size: 23px; height: 250px; color: black;">
            <div style="display: flex; flex-direction: column; justify-content: space-between; height: 200px;">
                <div style="overflow: hidden">
                    <div>
                        {{$task->isiPertanyaan}}
                    </div>
                </div>
                <div style="display: flex; flex-direction: row; justify-content: space-between">
                    <div >
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                    </svg> {{$task->user->name}}</span>

                    </div>
                    <div>
                <span>{{$task->created_at->diffForHumans()}}</span>

                    </div>
                    <div>
                        <?php
                        $jawab = array_filter($jawaban, function($jwb) use ($task) {
                            return $jwb['id_soal'] == $task->id;
                        });
                        ?>
                        <span> {{count($jawab)}} Jawaban </span>
                    </div>
                </div>
            </div>
        </div>
         
            

        </a>

        
    @endforeach

    </div>
</div>
    @if(count($pertanyaans) == 0)
    <p style="text-align: center"> <b>Tidak Ada Pertanyaan Yang Sudah Dibuat</b></p>
    @endif
    
@endsection
