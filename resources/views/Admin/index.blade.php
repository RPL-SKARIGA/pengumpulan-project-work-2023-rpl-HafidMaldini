
@extends('layouts.mainAdmin')

@section('content')
    {{-- @dd($jawaban) --}}
    <style>
        .btn-pertanyaan:hover {
            background-color: black
        }

        .hai {
            all: unset
        }

        section span 
{
	position: relative;
	display: block;
	width: calc(6.25vw - 2px);
	height: calc(6.25vw - 2px);
	background: #181818;
	z-index: 2;
	transition: 1.5s;
}
section span:hover 
{
	background: #0f0;
	transition: 0s;
}
    </style>

    <p style="text-align: center; font-size: 30px" ><b>Daftar Pertanyaan</b></p>
    <div style="height: 5px; background-color: black"></div>
    <br>
    <h1>Buat Pertanyaan Baru</h1>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <span>{{ $error }}</span>
        </div>
    @endforeach
@endif
    <form method="POST" action="{{ route('Admin.store') }}">
        @csrf

        <div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Isi Pertanyaan" aria-label="Isi Pertanyaan" aria-describedby="button-addon2" id="description" name="isiPertanyaan">
  <div id="liveAlertPlaceholder">
  <button class="btn btn-outline-secondary" type="submit" id="liveAlertBtn">Simpan</button>
  </div>
</div>
    </form>

    <br>
    <br>
    

    <!-- Form Pencarian -->
    <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1rem;">


    @foreach ($pertanyaans as $task)
    <a class="btn-pertanyaan" style="background-color: white;border:1px solid black; padding: 20px; font-size: 23px; width: 100%; height: 250px; color: black; text-decoration: none;" href={{ url('/pertanyaan/'. $task->id) }}>
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="overflow: hidden">
                    <div style="height: 180px">
                        {{$task->isiPertanyaan}}
                    </div>
                </div>
                <div class="col-md-4">
                <span>User : {{$task->user->name}}</span>

                </div>
                <div class="col-md-4">
            <span>{{$task->created_at->diffForHumans()}}</span>

                </div>
                <div class="col-md-4">
                    <?php
                    $jawab = array_filter($jawaban, function($jwb) use ($task) {
                        return $jwb['id_soal'] == $task->id;
                    });
                    ?>
                    <span> {{count($jawab)}} Jawaban </span>
                </div>
            </div>
        </div>
         
            

        </a>

        
    @endforeach
    </div>
    
@endsection
