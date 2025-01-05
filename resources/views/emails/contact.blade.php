<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Mensaje de Contacto</title>
</head>
<body>
    <h1>Tienes un nuevo mensaje de contacto</h1>
    <p><strong>Nombre:</strong> {{ $name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Mensaje:</strong> {{ $mensaje }}</p>
    {{-- <p>{{ $message }}</p> --}}
</body>
</html>