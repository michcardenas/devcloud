@extends('layouts.app')

@section('title', 'Política de Privacidad')

@section('content')
<section class="max-w-5xl mx-auto py-16 px-4">
    <h1 class="text-3xl font-bold text-cyan-600 mb-8">Política de Privacidad</h1>

    <div class="prose prose-invert prose-sm text-white/90 max-w-none space-y-6">

        <p><strong>Responsable de los datos personales:</strong> Helmcode, en adelante <strong>EL GESTOR DEL SITIO WEB</strong>, y cuyo correo electrónico de contacto es <a href="mailto:info@helmcode.com" class="text-cyan-400 hover:underline">info@helmcode.com</a>.</p>

        <h2 class="text-xl font-semibold text-cyan-500">Datos solicitados y finalidad del tratamiento</h2>
        <p>El sitio web no solicita datos personales a ningún usuario que lo utilice.</p>
        <p>Tampoco se realiza rastreo ni geolocalización alguna sobre ningún usuario.</p>
        <p>No se guarda información ni se proporciona a terceros para realizar ningún tipo de tratamiento, segmentación o depuración de datos bajo ningún concepto.</p>

        <p>Si el usuario tiene menos de 16 años, deberá contar con autorización de sus padres o tutores legales para entregar sus datos personales. EL GESTOR DEL SITIO WEB no puede verificar la edad, por lo tanto, queda eximido de cualquier responsabilidad si esta condición no se cumple.</p>

        <p>El usuario podrá ejercer en cualquier momento sus derechos de acceso, rectificación, cancelación, portabilidad, olvido u oposición escribiendo a <a href="mailto:info@helmcode.com" class="text-cyan-400 hover:underline">info@helmcode.com</a>, conforme a las leyes vigentes en materia de protección de datos.</p>

        <p>EL GESTOR DEL SITIO WEB no compartirá los datos con terceros, salvo para cumplir servicios contratados, exigencias legales o tareas administrativas, y siempre bajo acuerdos de confidencialidad.</p>

        <p>Los enlaces a sitios de terceros tienen sus propias políticas de privacidad. El usuario deberá leer y aceptar dichas políticas de forma independiente.</p>

        <h2 class="text-xl font-semibold text-cyan-500">Encargados del tratamiento</h2>
        <p>EL GESTOR DEL SITIO WEB colabora con terceros bajo acuerdos de confidencialidad y en cumplimiento de la normativa de protección de datos. A continuación, los proveedores actuales:</p>

        <ul class="list-disc pl-6 space-y-2">
            <li>
                <strong>Framer:</strong> Herramienta para desarrollo web. Ubicada en California. Contacto: <a href="mailto:support@framer.com" class="text-cyan-400 hover:underline">support@framer.com</a>. Más info: <a href="https://framer.com/legal" target="_blank" class="text-cyan-400 hover:underline">framer.com/legal</a>.
            </li>
            <li>
                <strong>Calendly:</strong> Herramienta para agendar reuniones. Ubicada en Atlanta, GA. Contacto: <a href="mailto:support@calendly.com" class="text-cyan-400 hover:underline">support@calendly.com</a>. Más info: <a href="https://calendly.com/pages/privacy" target="_blank" class="text-cyan-400 hover:underline">calendly.com/pages/privacy</a>.
            </li>
        </ul>

        <p>EL GESTOR DEL SITIO WEB podrá incorporar nuevas herramientas o servicios, notificando de forma transparente a los usuarios si afectan al tratamiento de datos.</p>

        <h2 class="text-xl font-semibold text-cyan-500">Duración del tratamiento</h2>
        <p>Los datos utilizados para facturación serán conservados según la legislación vigente. Los datos para boletines comerciales pueden eliminarse automáticamente desde el enlace de baja en cada boletín o escribiendo a <a href="mailto:info@helmcode.com" class="text-cyan-400 hover:underline">info@helmcode.com</a>.</p>

    </div>

        <p class="mt-10 text-sm text-gray-500">Última actualización: {{ date('d/m/Y') }}</p>
    </div>
</section>
@endsection
