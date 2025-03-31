<!DOCTYPE html>
<html>
<head>
    <title>Nueva Solicitud de Partnership</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #eee;
            padding: 20px;
            border-radius: 5px;
        }
        h1 {
            color: #2563eb;
            font-size: 24px;
        }
        .info-label {
            font-weight: bold;
        }
        .info-section {
            margin-bottom: 10px;
        }
        .message-box {
            background-color: #f9fafb;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Nueva Solicitud de Partnership</h1>
        <p>Se ha recibido una nueva solicitud de partnership con los siguientes detalles:</p>
        
        <div class="info-section">
            <span class="info-label">Nombre:</span> {{ $nombre }}
        </div>
        
        <div class="info-section">
            <span class="info-label">Empresa:</span> {{ $empresa }}
        </div>
        
        <div class="info-section">
            <span class="info-label">Email:</span> {{ $email }}
        </div>
        
        <div class="info-section">
            <span class="info-label">Nivel solicitado:</span> {{ $nivel }}
        </div>
        
        <div class="info-section">
            <span class="info-label">Fecha de solicitud:</span> {{ $fecha }}
        </div>
        
        @if(!empty($mensaje))
        <div class="message-box">
            <span class="info-label">Mensaje del solicitante:</span>
            <p>{{ $mensaje }}</p>
        </div>
        @endif
        
        <p>Este es un correo automático, por favor no responda directamente a este mensaje.</p>
    </div>
</body>
</html>