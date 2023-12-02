
@extends('layouts.main')

@section('content')
    <div style="display: flex; flex-direction: row; justify-content: space-between">
    <a href="{{ route('index')}}" class="btn btn-outline" >Kembali</a>
    <p style="text-align: center; font-size: 30px" ><b>Kelola Pertanyaan dan Jawaban Anda</b></p>
    <span></span>
    </div>
    <div style="height: 5px; background-color: black"></div>
    <br>

    @if(count($pertanyaan) != 0)
    <p style="text-align: center"><b>List Pertanyaan Anda</b></p>
    <?php
    $count = 0;
    ?>
    @foreach ($pertanyaan as $list)
    <?php $count++?>
    <div class="card">
        <div class="card-body">      
            <p>No.{{$count}}</p>
            <div style="display: flex; flex-direction:row; justify-content: space-between">
                <b>Username : {{$list->user->name}}</b>
                <b>Isi Pertanyaan : {{ $list->isiPertanyaan }}</b><br>
                <span>{{$list->created_at->diffForHumans()}}</span><br>
                <a class="btn btn-outline" style="background-color: green" href="{{ route('show3', ['id' => $list->id])}}">Lihat</a>
                <form action="{{ route('pertanyaan.destroy3', ['id' => $list->id]) }}" method="POST">
                    @csrf
                    <button type="submit" style="background-color: red">Hapus</button>
                </form>
            </div>
            
        </div>
    </div>
    <br>
    @foreach ($jawaban as $list2)
    @if ($list2->id_soal == $list->id)    
    <div class="card bg-secondary text-light">
        <div class="card-body">      
            <div style="display: flex; flex-direction:row; justify-content: space-between">
                    <b>Username : {{$list2->user->name}}  </b> <br>
                    <b>isiJawaban : {{$list2->isiJawaban}} </b> <br>
                    <b><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                    </svg>Like : {{$list2->like_count}}</b>
                
                

                <br>
            </div>
            
        </div>
    </div>
    <br>
    @endif
    @endforeach
    @endforeach
    @endif

    @if(count($jawabans) != 0)
    <p style="text-align: center"><b>List Jawaban Anda</b></p>
    @foreach ($jawabans as $jwb)
    <div class="card">
        <div class="card-body">
            <div>
                <p>Pertanyaan :</p>
                <p>{{ $jwb->pertanyaan->isiPertanyaan }}</p>
                <a class="btn btn-outline" style="background-color: green" href="{{ route('show3', ['id' => $jwb->pertanyaan->id])}}">Lihat Detail Pertanyaan</a>
            </div>
            <br>
            <div style="display: flex; flex-direction:row; justify-content: space-between">
                <b> {{ $jwb->user->name }} :</b>
                <span>{{$jwb->created_at->diffForHumans()}}</span>
            </div>
            <p>{{ $jwb->isiJawaban }}</p>
            <form action="{{ route('jawaban.destroy2', ['id' => $jwb->id]) }}" method="POST">
                @csrf
                <button type="submit" style="background-color: red">Hapus</button>
            </form>
        </div>
    </div>
    <br>
    @endforeach
    @endif
    @if(count($jawabans) == 0 && count($pertanyaan) == 0)
    <p style="text-align: center"><b>Anda Belum Pernah Menjawab Atau Membuat Sebuah Pertanyaan</b></p>
    @endif
@endsection
