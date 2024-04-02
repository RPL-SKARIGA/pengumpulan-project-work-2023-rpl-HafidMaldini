<!DOCTYPE html>
<html>
<head>
    <title>TAWAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="background-color: rgb(233, 233, 233)">

    <nav class="navbar navbar-light bg-light px-2">
        <div class="container-fluid">
            <a href="{{route('index')}}" class="navbar-brand">{{ config('app.name') }}</a>
            <form class="d-flex w-50" action="{{ route('search') }}" method="get">
                @csrf
                <input class="form-control me-2 text-center" type="search" placeholder="Search" name="keyword" aria-label="Search">
            </form>
            <div class="dropdown">
                <button class="btn btn-outline dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu2">
                    <li><a class="dropdown-item" href="{{ route('history') }}">History</a></li>
                    <li><a class="dropdown-item" href=#>AdminDashBoard</a></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
    </html>