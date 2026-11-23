@extends('layouts.app')

@section('title', 'Verificación de Administrador')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow border-0 rounded-3">
            <div class="card-header bg-success text-white text-center py-3">
                <h5 class="mb-0 fw-bold">Verificación en Dos Pasos (Administrador)</h5>
            </div>
            <div class="card-body p-4">
                <p class="text-muted text-center">
                    Hemos enviado un código de 6 dígitos a tu correo electrónico registrado. 
                    Tienes <strong>5 minutos</strong> para ingresarlo.
                </p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('admin.verificacion.post') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="codigo" class="form-label fw-semibold">Código de Seguridad</label>
                        <input type="text" name="codigo" id="codigo" maxlength="6" 
                               class="form-control form-control-lg text-center fw-bold fs-3" 
                               placeholder="000000" required autofocus>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg">Verificar y Acceder</button>
                        <a href="{{ route('login') }}" class="btn btn-link text-secondary">Cancelar y volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection