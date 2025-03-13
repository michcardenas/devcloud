@extends('layouts.app')

@section('title', 'DevCloud Partners - Soluciones en la Nube')

@section('content')

    <!-- Hero Section con fondo oscuro -->
    <section class="relative bg-cover bg-center h-screen flex items-center justify-center text-center text-white"
        style="background-image: url('/images/cloud-dark-bg.jpg');">
        <div class="bg-black bg-opacity-60 w-full h-full absolute"></div>
        <div class="relative z-10 max-w-4xl">
            <h1 class="text-5xl font-bold">Soluciones Cloud a la Medida de tu Negocio</h1>
            <p class="mt-4 text-lg">Optimiza, escala y protege tu infraestructura con nuestras soluciones en la nube.</p>
            <a href="#contacto" class="mt-6 btn btn-primary py-3 px-6 rounded-lg">
                Contáctanos
            </a>
        </div>
    </section>

    <!-- Sección de Servicios con fondo oscuro -->
    <section class="py-20 bg-black text-center">
        <h2 class="text-4xl font-bold text-white">Nuestros Servicios</h2>
        <p class="text-lg text-gray-400 mt-4">Soluciones tecnológicas avanzadas para impulsar tu empresa</p>

        <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <div class="p-6 bg-gray-800 rounded-lg">
                <img src="/images/cloud.png" alt="Cloud Services" class="w-16 mx-auto">
                <h3 class="text-2xl font-bold text-white mt-4">Cloud Computing</h3>
                <p class="mt-2 text-gray-400">Infraestructura segura y escalable con AWS, Azure y Google Cloud.</p>
            </div>

            <div class="p-6 bg-gray-800 rounded-lg">
                <img src="/images/devops.png" alt="DevOps" class="w-16 mx-auto">
                <h3 class="text-2xl font-bold text-white mt-4">DevOps</h3>
                <p class="mt-2 text-gray-400">Automatización y CI/CD para optimizar tu desarrollo.</p>
            </div>

            <div class="p-6 bg-gray-800 rounded-lg">
                <img src="/images/security.png" alt="Cyber Security" class="w-16 mx-auto">
                <h3 class="text-2xl font-bold text-white mt-4">Ciberseguridad</h3>
                <p class="mt-2 text-gray-400">Protección avanzada contra ataques y vulnerabilidades.</p>
            </div>
        </div>
    </section>

    <!-- Sección de Contacto -->
    <section id="contacto" class="py-20 text-white text-center bg-devcloud">
        <h2 class="text-4xl font-bold">Contáctanos</h2>
        <p class="text-lg mt-4">Agenda una reunión con nuestros expertos</p>

        <form class="mt-10 max-w-2xl mx-auto">
            <input type="text" placeholder="Tu Nombre" class="block w-full p-3 rounded-lg mb-4 text-gray-900">
            <input type="email" placeholder="Tu Correo" class="block w-full p-3 rounded-lg mb-4 text-gray-900">
            <textarea placeholder="Tu Mensaje" class="block w-full p-3 rounded-lg mb-4 text-gray-900"></textarea>
            <button class="mt-6 btn btn-primary py-3 px-6 rounded-lg">Enviar</button>
        </form>
    </section>

@endsection