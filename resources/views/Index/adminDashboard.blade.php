@extends('layouts.main')

@section('content')

<style>
    /* .btn-pertanyaan:hover {
        background-color: black
    } */

    .hai {
        all: unset
    }
</style>

<p style="text-align: center; font-size: 30px" ><b>Admin Dashboard</b></p>
    <div style="height: 5px; background-color: black"></div>
    <br>

    <div class="container">
        
        <div class="row">
    <a class="btn-pertanyaan col-md-4" style=" text-decoration: none;" href={{route('listUser')}}>
        <div class="m-1" style="background-color: white;border-radius: 50px;border:1px solid black; padding: 20px; font-size: 23px; height: 250px; color: black;">
            <div style="display: flex; flex-direction: column; justify-content: space-between; height: 200px;">
                <div style="overflow: hidden">
                    <div style="text-align: center">
                        <b>User Control</b>
                    </div>
                    </div>
                    <div style="display: flex; flex-direction: row; justify-content: space-between">
                    <div>
                        <span>Jumlah User : {{count($data)}}</span>
        
                    </div>
                        </div>
                
            </div>
        </div>
        </a>

        <a class="btn-pertanyaan col-md-4" style=" text-decoration: none;" href={{route('listPertanyaan')}}>
            <div class="m-1" style="background-color: white;border-radius: 50px;border:1px solid black; padding: 20px; font-size: 23px; height: 250px; color: black;">
                <div style="display: flex; flex-direction: column; justify-content: space-between; height: 200px;">
                    <div style="overflow: hidden">
                        <div style="text-align: center">
                            <b>List Pertanyaan</b>
                        </div>
                    </div>
                        <div style="display: flex; flex-direction: row; justify-content: space-between">
                        <div>
                         <span>Jumlah Pertanyaan : {{count($pertanyaans)}}</span></div>
                    </div>
                </div>  
            </div>
            </a>

            <a class="btn-pertanyaan col-md-4" style=" text-decoration: none;" href={{route('listLaporan')}}>
                <div class="m-1" style="background-color: white;border-radius: 50px;border:1px solid black; padding: 20px; font-size: 23px; height: 250px; color: black;">
                    <div style="display: flex; flex-direction: column; justify-content: space-between; height: 200px;">
                        <div style="overflow: hidden">
                            <div style="text-align: center">
                                <b>Laporan</b>
                            </div>
                        </div>
                            <div style="display: flex; flex-direction: row; justify-content: space-between">
                            <div>
                             <span>Jumlah Laporan : {{count($laporan)}}</span></div>
                        </div>
                        </div>
                </div>
            </div>
                </a>
@endsection