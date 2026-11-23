@extends('layouts.app')

@section('title', 'Panel de Empleado')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-5 text-center">
        <span class="badge bg-primary mb-2 px-3 py-2">ROL: EMPLEADO</span>
        <h2 class="fw-bold">Bienvenido, {{ Auth::user()->name }}</h2>
        <p class="text-muted">Has ingresado mediante el flujo de autenticación convencional directo.</p>
    </div>
</div>
@endsection