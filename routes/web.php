<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('login'));

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware(['signed', '2fa.pendiente'])->group(function(){
    Route::get('/admin/verificar-codigo', [AuthController::class, 'showVerificationForm'])
    ->name('admin.verification.form');
});

Route::middleware(['2fa.pendiente'])->group(function(){
Route::post('/admin/verificar-codigo', [AuthController::class, 'verificarCodigo'])
->name('admin.verificacion.post');
});

Route::middleware('auth')->group(function(){
Route::post('/logout', [AuthController::class, 'logout'])
->name('logout');


Route::get('/admin/dashboard', function() {
return view('dashboards.admin');    
})->middleware('rol:admin')->name('admin.dashboard');

Route::get('/empleado/dashboard', function (){
return view('dashboards.empleado');
})->middleware('rol:empleado')->name('empleado.dashboard');

});