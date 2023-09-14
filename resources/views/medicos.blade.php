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

<form action="#" method="post" class="container">
    <div class="row g-3">
    <br>
        <!--form spaces-->
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
        
        <label class="form-label">Columna 8</label>
        <input type="text" name="col7" class="form-input">
        
        <label class="form-label">Columna 9</label>
        <input type="text" name="col7" class="form-input">
        
        <label class="form-label">Columna 10</label>
        <input type="text" name="col7" class="form-input">
        
        <label class="form-label">Columna 11</label>
        <input type="text" name="col7" class="form-input">
        
        <label class="form-label">Columna 12</label>
        <input type="text" name="col7" class="form-input">
        
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>

@endsection
</body>
</html>