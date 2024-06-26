<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Notification</title>
</head>
<body>
    <h2>Nuevo mensaje de formulario de contacto - HUERTO IBERO</h2>
    
    <p><strong>Nombre:</strong> {{ $info['name'] }}</p>
    <p><strong>Apellido:</strong> {{ $info['apellido'] }}</p>
    <p><strong>Email:</strong> {{ $info['mail'] }}</p>
    <p><strong>Telefono:</strong> {{ $info['tel'] }}</p>
    <p><strong>Mensaje:</strong> {{ $info['msj'] }}</p>
</body>
</html>
