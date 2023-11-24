
<!DOCTYPE html>
<html lang="en">
    <head>
        <!--Solo se debe registrar personal con autorización, desde la pagina de inicio no se debería registrar.-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="{{ asset('img/favicon.png')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

        @vite(['resources/css/registro.css'])
        <title>Registrar</title>

    </head>

    <body>
        <!--CSS: container register-->
        <div class="container">
            <form action="{{ route('auth.register') }}" method="POST">
            @csrf <!--Este metodo ayuda a que los datos del formulario se puedan enviar -->
                <div class="boton">
                    <!--registro de datos a la db: Visitador_medico / tabla: login_usuarios-->
                    <h2 name="regis" id="regis" class="texto_inicio">Registrar usuarios</h2>
                </div><br>

                <h5 name="nombreApellido" id="nombreApellido"class="textos" >1. Nombre y apellido</h5>
                <input type="text" class=" form-control @error('nombreApellido') is-invalid @enderror" value="{{ old('nombreApellido') }}" id="nombreApellido" name="nombreApellido" placeholder="Respuesta:" required>
                <label for="nombreApellido"></label>
                @error('nombreApellido')<!--Metodo para el manejo de errores -->
                {{ $message }}
                @enderror

                <h5 name="usuario" id="usuario"class="textos" >2. Nombre de usuario</h5>
                <input type="text" class=" form-control @error('usuario') is-invalid @enderror" value="{{ old('usuario') }}" id="usuario" name="usuario" placeholder="User" required>
                <label for="name"></label>
                @error('usuario')
                {{ $message }}
                @enderror

                <h5 name="contrasena" id="contrasena"class="textos" >3. Contraseña</h5>
                <input type="password" class=" form-control @error('contrasena') is-invalid @enderror" name="contrasena" id="contrasena" placeholder="*******" required>
                <label for="contrasena"></label>
                @error('contrasena')
                {{ $message }}
                @enderror
                <br>

                <h5 name="cedula" id="cedula"class="textos" >4. Cedula</h5>
                <input type="text" class=" form-control @error('cedula') is-invalid @enderror" name="cedula" id="cedula" placeholder="Ej: 104527587" required>
                <label for="cedula"></label>
                @error('cedula')
                {{ $message }}
                @enderror
                <br>

                <h5 name="telefono" id="telefono"class="textos" >5. Telefono</h5>
                <input type="number" class=" form-control @error('telefono') is-invalid @enderror" name="telefono" id="telefono" placeholder="Ej: 3201452647" required>
                <label for="telefono"></label>
                @error('telefono')
                {{ $message }}
                @enderror
                <br>

                <h5 name="correo" id="correo"class="textos" >6. Email</h5>
                <input type="email" class=" form-control @error('correo') is-invalid @enderror" value="{{ old('correo') }}" id="correo" name="correo" placeholder="example@example.com" required>
                <label for="correo"></label>
                @error('correo')
                {{ $message }}
                @enderror
                <br>

                <!--Se recomienda poner "0" si es un medico o usuario y "1" si es un administrador-->
                <h5 name="tipoUsuario" id="tipoUsuario" class="textos">7. Tipo de usuario</h5>
                <input type="number" class=" form-control @error('tipoUsuario') is-invalid @enderror" name="tipoUsuario" id="tipoUsuario" placeholder="Ej: 0 o 1" required>
                <label for="tipoUsuario"></label>
                @error('tipoUsuario')
                {{ $message }}
                @enderror
                <br><br>

                <div class="boton">
                    <button class="btn-lg boton primary" type="submit" name="button1" id="button1">Registrarse</button>
                </div>
            </form>
        </div>
        <br>
    </body>
</html>