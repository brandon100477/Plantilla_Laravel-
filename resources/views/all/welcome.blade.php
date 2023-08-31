<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <link rel="icon" href="{{ asset('img/favicon.png')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/welcome.css')}}">

    <title>Bienvenido</title>
    
    </head>

    <body class="body">
        @yield('content')

    <footer>
        <div class="boton">
            <p class="mt-5 mb-3 text-muted">&copy; 2023–2025</p>
        </div>
    </footer>
    </body>
</html>