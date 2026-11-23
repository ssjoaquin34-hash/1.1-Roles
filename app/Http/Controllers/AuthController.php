<?php

namespace App\Http\Controllers;

use App\Mail\CodigoVerificacionMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],

        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return back()->withErrors([
                'email' => 'Check',
            ])->onlyInput('email');
        }

        return match($user->role){
            'empleado' => $this->loginEmpleado($request, $user),
            'admin' => $this->loginAdmin($request, $user),
            default => back()->withErrors(['email' => 'credenciales incorrectas, naco']),
        };
    }

        private function loginEmpleado(Request $request, User $user)
        {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('empleado.dashboard');
        }

        private function loginAdmin(Request $request, User $user)
        {
            $codigo = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            $user->update([
                'verification_code' => $codigo,
                'code_expires_at' => Carbon::now()->addMinutes(5),
            ]);

            Mail::to($user->email)->send(new CodigoVerificacionMail($codigo, $user->name));

            $request->session()->put('2fa_user_id', $user->id);

            $urlTemporal = URL::temporarySignedRoute(
                'admin.verification.form',
                now()->addMinutes(5)
            );
            return redirect($urlTemporal);
        }

        public function showVerificationForm()
        {
            return view('auth.verificar_codigo');
        }

        public function verificarCodigo(Request $request)
        {
            $request->validate([
                'codigo' => ['required', 'digits:6'],
            ]);

            $userId = $request->session()->get('2fa_user_id');
            $user = User::find($userId);

            if(!$user){
                return redirect()->route('login')->withErrors(['email' => 'error de inicio de sesion']);
            }

            if($user->verification_code !== $request->codigo){
                return back()->withErrors(['codigo' => 'codigo incorrecto']);
            }

            if(!$user->code_expires_at || Carbon::now()->greaterThan($user->code_expires_at)){
              $user->update(['verification_code' => null, 'code_expires_at' => null]);  
              $request->session()->forget('2fa_user_id');
return redirect()->route('login')->withErrors([
    'email' => 'ese codigo ya ha expirado'
]);
            }

            $user->update([
                'verification_code' => null,
                'code_expires_at' => null,
            ]);

            $request->session()->forget('2fa_user_id');
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login');
        }
    }

