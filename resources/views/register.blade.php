@extends('all.father')
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="{{ asset('img/favicon.png')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('../../css/app.css')}}">

        <title>Plantilla2</title>

    </head>

    <body>
        @section('content')
        <div class="container-sm">
            <form action="{{ route('auth.register') }}" method="POST">
            @csrf
                <div class="boton">
                    <h2 name="regis" id="regis">Registrarse</h2>
                    <br>
                </div>
                <h4 name="user1" id="user1"> User</h4>
                <input type="text" class=" form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name" name="name" placeholder="User" required>
                <label for="name"></label>
                @error('name')
                {{ $message }}
                @enderror
                
                <h4 name="password1" id="password1">Password</h4>
                <br>
                <input type="password" class=" form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="*******" required>
                <label for="password"></label>
                @error('password')
                {{ $message }}
                @enderror
                <br>

                <h4 name="password1" id="password1">Confirm password</h4>
                <input type="password" class=" form-control @error('confirm-password') is-invalid @enderror" name="confirm-password" id="confirm-password" placeholder="*******" required>
                <label for="confirm-password"></label>
                @error('confirm-password')
                {{ $message }}
                @enderror
                <br>

                <h4 name="email1" id="email1">Email</h4>
                <input type="email" class=" form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email" placeholder="example@example.com" required>
                <label for="email"></label>
                @error('email')
                {{ $message }}
                @enderror
                <br>
                <br>

                    <div class="boton">
                        <button class="btn btn-lg btn-primary" type="submit" name="button1" id="button1">Registrarse</button>
                    </div>
                <p>¿Ya tienes una cuenta? Entonces <a href="login">Inicia sesiòn</a></p>
            </form>
        </div>
        <br>
        @endsection
    </body>
</html>