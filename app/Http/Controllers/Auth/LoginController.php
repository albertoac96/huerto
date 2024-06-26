<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB; //consulta a db

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

   
    protected function authenticated(Request $request, $user)
    {
        $estatus = DB::select("select cEstatus from h_usuarios where email = '".$user->email."'");

        

        if ($estatus[0]->cEstatus !== 'A') {
            Auth::logout();
            return redirect('/admin')->withErrors(['status' => 'Su cuenta está inactiva.']);
        }

        // Si el usuario está activo, continúa con el inicio de sesión
        return redirect()->intended($this->redirectPath());
    }
}
