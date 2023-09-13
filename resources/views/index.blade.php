@extends('all.father')

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="{{ asset('img/favicon.png')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('../../css/app.css')}}">

        <title>Iniciar sesión</title>

    </head>

    <body>
        <!--container login-->
            @section('content')
        <div class="container-sm">
            <form action="{{ route('auth.authenticate') }}" method="POST">
                @csrf
                    <div class="boton">
                        <!--login-->
                        <h2 name="inicio" id="inicio">Inicio de sesiòn</h2>
                    </div>
                    <br>
                    <h4 name="usuario" id="usuario">Usuario</h4>
                    <input type="text" class=" form-control @error('usuario') is-invalid @enderror" value="{{ old('usuario') }}" id="usuario" name="usuario" placeholder="Usuario" required>
                    @error('usuario')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <br>
                    <br>
                    <h4 name="contrasena" id="contrasena">Password</h4>
                    <input type="password" class="form-control @error('contrasena') is-invalid @enderror" name="contrasena" id="contrasena" placeholder="********" required>
                    @error('contrasena')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <br>
                    <br>
                    <div class="boton">
                        <button class="btn btn-lg btn-primary" type="submit">Iniciar sesión</button>
                    </div>
            </form>
        </div>
        @endsection
    </body>     
</html>