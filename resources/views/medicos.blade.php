@extends('all.welcome')
@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="icon" href="{{ asset('img/favicon.png')}}">

    </head>

    <body class="antialiased">
        <form method="POST">

    <br>
<a class="navbar-brand text-sm text-gray-700 dark:text-gray-500 underline">Bienvenid@ <b>{{auth()->user()->nombreApellido}}</b></a>


    <br><br> 

    <div class="col-md-12">
        <div class="card">
            <a href="medicos/tipo-de-formulario" id="butons">Diligenciar Formulario</a>
        </div>

        <br><br><br><br>

        <div class="card">
            <a href="{{ route('registrados') }}" id="butons">Ver formularios registrados</a>
        </div>
    </div>
</form>


@endsection
</body>
</html>