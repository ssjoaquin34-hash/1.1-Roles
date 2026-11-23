@extends('layouts.app')

@section('title', 'Panel de Administrador')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-5 text-center">
        <span class="badge bg-success mb-2 px-3 py-2">ROL: ADMINISTRADOR</span>
        <h2 class="fw-bold">Bienvenido, {{ Auth::user()->name }}</h2>
        <p class="text-muted">Has completado exitosamente la autenticación de 3 etapas con código temporal.</p>
    </div>
</div>
@endsection