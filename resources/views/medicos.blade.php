@extends('all.welcome')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="icon" href="{{ asset('img/favicon.png')}}">
        <link rel="stylesheet" href="{{ asset('../../css/medicos.css')}}">
    </head>
    <body>
        @section('content')
        <div class="contenedor">
            <form method="POST">
                <div class="col-md-12">
                    <h4 id="h4">Tienes la facilidad de agregar uno más</h4>
                    <div class="card">
                        <!--Boton para registrar un nuevo formulario.-->
                        <a href="medicos/tipo-de-formulario" id="butons">Agregar</a>
                    </div><br><br><br><br>
                    <h4 id="h4">Ver registros que tiene</h4>
                    <div class="card">
                        <!--Boton para ver los registros hasta el momento.-->
                        <a href="{{ route('registrados') }}" id="butons">Ver</a>
                    </div>
                </div>
            </form>
        </div>    
        @endsection
    </body>
</html>