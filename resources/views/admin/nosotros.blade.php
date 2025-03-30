@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="text-light mb-4">Editar Sección Principal</h2>

    <form action="{{ route('admin.nosotros.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card bg-dark text-light border-secondary mb-4">
            <div class="card-header border-bottom border-secondary">
                <strong>Sección Principal</strong>
            </div>

            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label for="tagline1" class="form-label text-light">Tagline 1</label>
                    <input type="text" name="tagline1" class="form-control bg-secondary text-light border-0" value="{{ old('tagline1', $data->tagline1 ?? '') }}">
                </div>

                <div class="col-md-6">
                    <label for="titulo_h1" class="form-label text-light">Título H1</label>
                    <input type="text" name="titulo_h1" class="form-control bg-secondary text-light border-0" value="{{ old('titulo_h1', $data->titulo_h1 ?? '') }}">
                </div>

                <div class="col-12">
                    <label for="contenido1" class="form-label text-light">Contenido 1</label>
                    <textarea name="contenido1" class="form-control bg-secondary text-light border-0" rows="4">{{ old('contenido1', $data->contenido1 ?? '') }}</textarea>
                </div>

                <div class="col-md-6">
                    <label for="imagen1" class="form-label text-light">Imagen 1</label>
                    <input type="file" name="imagen1" class="form-control bg-secondary text-light border-0">

                    @if (!empty($data->imagen1))
                        <div class="mt-2">
                            <small class="text-muted d-block">Imagen actual:</small>
                            <img src="{{ asset($data->imagen1) }}" alt="Imagen 1" class="img-thumbnail mt-1" style="max-width: 200px;">
                        </div>
                    @endif
                </div>

            </div>
        </div>
        {{-- Tarjetas 1 a 4 --}}
<div class="card bg-dark text-light border-secondary mb-4">
    <div class="card-header border-bottom border-secondary">
        <strong>Tarjetas 1 a 4</strong>
    </div>

    <div class="card-body">
        <div class="row g-4">
            @for ($i = 1; $i <= 4; $i++)
            <div class="col-md-6">
                <label for="imagen_tarjeta{{ $i }}" class="form-label text-light">Imagen Tarjeta {{ $i }}</label>
                <input type="file" name="imagen_tarjeta{{ $i }}" class="form-control bg-secondary text-light border-0">

                @if (!empty($data["imagen_tarjeta$i"]))
                    <div class="mt-2">
                        <small class="text-muted d-block">Imagen actual:</small>
                        <img src="{{ asset($data["imagen_tarjeta$i"]) }}" alt="Tarjeta {{ $i }}" class="img-thumbnail mt-1" style="max-width: 200px;">
                    </div>
                @endif
            </div>


                <div class="col-md-6">
                    <label for="titulo_tarjeta{{ $i }}" class="form-label text-light">Título Tarjeta {{ $i }}</label>
                    <input type="text" name="titulo_tarjeta{{ $i }}" class="form-control bg-secondary text-light border-0" value="{{ old("titulo_tarjeta$i", $data["titulo_tarjeta$i"] ?? '') }}">
                </div>

                <div class="col-12">
                    <label for="contenido_tarjeta{{ $i }}" class="form-label text-light">Contenido Tarjeta {{ $i }}</label>
                    <textarea name="contenido_tarjeta{{ $i }}" class="form-control bg-secondary text-light border-0" rows="3">{{ old("contenido_tarjeta$i", $data["contenido_tarjeta$i"] ?? '') }}</textarea>
                </div>

                @if ($i < 4)
                    <hr class="text-secondary my-4">
                @endif
            @endfor
        </div>
    </div>
