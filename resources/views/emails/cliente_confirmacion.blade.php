<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de solicitud - Helmcode</title>
    <style>
        body {
            background-color: #f4f6f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            background: #ffffff;
            max-width: 600px;
            margin: 30px auto;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 25px rgba(0,0,0,0.05);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header img {
            max-height: 60px;
        }

        h2 {
            color: #1a202c;
            font-size: 24px;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
        }

        .section-title {
            font-weight: bold;
            margin-top: 30px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
            color: #2d3748;
        }

        .info-item {
            margin: 12px 0;
        }

        .info-item span {
            font-weight: bold;
            color: #4a5568;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 13px;
            color: #a0aec0;
        }

        .cta {
            margin-top: 25px;
            text-align: center;
        }

        .cta a {
            background-color: #1a73e8;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: bold;
            display: inline-block;
            margin-top: 10px;
        }

        .cta a:hover {
            background-color: #1669c1;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/twitter_header_photo_1.png') }}" alt="Helmcode Logo">
        </div>

        <h2>¡Gracias por tu solicitud, {{ $datos['nombre'] }}!</h2>
        <p>Hemos recibido tu briefing sobre <strong>{{ $datos['servicio'] }}</strong> y en breve alguien del equipo de Helmcode se pondrá en contacto contigo.</p>

        <div class="section-title">Resumen de tu solicitud</div>

        <div class="info-item"><span>Empresa:</span> {{ $datos['name_empresa'] }}</div>
        <div class="info-item"><span>Email:</span> {{ $datos['email'] }}</div>
        <div class="info-item"><span>Teléfono:</span> {{ $datos['telefono'] }}</div>
        <div class="info-item"><span>Región:</span> {{ $datos['region'] }}</div>
        <div class="info-item"><span>Presupuesto:</span> {{ $datos['presupuesto'] }}</div>
        <div class="info-item"><span>Mensaje:</span> {{ $datos['mensaje'] }}</div>
        <div class="info-item"><span>Fecha:</span> {{ $datos['fecha'] }}</div>

        <div class="cta">
            <p>¿Tienes algo más que añadir?</p>
            <a href="mailto:hello@helmcode.com">Responder a este correo</a>
        </div>

        <div class="footer">
            © {{ date('Y') }} Helmcode · <a href="https://helmcode.com">helmcode.com</a>
        </div>
    </div>
</body>
</html>
