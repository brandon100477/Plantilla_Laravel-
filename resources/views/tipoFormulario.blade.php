<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="icon" href="{{ asset('img/favicon.png')}}">
    <title>tipo de formulario</title>
    </head>
<body>
<form method="POST">

    <br>

    <h2 id="h2">Seleccione la categoria de formulario que desea diligenciar</h2>

    <br><br>



    <form action="{{ route('clasificacion') }}" method="GET">
    @csrf
    <input type="submit" name="accion1" value="Doctores">
    </form>
<!---->
        <a href="{{ route('clasificacion') }}" name="accion" value="boton1" id="boton" >Doctores</a>   
    <br><br>

    <input type="hidden" name="accion" value="boton2">
    <div class="card">
            <a name="accion" value="boton1" id="boton2" href="tipo-de-formulario/Instituciones" id="butons">Instituciones</a>
        </div>

    <br><br>
    <input type="hidden" name="accion" value="boton3">
    <div class="card">
            <a name="accion" value="boton1" id="boton3" href="tipo-de-formulario/Centro-Deportivo" id="butons">Centro Deportivo</a>
        </div>
        <br><br>
    </form>

</body>
</html>