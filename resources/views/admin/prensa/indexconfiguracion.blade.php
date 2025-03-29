@extends('layouts.admin')

@section('content')
<div class="servicio-container">
    <h1 class="servicio-title">Administración de Sala de Prensa</h1>

    <ul class="servicio-breadcrumb">
        <li class="servicio-breadcrumb-item">
            <a href="{{ route('dashboard') }}" class="servicio-breadcrumb-link">Dashboard</a>
        </li>
        <li class="servicio-breadcrumb-item">
            <a href="{{ route('admin.prensa.index') }}" class="servicio-breadcrumb-link">Sala de Prensa</a>
        </li>
        <li class="servicio-breadcrumb-item">
            <span class="servicio-breadcrumb-active">Configuración</span>
        </li>
    </ul>

    <ul class="servicio-tabs">
        <li class="servicio-tab-item">
            <a href="{{ route('admin.prensa.index') }}" class="servicio-tab-link">
                <span class="servicio-tab-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                </span>
                Contenidos
            </a>
        </li>
        <li class="servicio-tab-item">
            <a href="{{ route('admin.prensa.categorias') }}" class="servicio-tab-link">
                <span class="servicio-tab-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                        <line x1="7" y1="7" x2="7.01" y2="7"></line>
                    </svg>
                </span>
                Categorías
            </a>
        </li>
        <li class="servicio-tab-item">
            <a href="{{ route('admin.prensa.configuracion') }}" class="servicio-tab-link active">
                <span class="servicio-tab-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                    </svg>
                </span>
                Configuración
            </a>
        </li>
    </ul>

    <div class="servicio-tab-content">
        <div class="servicio-tab-pane active">
            @if(session('success'))
            <div class="servicio-alert servicio-alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px;">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="servicio-alert servicio-alert-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px;">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                {{ session('error') }}
            </div>
            @endif

            <div class="servicio-card">
                <div class="servicio-card-header">
                    <h3 class="servicio-card-title">Configuración de Textos de Sala de Prensa</h3>
                    <p class="servicio-card-subtitle">Personaliza los textos que aparecen en la página de Sala de Prensa</p>
                </div>
                <div class="servicio-card-body">
                    <form action="{{ route('admin.prensa.configuracion.save') }}" method="POST">
                        @csrf

                        <!-- Campos ocultos para valores requeridos -->
                        <input type="hidden" name="notas_prensa_titulo" value="{{ $configuracion['notas_prensa_titulo'] ?? 'Notas de prensa' }}">
                        <input type="hidden" name="apariciones_titulo" value="{{ $configuracion['apariciones_titulo'] ?? 'Apariciones en medios' }}">
                        <input type="hidden" name="recursos_titulo" value="{{ $configuracion['recursos_titulo'] ?? 'Recursos de marca' }}">

                        <!-- Banner Principal -->
                        <div class="servicio-section-title">
                            <h4>Banner Principal</h4>
                        </div>

                        <div class="servicio-form-group">
                            <label for="banner_etiqueta" class="servicio-label">Etiqueta Superior</label>
                            <input type="text" id="banner_etiqueta" name="banner_etiqueta" class="servicio-input" value="{{ $configuracion['banner_etiqueta'] ?? 'Sala de Prensa' }}" required>
                        </div>

                        <div class="servicio-form-group">
                            <label for="banner_titulo" class="servicio-label">Título Principal</label>
                            <input type="text" id="banner_titulo" name="banner_titulo" class="servicio-input" value="{{ $configuracion['banner_titulo'] ?? 'Recursos para medios' }}" required>
                        </div>

                        <div class="servicio-form-group">
                            <label for="banner_subtitulo" class="servicio-label">Subtítulo</label>
                            <textarea id="banner_subtitulo" name="banner_subtitulo" class="servicio-textarea" rows="2" required>{{ $configuracion['banner_subtitulo'] ?? 'Toda la información relevante sobre DevCloud Partners para profesionales de los medios de comunicación.' }}</textarea>
                        </div>

                        <!-- Sección de Recursos -->
                        <div class="servicio-section-title mt-4">
                            <h4>Sección de Recursos</h4>
                        </div>

                        <div class="servicio-form-group">
                            <label for="seccion_etiqueta" class="servicio-label">Etiqueta Superior</label>
                            <input type="text" id="seccion_etiqueta" name="seccion_etiqueta" class="servicio-input" value="{{ $configuracion['seccion_etiqueta'] ?? 'Sala de prensa' }}" required>
                        </div>

                        <div class="servicio-form-group">
                            <label for="seccion_titulo" class="servicio-label">Título de Sección</label>
                            <input type="text" id="seccion_titulo" name="seccion_titulo" class="servicio-input" value="{{ $configuracion['seccion_titulo'] ?? 'Recursos para medios' }}" required>
                        </div>

                        <div class="servicio-form-group">
                            <label for="seccion_subtitulo" class="servicio-label">Subtítulo de Sección</label>
                            <textarea id="seccion_subtitulo" name="seccion_subtitulo" class="servicio-textarea" rows="2" required>{{ $configuracion['seccion_subtitulo'] ?? 'Todo lo que necesitas saber sobre DevCloud Partners para medios de comunicación y material de prensa.' }}</textarea>
                        </div>

                        <!-- Sección de Contacto -->
                        <div class="servicio-section-title mt-4">
                            <h4>Sección de Contacto</h4>
                        </div>

                        <div class="servicio-form-group">
                            <label for="contacto_titulo" class="servicio-label">Título de Contacto</label>
                            <input type="text" id="contacto_titulo" name="contacto_titulo" class="servicio-input" value="{{ $configuracion['contacto_titulo'] ?? 'Contacto para medios' }}" required>
                        </div>

                        <div class="servicio-form-group">
                            <label for="contacto_descripcion" class="servicio-label">Descripción de Contacto</label>
                            <textarea id="contacto_descripcion" name="contacto_descripcion" class="servicio-textarea" rows="2" required>{{ $configuracion['contacto_descripcion'] ?? 'Si eres periodista o medio de comunicación y necesitas más información, no dudes en contactar con nuestro departamento de comunicación.' }}</textarea>
                        </div>

                        <div class="servicio-form-group">
                            <label for="contacto_email" class="servicio-label">Email de Contacto</label>
                            <input type="email" id="contacto_email" name="contacto_email" class="servicio-input" value="{{ $configuracion['contacto_email'] ?? 'prensa@devcloud.es' }}" required>
                        </div>

                        <div class="servicio-form-group">
                            <label for="contacto_telefono" class="servicio-label">Teléfono de Contacto</label>
                            <input type="text" id="contacto_telefono" name="contacto_telefono" class="servicio-input" value="{{ $configuracion['contacto_telefono'] ?? '+34 91 123 45 67' }}" required>
                        </div>

                        <!-- Sección de Suscripción -->
                        <div class="servicio-section-title mt-4">
                            <h4>Sección de Suscripción</h4>
                        </div>

                        <div class="servicio-form-group">
                            <label for="suscripcion_titulo" class="servicio-label">Título de Suscripción</label>
                            <input type="text" id="suscripcion_titulo" name="suscripcion_titulo" class="servicio-input" value="{{ $configuracion['suscripcion_titulo'] ?? 'Suscríbete a nuestras notas de prensa' }}" required>
                        </div>

                        <div class="servicio-form-group">
                            <label for="suscripcion_descripcion" class="servicio-label">Descripción de Suscripción</label>
                            <textarea id="suscripcion_descripcion" name="suscripcion_descripcion" class="servicio-textarea" rows="2" required>{{ $configuracion['suscripcion_descripcion'] ?? 'Recibe nuestras notas de prensa y comunicados directamente en tu email.' }}</textarea>
                        </div>

                        <div class="servicio-form-group">
                            <label for="suscripcion_placeholder" class="servicio-label">Placeholder del Email</label>
                            <input type="text" id="suscripcion_placeholder" name="suscripcion_placeholder" class="servicio-input" value="{{ $configuracion['suscripcion_placeholder'] ?? 'Tu email profesional' }}" required>
                        </div>

                        <div class="servicio-form-group">
                            <label for="suscripcion_boton" class="servicio-label">Texto del Botón</label>
                            <input type="text" id="suscripcion_boton" name="suscripcion_boton" class="servicio-input" value="{{ $configuracion['suscripcion_boton'] ?? 'Suscribirse' }}" required>
                        </div>

                        <div class="servicio-form-group">
                            <label for="suscripcion_consentimiento" class="servicio-label">Texto de Consentimiento</label>
                            <input type="text" id="suscripcion_consentimiento" name="suscripcion_consentimiento" class="servicio-input" value="{{ $configuracion['suscripcion_consentimiento'] ?? 'Acepto recibir comunicaciones y la' }}" required>
                        </div>

                        <!-- Botón de guardar -->
                        <div class="servicio-form-actions">
                            <button type="submit" class="servicio-btn servicio-btn-primary">
                                <span class="servicio-btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                        <polyline points="7 3 7 8 15 8"></polyline>
                                    </svg>
                                </span>
                                Guardar Configuración
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Estilos para la configuración -->
            <style>
                .mt-4 {
                    margin-top: 1.5rem;
                }

                .servicio-section-title {
                    margin-bottom: 1rem;
                    font-weight: 600;
                    color: #fff;
                    padding-bottom: 0.5rem;
                    border-bottom: 1px solid #e9ecef;
                }

                .servicio-section-title h4 {
                    margin: 0;
                    font-size: 1.125rem;
                }

                .servicio-form-actions {
                    margin-top: 1.5rem;
                    padding-top: 1rem;
                    border-top: 1px solid #e9ecef;
                    display: flex;
                    justify-content: flex-end;
                }
            </style>
        </div>
    </div>
</div>
@endsection