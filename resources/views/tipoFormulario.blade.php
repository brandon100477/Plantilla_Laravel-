<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="icon" href="{{ asset('img/favicon.png')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('../../css/tipoFormulario.css')}}">
        <title>tipo de formulario</title>
       
    </head>
    <body>
        <div class="contenedor">
            <section class="inicio">
                <a href="{{ route('volver1')}}" class="cerrar" id="cerrar">Volver al inicio</a><br>
            </section>
            <h2 id="h2">Seleccione la categoria de formulario que desea diligenciar</h2><br><br>
            <div class="col-md-12">
                <div class="cont-bton">
                    <form method="post" action="{{ route('clasificacion') }}">
                        @csrf
                        <!--Clasificación para elegir donde será registrado el paciente-->
                        <input name="tipo" id="tipo" type="hidden" value="tipo">
                        <button class="btn primary btn-block"  type="submit" >Doctores</button>
                    </form>
                </div><br>
                <div class="cont-bton">
                    <form method="post" action="{{ route('clasificacion') }}">
                        @csrf
                        <input name="tipo" id="tipo" type="hidden" value="tipo2">
                        <button class="btn primary btn-block" type="submit" >Instituciones</button>
                    </form>
                </div><br>
                <div class="cont-bton">
                    <form method="post" action="{{ route('clasificacion') }}">
                        @csrf
                        <input name="tipo" id="tipo" type="hidden" value="tipo3">
                        <button class="btn primary btn-block" type="submit" >Centro Deportivo</button>
                    </form>
                </div><br>
            </div>
        </div>
    </body>
</html>