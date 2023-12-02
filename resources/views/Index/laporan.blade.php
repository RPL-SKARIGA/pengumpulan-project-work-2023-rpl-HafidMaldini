@extends('layouts.main')

@section('content')
<div style="display: flex; flex-direction: row; justify-content: space-between">
    <a href="{{ route('adminDashboard')}}" class="btn btn-outline" >Kembali</a>
    <p style="text-align: center; font-size: 30px" ><b>List Laporan </b></p>
    <span></span>
</div>
    <div style="height: 5px; background-color: black"></div>

    <br>
    
    <?php
    $count = 0;
    ?>
    @foreach ($report as $list)
    <?php $count++?>
    <div class="card">
        <div class="card-body">
           
                
           
            <p>No.{{$count}}</p>
            <div style="display: flex; flex-direction:row; justify-content: space-between">
                <b>Id : {{ $list->id}}</b>
                <b>Username : {{ $list->user->name }}</b><br>
                <a href={{ route('report.detail' , ['id' => $list->id])}} class="btn btn-outline" >Detail Laporan</a><br>
                <b>Laporan Dibuat : {{$list->created_at->diffForHumans()}}</b>
                <form action="{{ route('laporan.destroy', ['id' => $list->id]) }}" method="POST">
                    @csrf
                    <button type="submit" style="background-color: red">Hapus</button>
                </form>
            </div>
            
        </div>
    </div>
    <br>

    @endforeach
@if(count($report) == 0)
<p style="text-align: center"><b>Tidak Ada User Yang Melapor</b></p>
@endif
@endsection