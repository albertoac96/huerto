<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB; //consulta a db
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;


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

     

        $recaptcha_response = $request->input('g-recaptcha-response');

         // Verifica si la respuesta del reCAPTCHA está presente
         if ($recaptcha_response === "") {
            return redirect()->back()->with('status', 'Completa el reCaptcha para iniciar sesión');
        }

        return ($recaptcha_response);
    
        // Verifica la respuesta del reCAPTCHA con Google
        $response = $this->verifyRecaptcha($recaptcha_response);
    
        if (!$response['success']) {
            return redirect()->back()->with('status', 'La verificación del reCaptcha falló. Inténtalo de nuevo.');
        }
        
    
       
    
        // Lógica de inicio de sesión aquí
        $estatus = DB::select("select cEstatus from h_usuarios where email = '".$user->email."'");
    
        if ($estatus[0]->cEstatus !== 'A') {
            Auth::logout();
            return redirect('/admin')->withErrors(['status' => 'Su cuenta está inactiva.']);
        } 

         // Si el usuario está activo, continúa con el inicio de sesión
        //return redirect()->intended($this->redirectPath());

            
           
    }

    /**
 * Verifica la respuesta del reCAPTCHA con Google
 *
 * @param string $recaptcha_response
 * @return array
 */
private function verifyRecaptcha($recaptcha_response)
{
    $secret_key = config('recaptcha.api_secret_key');
    $verify_url = 'https://www.google.com/recaptcha/api/siteverify';

    $response = Http::asForm()->post($verify_url, [
        'secret' => $secret_key,
        'response' => $recaptcha_response,
        'remoteip' => request()->ip()
    ]);

    return $response->json();
}


}