</div>
{{-- Sección tagline2 + contenido principal 2 --}}
<div class="card bg-dark text-light border-secondary mt-5 mb-4">
    <div class="card-header border-bottom border-secondary">
        <strong>Sección Intermedia</strong>
    </div>

    <div class="card-body row g-4">
        <div class="col-md-6">
            <label for="tagline2" class="form-label text-light">Tagline 2</label>
            <input type="text" name="tagline2" class="form-control bg-secondary text-light border-0" value="{{ old('tagline2', $data->tagline2 ?? '') }}">
        </div>

        <div class="col-md-6">
            <label for="titulo_h2" class="form-label text-light">Título H2</label>
            <input type="text" name="titulo_h2" class="form-control bg-secondary text-light border-0" value="{{ old('titulo_h2', $data->titulo_h2 ?? '') }}">
        </div>

        <div class="col-12">
            <label for="contenido2" class="form-label text-light">Contenido 2</label>
            <textarea name="contenido2" class="form-control bg-secondary text-light border-0" rows="4">{{ old('contenido2', $data->contenido2 ?? '') }}</textarea>
        </div>

        <div class="col-md-6">
                    <label for="imagen1" class="form-label text-light">Imagen 2</label>
                    <input type="file" name="imagen2" class="form-control bg-secondary text-light border-0">

                    @if (!empty($data->imagen1))
                        <div class="mt-2">
                            <small class="text-muted d-block">Imagen actual:</small>
                            <img src="{{ asset($data->imagen2) }}" alt="Imagen 1" class="img-thumbnail mt-1" style="max-width: 200px;">
                        </div>
                    @endif
                </div>

        <div class="col-12">
            <label for="contenido_imagen2" class="form-label text-light">Contenido Imagen 2</label>
            <textarea name="contenido_imagen2" class="form-control bg-secondary text-light border-0" rows="3">{{ old('contenido_imagen2', $data->contenido_imagen2 ?? '') }}</textarea>
        </div>
    </div>
</div>
{{-- Sección Misión, Visión y Valores --}}
<div class="card bg-dark text-light border-secondary mt-5 mb-4">
    <div class="card-header border-bottom border-secondary">
        <strong>Misión, Visión y Valores</strong>
    </div>

    <div class="card-body row g-4">
        {{-- Misión --}}
        <div class="col-md-6">
            <label for="mision" class="form-label text-light">Misión</label>
            <textarea name="mision" class="form-control bg-secondary text-light border-0" rows="3">{{ old('mision', $data->mision ?? '') }}</textarea>
        </div>

        <div class="col-md-6">
            <label for="imagen_mision" class="form-label text-light">Imagen Misión</label>
            <input type="file" name="imagen_mision" class="form-control bg-secondary text-light border-0">

            @if (!empty($data->imagen_mision))
                <div class="mt-2">
                    <small class="text-muted d-block">Imagen actual:</small>
                    <img src="{{ asset($data->imagen_mision) }}" alt="Imagen Misión" class="img-thumbnail mt-1" style="max-width: 200px;">
                </div>
            @endif
        </div>

        {{-- Visión --}}
        <div class="col-md-6">
            <label for="vision" class="form-label text-light">Visión</label>
            <textarea name="vision" class="form-control bg-secondary text-light border-0" rows="3">{{ old('vision', $data->vision ?? '') }}</textarea>
        </div>

        <div class="col-md-6">
            <label for="imagen_vision" class="form-label text-light">Imagen Visión</label>
            <input type="file" name="imagen_vision" class="form-control bg-secondary text-light border-0">

            @if (!empty($data->imagen_vision))
                <div class="mt-2">
                    <small class="text-muted d-block">Imagen actual:</small>
                    <img src="{{ asset($data->imagen_vision) }}" alt="Imagen Visión" class="img-thumbnail mt-1" style="max-width: 200px;">
                </div>
            @endif
        </div>

        {{-- Valores --}}
        <div class="col-md-6">
            <label for="valores" class="form-label text-light">Valores</label>
            <textarea name="valores" class="form-control bg-secondary text-light border-0" rows="3">{{ old('valores', $data->valores ?? '') }}</textarea>
        </div>

        <div class="col-md-6">
            <label for="imagen_valores" class="form-label text-light">Imagen Valores</label>
            <input type="file" name="imagen_valores" class="form-control bg-secondary text-light border-0">

            @if (!empty($data->imagen_valores))
                <div class="mt-2">
                    <small class="text-muted d-block">Imagen actual:</small>
                    <img src="{{ asset($data->imagen_valores) }}" alt="Imagen Valores" class="img-thumbnail mt-1" style="max-width: 200px;">
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Tarjetas 5 a 10 --}}
{{-- Sección Principios y Tarjetas --}}
<div class="card bg-dark text-light border-secondary mt-5 mb-4">
    <div class="card-header border-bottom border-secondary">
        <strong>Principios y Tarjetas</strong>
    </div>

    <div class="card-body row g-4">
        {{-- Tagline y Título --}}
        <div class="col-md-6">
            <label for="tagline3" class="form-label text-light">Tagline 3</label>
            <input type="text" name="tagline3" class="form-control bg-secondary text-light border-0" value="{{ old('tagline3', $data->tagline3 ?? '') }}">
        </div>

        <div class="col-md-6">
            <label for="titulo_h2_principios" class="form-label text-light">Título H2 Principios</label>
            <input type="text" name="titulo_h2_principios" class="form-control bg-secondary text-light border-0" value="{{ old('titulo_h2_principios', $data->titulo_h2_principios ?? '') }}">
        </div>

        <div class="col-12">
            <label for="contenido_principios" class="form-label text-light">Contenido Principios</label>
            <textarea name="contenido_principios" class="form-control bg-secondary text-light border-0" rows="4">{{ old('contenido_principios', $data->contenido_principios ?? '') }}</textarea>
        </div>

        {{-- Repetir tarjetas 5 a 10 --}}
        @for ($i = 5; $i <= 10; $i++)
            <div class="col-md-6">
                <label for="titulo_tarjeta{{ $i }}" class="form-label text-light">Título Tarjeta {{ $i }}</label>
                <input type="text" name="titulo_tarjeta{{ $i }}" class="form-control bg-secondary text-light border-0" value="{{ old("titulo_tarjeta$i", $data->{'titulo_tarjeta' . $i} ?? '') }}">
            </div>

            <div class="col-md-6">
                <label for="imagen_tarjeta{{ $i }}" class="form-label text-light">Imagen Tarjeta {{ $i }}</label>
                <input type="file" name="imagen_tarjeta{{ $i }}" class="form-control bg-secondary text-light border-0">
                @if (!empty($data->{'imagen_tarjeta' . $i}))
                    <div class="mt-2">
                        <small class="text-muted d-block">Imagen actual:</small>
                        <img src="{{ asset($data->{'imagen_tarjeta' . $i}) }}" alt="Tarjeta {{ $i }}" class="img-thumbnail mt-1" style="max-width: 200px;">
                    </div>
                @endif
            </div>

            <div class="col-12">
                <label for="contenido_tarjeta{{ $i }}" class="form-label text-light">Contenido Tarjeta {{ $i }}</label>
                <textarea name="contenido_tarjeta{{ $i }}" class="form-control bg-secondary text-light border-0" rows="3">{{ old("contenido_tarjeta$i", $data->{'contenido_tarjeta' . $i} ?? '') }}</textarea>
            </div>
        @endfor
    </div>
