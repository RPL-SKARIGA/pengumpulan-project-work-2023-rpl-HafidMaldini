@extends('layouts.main')

@section('content')
<div style="display: flex; flex-direction: row; justify-content: space-between">
    <a href="{{ route('adminDashboard')}}" class="btn btn-outline" >Kembali</a>
    <p style="text-align: center; font-size: 30px" ><b>List Pertanyaan</b></p>
    <span></span>
</div>
    <div style="height: 5px; background-color: black"></div>

    <br>
    
    <?php
    $count = 0;
    ?>
    @foreach ($pertanyaan as $list)
    <?php $count++?>
    <div class="card">
        <div class="card-body">      
            <p>No.{{$count}}</p>
            <div style="display: flex; flex-direction:row; justify-content: space-between">
                <b>Id Pertanyaan : {{ $list->id }}</b><br>
                <b>Username : {{$list->user->name}}</b>
                <b>Isi Pertanyaan : {{ $list->isiPertanyaan }}</b><br>
                <span>{{$list->created_at->diffForHumans()}}</span><br>
                <form action="{{ route('pertanyaan.destroy', ['id' => $list->id]) }}" method="POST">
                    @csrf
                    <button type="submit" style="background-color: red">Hapus</button>
                </form>
            </div>
            
        </div>
    </div>
    <br>
    @if(count($jawaban) != 0)
    <b>List Jawaban</b><br>
    @endif
    @foreach ($jawaban as $list2)
    @if ($list2->id_soal == $list->id)    
    <div class="card bg-secondary text-light">
        <div class="card-body">      
            <div style="display: flex; flex-direction:row; justify-content: space-between">
                    <b>Id Jawaban : {{ $list2->id }}</b><br>
                    <b>Username : {{$list2->user->name}}  </b> <br>
                    <b>isiJawaban : {{$list2->isiJawaban}} </b> <br>
                    <b><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                    </svg>Like : {{$list2->like_count}}</b>
                    <form action="{{ route('jawaban.destroy', ['id' => $list2->id]) }}" method="POST">
                        @csrf
                        <button type="submit" style="background-color: red">Hapus</button>
                    </form>
                

                <br>
            </div>
            
        </div>
    </div>
    <br>
    @endif
    @endforeach
    @endforeach
@endsection