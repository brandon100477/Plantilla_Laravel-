<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="icon" href="{{ asset('img/favicon.png')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <title>tipo de formulario</title>
        <a href="{{ route('volver1')}}" class="cerrar" id="cerrar">Volver</a>
    </head>
    <body>
        <br>
        <h2 id="h2">Seleccione la categoria de formulario que desea diligenciar</h2>
        <br><br>
        <form method="post" action="{{ route('clasificacion') }}">
        @csrf
        <!--Clasificación para elegir donde será registrado el paciente-->
            <input name="tipo" id="tipo" type="hidden" value="tipo">
            <button type="submit" >Doctores</button>
            <br>
        </form>
        <form method="post" action="{{ route('clasificacion') }}">
        @csrf
            <input name="tipo" id="tipo" type="hidden" value="tipo2">
            <button type="submit" >Instituciones</button>
        </form>
        <br>
        <form method="post" action="{{ route('clasificacion') }}">
        @csrf
            <input name="tipo" id="tipo" type="hidden" value="tipo3">
            <button type="submit" >Centro Deportivo</button>
        </form>
        <br>
    </body>
</html>