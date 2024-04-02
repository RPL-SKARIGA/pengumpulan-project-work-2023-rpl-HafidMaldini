@extends('layouts.main')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session()->has('failed'))          
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                {{ session('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @elseif(session()->has('invalidpass'))    
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                {{ session('invalidpass') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">

            <a href="{{ route('index')}}" class="btn btn-outline" >Kembali</a>

            <b><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
              </svg>{{ $pertanyaan->user->name }} </b>
            
              @if( Auth::user()->id != $pertanyaan->id_user )
              <a href={{ route('report' ,['id' => $pertanyaan->id ])}} style="color: red" class="btn btn-outline" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
              </svg></a>
              @endif
        </div>

        <div class="card-body">
            <p class="fs-4">{{ $pertanyaan->isiPertanyaan }}</p>
            <span>{{$pertanyaan->created_at->diffForHumans()}}</span>   
        </div>

    </div>
    <form action="{{ route('jawaban.store') }}" method="POST">
        @csrf
        <textarea rows="2" placeholder="Tambahkan Jawaban" name="isiJawaban" style="resize: none;" class="w-100"></textarea>
        <input type="hidden" name="id_soal" value="{{ $pertanyaan->id }}"> <!-- ID posting yang dikomentari -->
        <button type="submit">Kirim Jawaban</button>
    </form>    
    <br>
    <br>
    <br>
    @if (count($jawaban) != 0)
    <h2>List Jawaban</h2>
    @endif
    @foreach ($jawaban as $jwb)
    <div class="card">
        <div class="card-body">
            <div style="display: flex; flex-direction:row; justify-content: space-between">
                <b> {{ $jwb->user->name }} :</b>
                <span>{{$jwb->created_at->diffForHumans()}}</span>
            </div>
            <div class="jwb-{{$jwb->id}} my-2">
                <p>{{ $jwb->isiJawaban }}</p>
            </div>
            @if (count($likes->where('id_jawaban', $jwb->id)) !== 0)
                @if ($likes->where('id_jawaban', $jwb->id)->where('id_user', Auth::id())->first() !== null)
                <a href="{{ route('unlike.jawaban', $jwb->id) }}" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                  </svg> {{ $likes->where('id_jawaban', $jwb->id)->count() }}</a>
                @else
                <a href="{{ route('like.jawaban', $jwb->id) }}" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                  </svg> {{ $likes->where('id_jawaban', $jwb->id)->count() }}</a>
                @endif
            @else
            <a href="{{ route('like.jawaban', $jwb->id) }}" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
              </svg> {{ $likes->where('id_jawaban', $jwb->id)->count() }}</a>
            @endif
            @if( $jwb->id_user == Auth::user()->id )
            <button class="edit-jawaban" data-id="{{$jwb->id}}" data-jwb="{{$jwb->isiJawaban}}">Edit</button>
            @endif
            {{-- @if( $jwb->id_user == Auth::user()->id )
            <form action="{{ route('jawaban.destroy2', ['id' => $jwb->id]) }}" method="POST">
                @csrf
                <button type="submit" style="background-color: red">Hapus</button>
            @endif --}}
        </div>
    </div>
    {{-- <div id="edit-form">
        <input type="text" id="edited-jawaban" placeholder="Edit Jawaban" value="asd" required>
        <button id="simpan-edit" class="simpan-edit">Simpan</button>
        <button id="batal-edit" class="batal-edit">Batal</button>
    </div> --}}

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="{{ asset('js/script.js') }}"></script> --}}
    <script>
        $(document).ready(function () {
            $('.edit-jawaban').click(function () {
                var id = $(this).data('id');
                var newJwb = '';
                var oldJwb = $(this).data('jwb');
                if(newJwb == '' || oldJwb != newJwb){
                    $('.jwb-'+id).html('<div id="edit-form"><input type="text" value="'+$(this).data('jwb')+'" name="newJwb" class="newJwb"><button id="simpan-edit" class="simpan-edit">Simpan</button><button class="batal-edit">Batal</button></div>');
                }else{
                    $('.jwb-'+id).html('<div id="edit-form"><input type="text" value="'+newJwb+'" name="newJwb" class="newJwb"><button id="simpan-edit" class="simpan-edit">Simpan</button><button class="batal-edit">Batal</button></div>');
                }
                
                $('.batal-edit').click(function () {
                    $('.jwb-'+id).html('<p>'+oldJwb+'</p>');
                });

                $('.simpan-edit').click(function () {
                    var updatedJawaban = $('.newJwb').val();
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '/edit-jawaban',
                        method: 'POST',
                        data: {
                            _token: csrfToken,
                            jawaban_id: id,
                            isiJawaban: updatedJawaban
                        },
                        success: function (response) {
                            if(response != 'error'){
                                window.location.href=window.location.href;
                            }else{
                                alert('Failerd to Update!');
                            }
                        }
                    });
                });
            });
        });
    </script>
    <br>
    @endforeach
@endsection
