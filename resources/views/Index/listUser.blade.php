@extends('layouts.main')

@section('content')
<div style="display: flex; flex-direction: row; justify-content: space-between">
    <a href="{{ route('adminDashboard')}}" class="btn btn-outline" >Kembali</a>
    <p style="text-align: center; font-size: 30px" ><b>List User </b></p>
    <span></span>
</div>
    <div style="height: 5px; background-color: black"></div>

    <br>
    
    <?php
    $count = 0;
    ?>
    @foreach ($data as $list)
    @if($list->role == "user")
    <?php $count++?>
    <div class="card">
        <div class="card-body">
           
                
           
            <p>No.{{$count}}</p>
            <div style="display: flex; flex-direction:row; justify-content: space-between">
                <b>Username : {{ $list->name }}</b><br>
                <b>Email user : {{ $list->email }}</b><br>
                <b>Akun dibuat : {{$list->created_at->diffForHumans()}}</b>
                <form action="{{ route('user.destroy')}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $list->id }}" name="id">
                    <button type="submit" style="background-color: red">Hapus</button>
                </form>
            </div>
            
        </div>
    </div>
    <br>

@endif
    @endforeach
@if(count($data) == 0)
<p style="text-align: center"><b>Tidak Ada User Yang Terdaftar</b></p>
@endif
@endsection