</div>

{{-- Sección Equipo --}}
<div class="card bg-dark text-light border-secondary mt-5 mb-4">
    <div class="card-header border-bottom border-secondary">
        <strong>Sección del Equipo</strong>
    </div>

    <div class="card-body row g-4">
        <div class="col-md-6">
            <label for="tagline4" class="form-label text-light">Tagline 4</label>
            <input type="text" name="tagline4" class="form-control bg-secondary text-light border-0" value="{{ old('tagline4', $data->tagline4 ?? '') }}">
        </div>

        <div class="col-md-6">
            <label for="titulo_h2_equipo" class="form-label text-light">Título H2 Equipo</label>
            <input type="text" name="titulo_h2_equipo" class="form-control bg-secondary text-light border-0" value="{{ old('titulo_h2_equipo', $data->titulo_h2_equipo ?? '') }}">
        </div>

        <div class="col-12">
            <label for="contenido_equipo" class="form-label text-light">Contenido del Equipo</label>
            <textarea name="contenido_equipo" class="form-control bg-secondary text-light border-0" rows="4">{{ old('contenido_equipo', $data->contenido_equipo ?? '') }}</textarea>
        </div>
        
        <div class="col-12 text-end">
        <a href="{{ route('admin.colaboradores.index') }}" class="btn btn-success">Agregar colaborador</a>
    </a>
</div>

    </div>
</div>
        

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-outline-light">Guardar</button>
        </div>
    </form>
</div>
@endsection
