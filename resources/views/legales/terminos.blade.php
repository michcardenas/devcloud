@extends('layouts.app')

@section('title', 'Términos y Condiciones')

@section('content')



<section class="max-w-5xl mx-auto py-16 px-4">
    <h1 class="text-3xl font-bold text-cyan-600 mb-8">Aviso Legal</h1>
    
    <div class="prose prose-invert prose-sm text-white/90 max-w-none space-y-6">
        <h2 class="text-xl font-semibold text-cyan-500">Datos identificativos</h2>
        <p>
            De acuerdo con la exigencia legal establecida, se cumple con la obligación de informar a todos los usuarios e interesados que la responsabilidad y titularidad del dominio web <strong>helmcode.com</strong>, así como las redes sociales y el sitio web asociadas, en lo adelante el “sitio web” le pertenecen a <strong>Helmcode</strong>, en adelante <strong>EL GESTOR DEL SITIO WEB</strong>, y cuyo correo electrónico de contacto es <a href="mailto:info@helmcode.com" class="text-cyan-400 hover:underline">info@helmcode.com</a>.
        </p>

        <h2 class="text-xl font-semibold text-cyan-500">Términos y Condiciones</h2>
        <h3 class="text-lg font-medium text-white">Uso y Aplicación</h3>
        <p>Los presentes términos y condiciones aplican tanto para la página principal de helmcode.com como para aquellas otras que hayan sido creadas por EL GESTOR DEL SITIO WEB e indiquen de manera expresa e inequívoca que forman parte integrante de este sitio web.</p>

        <h3 class="text-lg font-medium text-white">Usuarios</h3>
        <p>Se entenderá por usuario a toda aquella persona que navegue por el sitio web...</p>

        <h3 class="text-lg font-medium text-white">Formas de Contacto</h3>
        <p>Si un usuario deseara contactar al GESTOR DEL SITIO WEB podrá enviar un correo a <a href="mailto:info@helmcode.com" class="text-cyan-400 hover:underline">info@helmcode.com</a>.</p>

        <h3 class="text-lg font-medium text-white">Uso del Sitio Web</h3>
        <p>Toda la información... está protegida por las leyes de derecho de autor...</p>

        <ul class="list-disc pl-6 space-y-1">
            <li>Realizar actividades ilícitas, ilegales o contrarias a la moral...</li>
            <li>Realizar comentarios o difundir contenidos de carácter ofensivo...</li>
            <li>Provocar daños a personas físicas o jurídicas...</li>
            <li>Introducir virus o sistemas lógicos dañinos en la red...</li>
            <li>Acceder o manipular cuentas de otros usuarios sin autorización.</li>
        </ul>

        <h2 class="text-xl font-semibold text-cyan-500">Propiedad Intelectual</h2>
        <p>EL GESTOR DEL SITIO WEB es titular de todos los derechos de propiedad intelectual...</p>

        <h2 class="text-xl font-semibold text-cyan-500">Exclusión de Garantías y Responsabilidad</h2>
        <p>Se han adoptado todas las medidas tecnológicas necesarias, pero no se garantiza total seguridad contra uso indebido del sitio...</p>

        <h2 class="text-xl font-semibold text-cyan-500">Modificaciones</h2>
        <p>EL GESTOR DEL SITIO WEB se reserva el derecho de modificar el contenido, diseño y estructura del sitio en cualquier momento.</p>

        <h2 class="text-xl font-semibold text-cyan-500">Enlaces</h2>
        <p>No se garantiza responsabilidad sobre contenidos externos enlazados desde este sitio web.</p>

        <h2 class="text-xl font-semibold text-cyan-500">Derecho de Exclusión</h2>
        <p>Se podrá restringir el acceso a usuarios que incumplan los presentes términos sin previo aviso.</p>

        <h2 class="text-xl font-semibold text-cyan-500">Garantía de Resultados</h2>
        <p>EL GESTOR DEL SITIO WEB no garantiza resultados específicos con la información entregada.</p>

        <h2 class="text-xl font-semibold text-cyan-500">Modificación del presente aviso legal y duración</h2>
        <p>Los términos pueden modificarse en cualquier momento y estarán vigentes mientras estén publicados.</p>

        <h2 class="text-xl font-semibold text-cyan-500">Acciones Legales</h2>
        <p>EL GESTOR DEL SITIO WEB podrá ejercer acciones legales contra quienes infrinjan estos términos.</p>
    </div>

       



   <p class="mt-10 text-sm text-gray-500">Última actualización: {{ date('d/m/Y') }}</p>
    </div>
</section>
@endsection
