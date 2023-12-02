

@extends('layouts.main')

@section('content')
<div style="display: flex; flex-direction: row; justify-content: space-between">
<a href="{{ route('index')}}" class="btn btn-outline" >Kembali</a>
<p style="text-align: center; font-size: 30px" ><b>HASIL PENCARIAN</b></p>
<span></span>
</div>
<div style="height: 5px; background-color: black; border-radius: 50px;"></div>
<br>
<div class="container">
    <!-- Form Pencarian -->
    <div class="row">
@foreach ($pertanyaans as $task)
    <a class="btn-pertanyaan col-md-6" style=" text-decoration: none;" href={{ route('show2', ['id' => $task->id]) }}>
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
