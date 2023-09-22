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

            <div class="col-md-12">
                <div class="card">
                    <!--Boton para registrar un nuevo formulario.-->
                    <a href="medicos/tipo-de-formulario" id="butons">Diligenciar Formulario</a>
                </div>
        <br><br><br><br>
                <div class="card">
                    <!--Boton para ver los registros hasta el momento.-->
                    <a href="{{ route('registrados') }}" id="butons">Ver formularios registrados</a>
                </div>
            </div>
        </form>
@endsection
    </body>
</html>