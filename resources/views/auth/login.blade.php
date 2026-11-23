@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow border-0 rounded-3">
            <div class="card-header bg-white text-center py-3 border-0">
                <h4 class="fw-bold text-success mb-0">Iniciar Sesión</h4>
                <small class="text-muted">Ingresa tus credenciales institucionales</small>
            </div>
            <div class="card-body p-4">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" 
                               value="{{ old('email') }}" placeholder="usuario@utt.edu.mx" required autofocus>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" 
                               placeholder="••••••••" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">Continuar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection