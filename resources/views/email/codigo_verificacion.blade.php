<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Código de Verificación</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f6f9; padding: 20px;">
    <div style="max-width: 500px; margin: auto; background: #ffffff; padding: 30px; border-radius: 8px; border-top: 4px solid #006847;">
        <h2 style="color: #333;">bienvenido, {{ $nombreUsuario }}</h2>
        <p style="color: #555;">solicitud de codigo: <strong>Administrador</strong>.</p>
        <p style="color: #555;">Tu código de verificación de un solo uso es:</p>
        <div style="text-align: center; margin: 25px 0;">
            <span style="font-size: 32px; font-weight: bold; letter-spacing: 6px; color: #006847; background: #e8f5e9; padding: 10px 20px; border-radius: 6px;">
                {{ $codigo }}
            </span>
        </div>
        <p style="color: #d9534f; font-size: 14px;"><strong>Importante:</strong> Este código tiene una vigencia máxima de <strong>5 minutos</strong>.</p>
    </div>
</body>
</html>