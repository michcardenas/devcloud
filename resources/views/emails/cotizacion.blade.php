{{-- resources/views/emails/cotizacion.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Solicitud de Cotización</title>
    <style>
        /* Estilos base */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 0;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        /* Encabezado */
        .header {
            background-color: #1e40af;
            padding: 30px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .header p {
            margin: 10px 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        
        /* Contenido */
        .content {
            padding: 30px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section h2 {
            color: #1e40af;
            font-size: 18px;
            margin-top: 0;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e5e7eb;
        }
        .data-row {
            margin-bottom: 10px;
            display: flex;
        }
        .label {
            font-weight: bold;
            width: 40%;
            color: #4b5563;
        }
        .value {
            width: 60%;
        }
        
        /* Caja de mensaje */
        .message-box {
            background-color: #f3f4f6;
            padding: 20px;
            border-radius: 8px;
            margin-top: 10px;
            white-space: pre-line;
        }
        
        /* Nota legal */
        .legal-note {
            font-style: italic;
            color: #6b7280;
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            font-size: 14px;
        }
        
        /* Pie de página */
        .footer {
            background-color: #f3f4f6;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #6b7280;
        }
        .footer img {
            max-width: 150px;
            margin-bottom: 10px;
        }
        
        /* Botón de acción */
        .action-button {
            display: inline-block;
            background-color: #1e40af;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            margin-top: 15px;
            font-weight: 600;
        }
        
        /* Responsivo */
        @media only screen and (max-width: 600px) {
            .container {
                width: 100%;
            }
            .data-row {
                flex-direction: column;
            }
            .label, .value {
                width: 100%;
            }
            .label {
                margin-bottom: 4px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Nueva Solicitud de Cotización</h1>
            <p>Se ha recibido una nueva solicitud de cotización desde el formulario web</p>
        </div>
        
        <div class="content">
            <div class="section">
                <h2>Información del Cliente</h2>
                 
                <div class="data-row">
                    <div class="label">Nombre Empresa:</div>
                    <div class="value">{{ $datos['name_empresa'] }}</div>
                </div>
                
                <div class="data-row">
                    <div class="label">Nombre:</div>
                    <div class="value">{{ $datos['nombre'] }}</div>
                </div>
                
                <div class="data-row">
                    <div class="label">Email:</div>
                    <div class="value">{{ $datos['email'] }}</div>
                </div>
                
                <div class="data-row">
                    <div class="label">Teléfono:</div>
                    <div class="value">{{ $datos['telefono'] }}</div>
                </div>
                
                <div class="data-row">
                    <div class="label">Región:</div>
                    <div class="value">{{ $datos['region'] }}</div>
                </div>
            </div>
            
            <div class="section">
                <h2>Detalles del Proyecto</h2>
                
                <div class="data-row">
                    <div class="label">Servicio solicitado:</div>
                    <div class="value">{{ $datos['servicio'] }}</div>
                </div>
                
                <div class="data-row">
                    <div class="label">Presupuesto estimado:</div>
                    <div class="value">{{ $datos['presupuesto'] }}</div>
                </div>
                
                <div class="data-row">
                    <div class="label">Fecha de solicitud:</div>
                    <div class="value">{{ $datos['fecha'] }}</div>
                </div>
            </div>
            
            <div class="section">
                <h2>Mensaje del Cliente</h2>
                <div class="message-box">
                    {{ $datos['mensaje'] }}
                </div>
                
                <a href="mailto:{{ $datos['email'] }}" class="action-button">Responder al cliente</a>
            </div>
            
            <p class="legal-note">* El cliente ha aceptado la política de privacidad. IP: {{ $datos['ip'] }}</p>
        </div>
        
        <div class="footer">
            <img src="{{ asset('images/twitter_header_photo_1.png') }}" alt="Helmcode Logo">
            <p>© {{ date('Y') }} Helmcode. Todos los derechos reservados.</p>
            <p>Este correo fue generado automáticamente. Por favor no responda a este mensaje.</p>
        </div>
    </div>
</body>
</html>
