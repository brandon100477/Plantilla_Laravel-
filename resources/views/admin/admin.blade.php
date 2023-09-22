@extends('all.welcome')
@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="icon" href="{{ asset('img/favicon.png')}}">
        <title>Formulario</title>
    </head>

    <body class="antialiased">
        <form method="POST">
        <br>
        <br>
        <p class="bienvenido">Bienvenido al menú dedicado a administradores, a continuación se presenta una lista con los visitadores medicos registrados hasta la fecha:</p>
        <br><br>
        <div class="collapse show" id="collapseTable">
        <div class="table-wrapper">
        <table id="tabla">
            <thread>
                    <th>Nombre</th>
                    <th>Nombre de usuario</th>
                    <th>Cedula</th>
                    <th>Número de telefono</th>
                    <th>Correo</th>
                    <th>Acceder al perfil</th>
            </thead>
                <tbody>
                @foreach ($datos as $dato)
                        <tr>
                            <td>{{ $dato->nombreApellido }}</td>
                            <td>{{ $dato->usuario }}</td>
                            <td>{{ $dato->cedula }}</td>
                            <td>{{ $dato->telefono }}</td>
                            <td>{{ $dato->correo }}</td>
                            <td>  
                                <form method="post" action="{{ route('acceder')}}">
                                    @csrf
                                    <!--Clasificación para elegir donde será registrado el paciente-->
                                        <input name="{{ $dato->id }}" id="{{ $dato->id }}" type="hidden" value="{{ $dato->id }}">
                                        <button type="submit" >Acceder</button>
                                        <br>
                                </form>
                            </td>
                        </tr>
                        @endforeach
            </tbody>
        </table>
    </div>

    </div>
</form>

</body>

</html>


@endsection
</body>
</html>