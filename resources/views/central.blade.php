@extends('all.welcome')
@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="icon" href="{{ asset('img/favicon.png')}}">

        <title>Welcome</title>
            <style>
                body {
                    font-family: 'Nunito', sans-serif;
                }
            </style>
    </head>

    <body class="antialiased">

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/welcome') }}" class="navbar-brand text-sm text-gray-700 dark:text-gray-500 underline">Bienvenido</a>
        @else
            <a href="{{ route('login') }}" class="navbar-brand text-sm text-gray-700 dark:text-gray-500 underline">Iniciar sesión</a>
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="navbar-brand ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Registrarse</a>
        @endif
        @endauth
        @endif
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Pagina1</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pagina2</a>
        </li>

      </ul>
      <form class="d-flex" role="search" action="{{ url('logout') }}" method="POST">
        <button class="form-control me-2 d-grid gap-2 col-6 mx-auto btn btn-outline-success" type="submit">Cerrar sesión</button>
        @csrf
      </form>
        
    </div>
  </div>
</nav>
<br>
<form action="#" method="post" class="container">
    <div class="row g-3">
    <br>
        <!-- ... Repite lo mismo para las otras columnas ... -->
        <label class="form-label">Columna 1</label>
        <input type="text" name="col1" class="form-input">

        <label class="form-label">Columna 2</label>
        <input type="text" name="col2" class="form-input">

        <label class="form-label">Columna 3</label>
        <input type="text" name="col3" class="form-input">

        <label class="form-label">Columna 4</label>
        <input type="text" name="col4" class="form-input">

        <label class="form-label">Columna 5</label>
        <input type="text" name="col5" class="form-input">

        <label class="form-label">Columna 6</label>
        <input type="text" name="col6" class="form-input">

        <label class="form-label">Columna 7</label>
        <input type="text" name="col7" class="form-input">
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>

@endsection


</body>
</html>