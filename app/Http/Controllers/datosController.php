<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;//post

use Illuminate\Support\Facades\DB; //consulta a db
use Illuminate\Support\Facades\Auth;//identificar usuario

use App\Models\Evento;
use App\Models\Biografia;
use App\Models\Proyecto;
use App\Models\Noticia;
use App\Models\User;
use App\Models\Contenedor;
use App\Models\Experimento;
use App\Models\Planta;
use App\Models\Actividad;
use App\Models\Capacitacion;

use Illuminate\Support\Facades\Mail;
use App\Mail\FormContacto;

class datosController extends Controller
{

    private $sitiosrel;

    public function __construct()
    {
        $this->sitiosrel = DB::table('sitiosrel')->get();
    }
       
    //Funciones de Incio
    public function inicio() {
        $eventos = Evento::where('cEstatus', 'A')
        ->inRandomOrder()
        ->limit(3)
        ->get();
        
        $biografias=Biografia ::where('cEstatus','A')
        ->inRandomOrder()
        ->limit(1)
        ->get();
       
        $proyectos = Proyecto::where('cEstatus','A')
        ->get();

       
        $noticias = Noticia::where('cEstatus','A')
        ->get();

        $data = [
            'eventos'=>$eventos,
            'biografia'=>$biografias,
            'proyectos'=>$proyectos,
            'sitiosrel'=>$this->sitiosrel,
            'noticias'=>$noticias
        ];
        return view("sitio.inicio.inicio")->with($data);
    }


    //Funciones de acerca de
    public function acercade(){
        //$colaboradores = User::where('cEstatus','A')->get();  
        $colaboradores = DB::table('usuarios')->where('cEstatus', 'A')->where('iPublic', 1)->get(); 

        $data = [
            'colaboradores'=>$colaboradores,
            'sitiosrel'=>$this->sitiosrel
        ];
        return view("sitio.acercade.acerca")->with($data);
    }

    //FUNCIONES DE PROYECTOS
    public function verProyectos(){
        $proyectos = Proyecto::where('cEstatus', 'A')->get();
        $data = [
            'proyectos'=>$proyectos,
            'sitiosrel'=>$this->sitiosrel
        ];
        return view("sitio.proyecto.proyectos")->with($data);
    }

    public function verProyecto($id){
        $LcResp = Proyecto::select('T1.*', 'T2.*')
        ->from('proyectos as T1')
        ->leftJoin('usuarios as T2', 'T1.idResponsable', '=', 'T2.idUsuario')
        ->where('T1.idProyecto', '=', $id)
        ->get();

        $data = [
            'proyecto'=>$LcResp[0],
            'sitiosrel'=>$this->sitiosrel
        ];

        return view("sitio.proyecto.verProyecto")->with($data);
    }
  
    public function verPlanta($id){
        $LcResp = Planta::where('idPlanta', '=', $id)
        ->get();

        $data = [
            'planta'=>$LcResp[0],
            'sitiosrel'=>$this->sitiosrel
        ];

        return view("sitio.catalogo.verPlanta")->with($data);
    }
    //FUNCIONES CATALOGO
    public function verCatalogo(){
        $camas = [];
        $ids = [1, 2, 3, 4, 5, 6, 7, 8, 9];

        /*foreach ($ids as $id) {
            $exps = Contenedor::select('T2.*')
            ->from('contenedores as T1')
            ->leftJoin('experimentos as T2', 'T1.idExperimento', '=', 'T2.idExperimento')
            ->where('T1.idContenedor', $id)
            ->get();

            $user = Contenedor::select('contenedores.*', 'usuarios.*')
            ->leftJoin('usuarios', 'contenedores.idEncargado', '=', 'usuarios.idUsuario')
            ->where('contenedores.idContenedor', $id)
            ->get();

            $plantas = Planta::select('T1.*')
            ->from('plantas as T1')
            ->leftJoin('relPlantaContenedor as T2', 'T1.idPlanta', '=', 'T2.idPlanta')
            ->where('T2.idContenedor', $id)
            ->orderBy('T1.cNombre')
            ->get();
            
            $resp = [
                'exps' => $exps,
                'user' => $user,
                'plantas' => $plantas,
            ];

            $camas['cama'.$id] = $resp;
        }*/
       
        $plantas = Planta::where('cEstatus', 'A')
        ->orderBy('cNombre')
        ->get();


        $data = [
            'plantas'=>$plantas,
            //'camas'=>$camas,    
            'sitiosrel'=>$this->sitiosrel
            
        ];
        
        return view("sitio.catalogo.verCatalogo")->with($data);

    }

    public function verInfoCama($id){
        $exps = Contenedor::select('T2.*')
        ->from('contenedores as T1')
        ->leftJoin('experimentos as T2', 'T1.idExperimento', '=', 'T2.idExperimento')
        ->where('T1.idContenedor', $id)
        ->get();

        $user = Contenedor::select('contenedores.*', 'usuarios.*')
        ->leftJoin('usuarios', 'contenedores.idEncargado', '=', 'usuarios.idUsuario')
        ->where('contenedores.idContenedor', $id)
        ->get();

        $plantas = Planta::select('T1.*')
        ->from('plantas as T1')
        ->leftJoin('relPlantaContenedor as T2', 'T1.idPlanta', '=', 'T2.idPlanta')
        ->where('T2.idContenedor', $id)
        ->orderBy('T1.cNombre')
        ->get();

        return response()->json([
            "exps" => $exps, 
            "user" => $user, 
            "plantas" => $plantas
        ]);
    }

    //FUNCIONES ACTIVIDADES
    public function verActividades(){
        $actividades = Actividad::where('cEstatus', 'A')
        ->get();
      
        $data = [
            'actividades'=>$actividades,
            'sitiosrel'=>$this->sitiosrel
              ];
        return view("sitio.actividad.actividades")->with($data);

    }
        //FUNCIONES CAPACITACION
    public function verCapacitacion(){
        $capacitaciones = Capacitacion::where('cEstatus', 'A')
        ->where('cTipo', '!=', 'tutorial')
        ->get();
        $tutoriales = Capacitacion::where('cEstatus', 'A')
        ->where('cTipo', 'tutorial')
        ->get();
        $data = [
            'capacitaciones'=>$capacitaciones,
            'tutoriales'=>$tutoriales,
            'sitiosrel'=>$this->sitiosrel
              ];
        return view("sitio.capacitaciones.verCapacitaciones")->with($data);
    }

    public function Contacto(){
        $data = [
            'sitiosrel'=>$this->sitiosrel
              ];
        return view("sitio.tutorial.contacto")->with($data);
    }

    public function enviarMailContacto(Request $request){
        $recaptcha_response = $request->input('g-recaptcha-response');

        if (is_null($recaptcha_response) || $recaptcha_response="") {
            return redirect()->back()->with('status', 'Please Complete the Recaptcha to proceed');
        }


        Mail::to("huertoibero@gmail.com")->send(new FormContacto($request));
        //Mail::to("huertourbano@ibero.mx")->send(new FormContacto($request));
       
        return redirect()->route('ContactoOK');
    }

    public function ContactoOK(){
        $data = [
            'sitiosrel'=>$this->sitiosrel
              ];
        return view("sitio.tutorial.formok")->with($data);
    }

   
      
}
