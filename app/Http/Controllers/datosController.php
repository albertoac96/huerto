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
use App\Models\ContenedorTipo;

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

         // Define las variables para las metaetiquetas
         $metaTags = [
            'title' => "Huerto IBERO",
            'description' => "El Huerto Ibero surge como una iniciativa del Departamento de Arquitectura, Urbanismo e Ingeniería Civil, así mismo forma parte de los colaboradores del Instituto de Investigación Aplicada y Tecnología (InIAT) encargado de promover el bienestar a través de la transformación tecnológica.",
            'url' => route('inicio'),
            'image' => asset('images/redes_huerto.png'),
            'image_alt' => "huerto_ibero",
        ];


        $data = [
            'eventos'=>$eventos,
            'biografia'=>$biografias,
            'proyectos'=>$proyectos,
            'sitiosrel'=>$this->sitiosrel,
            'noticias'=>$noticias,
            'metaTags' => $metaTags
        ];
        return view("sitio.inicio.inicio")->with($data);
    }


    //Funciones de acerca de
    public function acercade(){
        //$colaboradores = User::where('cEstatus','A')->get();  
        $colaboradores = DB::table('usuarios')->where('cEstatus', 'A')->where('iPublic', 1)->get(); 

        $metaTags = [
            'title' => "Acerca del Huerto",
            'description' => "El Huerto Ibero busca ser un referente en investigación sobre el impacto socioeconómico, en salud y en el medio ambiente que tiene un espacio verde productivo dentro de una institución académica.",
            'url' => route('acercaDe'),
            'image' => asset('images/redes_huerto.png'),
            'image_alt' => "huerto_ibero",
        ];

        $data = [
            'colaboradores'=>$colaboradores,
            'sitiosrel'=>$this->sitiosrel,
            'metaTags' => $metaTags
        ];
        return view("sitio.acercade.acerca")->with($data);
    }

    //FUNCIONES DE PROYECTOS
    public function verProyectos(){
        $proyectos = Proyecto::where('cEstatus', 'A')
        ->orderBy('dInicio', 'desc')
        ->paginate(6); 
        $sitiosrel = $this->sitiosrel;
        $metaTags = [
            'title' => "Proyectos del Huerto",
            'description' => "Se realiza investigación inter y transdisciplinar que aporta a la educación ambiental en temas de agricultura urbana y la mejora de procesos productivos de cultivos urbanos con el acompañamiento de tecnología.",
            'url' => route('showProyectos'),
            'image' => asset('images/redes_huerto.png'),
            'image_alt' => "huerto_ibero",
        ];
        $data = [
            'proyectos'=>$proyectos,
            'sitiosrel'=>$this->sitiosrel,
            'metaTags' => $metaTags
        ];
        return view('sitio.proyecto.proyectos', compact('proyectos', 'sitiosrel', 'metaTags'));
        //return view("sitio.proyecto.proyectos")->with($data);
    }

    public function verProyecto($id){
        $LcResp = Proyecto::select('T1.*', 'T2.*')
        ->from('proyectos as T1')
        ->leftJoin('usuarios as T2', 'T1.idResponsable', '=', 'T2.idUsuario')
        ->where('T1.idProyecto', '=', $id)
        ->get();

        $metaTags = [
            'title' => $LcResp[0]->cNombre,
            'description' => $LcResp[0]->cDescripcion,
            'url' => route('verProyecto', $id),
            'image' => asset('images/content/proyectos/' . $LcResp[0]->idProyecto . ".webp"),
            'image_alt' => "huerto_ibero",
        ];

        $data = [
            'proyecto'=>$LcResp[0],
            'sitiosrel'=>$this->sitiosrel,
            'metaTags' => $metaTags
        ];

        return view("sitio.proyecto.verProyecto")->with($data);
    }
  
    public function verPlanta($id){
        $LcResp = Planta::where('idPlanta', '=', $id)
        ->get();

        $metaTags = [
            'title' => $LcResp[0]->cNombre,
            'description' => $LcResp[0]->cDescripcion,
            'url' => route('verPlanta', $id),
            'image' => asset('images/content/catalogo/' . $LcResp[0]->idPlanta . ".webp"),
            'image_alt' => "huerto_ibero",
        ];

        $data = [
            'planta'=>$LcResp[0],
            'sitiosrel'=>$this->sitiosrel,
            'metaTags' => $metaTags
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

        $contenedores = ContenedorTipo::select(
            'contenedores_tipos.idTipo',
            'contenedores_tipos.cNombre as cContenedor',
            DB::raw('COUNT(h_contenedores.idContenedor) as contenedoresTotal')
        )
        ->leftJoin('contenedores', 'contenedores_tipos.idTipo', '=', 'contenedores.idTipo')
        ->where('contenedores.cEstatus', 'A')
        ->groupBy('contenedores_tipos.idTipo', 'contenedores_tipos.cNombre')
        ->get();

        $mapa = Contenedor::where('cEstatus', 'A')->get();

        $metaTags = [
            'title' => "Cátalogo de plantas",
            'description' => "Explora las diferentes plantas que tenemos en el huerto",
            'url' => route('showCatalogo'),
            'image' => asset('images/redes_huerto.png'),
            'image_alt' => "huerto_ibero",
        ];
    
       
        $data = [
            'plantas'=>$plantas,
            'contenedores'=>$contenedores,    
            'sitiosrel'=>$this->sitiosrel,
            'mapa'=>$mapa,
            'metaTags'=>$metaTags,
        ];
        
        return view("sitio.catalogo.verCatalogo")->with($data);

    }

    public function verInfoCama($id){
        $exps = Contenedor::select('T2.*')
        ->from('contenedores as T1')
        ->leftJoin('experimentos as T2', 'T1.idExperimento', '=', 'T2.idExperimento')
        ->where('T1.idContenedor', $id)
        ->where('T2.cEstatus', 'A')
        ->get();

        $user = Contenedor::select('contenedores.*', 'usuarios.*')
        ->leftJoin('usuarios', 'contenedores.idEncargado', '=', 'usuarios.idUsuario')
        ->where('contenedores.idContenedor', $id)
        ->get();

        $plantas = Planta::select('T1.*')
        ->from('plantas as T1')
        ->leftJoin('relPlantaContenedor as T2', 'T1.idPlanta', '=', 'T2.idPlanta')
        ->where('T2.idContenedor', $id)
        ->where('T2.cEstatus', 'A')
        ->orderBy('T1.cNombre')
        ->get();

        return response()->json([
            "exps" => $exps, 
            "user" => $user, 
            "plantas" => $plantas
        ]);
    }

    public function verEventos(){
        $eventos = Evento::where('cEstatus', 'A')
        ->orderBy('dEvento', 'desc')
        ->paginate(6); 
        $sitiosrel = $this->sitiosrel;
        $metaTags = [
            'title' => "Eventos del huerto",
            'description' => "Explora las diferentes eventos en los que ha participado el huerto",
            'url' => route('showEventos'),
            'image' => asset('images/redes_huerto.png'),
            'image_alt' => "huerto_ibero",
        ];
        return view('sitio.eventos.verEventos', compact('eventos', 'sitiosrel', 'metaTags'));
    }

    public function verNoticias(){
        $noticias = Noticia::where('cEstatus', 'A')
        ->orderBy('created_at', 'desc')
        ->paginate(6); 
        $sitiosrel = $this->sitiosrel;
        $metaTags = [
            'title' => "Noticias del huerto",
            'description' => "Explora las diferentes noticias sobre los trabajos en el huerto",
            'url' => route('showNoticias'),
            'image' => asset('images/redes_huerto.png'),
            'image_alt' => "huerto_ibero",
        ];
        return view('sitio.noticias.noticias', compact('noticias', 'sitiosrel', 'metaTags'));
    }

    //FUNCIONES ACTIVIDADES
    public function verActividades(){
        $actividades = Actividad::where('cEstatus', 'A')
        ->orderBy('dActividad', 'desc')
        ->paginate(6); 
        $sitiosrel = $this->sitiosrel;
        $metaTags = [
            'title' => "Actividades del huerto",
            'description' => "Explora las diferentes actividades que el huerto te ofrece",
            'url' => route('showActividades'),
            'image' => asset('images/redes_huerto.png'),
            'image_alt' => "huerto_ibero",
        ];
        $data = [
            'actividades'=>$actividades,
            'sitiosrel'=>$this->sitiosrel
              ];
        return view('sitio.actividad.actividades', compact('actividades', 'sitiosrel', 'metaTags'));
        //return view("sitio.actividad.actividades")->with($data);

    }
        //FUNCIONES CAPACITACION
    public function verCapacitacion(){
        $capacitaciones = Capacitacion::where('cEstatus', 'A')
        ->where('cTipo', '!=', 'tutorial')
        ->orderBy('created_at', 'desc')
        ->paginate(3);  
        $tutoriales = Capacitacion::where('cEstatus', 'A')
        ->where('cTipo', 'tutorial')
        ->orderBy('created_at', 'desc')
        ->paginate(3);  
        $sitiosrel = $this->sitiosrel;
        $metaTags = [
            'title' => "Cursos y talleres del huerto",
            'description' => "Explora las diferentes cursos y talleres que el huerto te ofrece",
            'url' => route('showCapacitacion'),
            'image' => asset('images/redes_huerto.png'),
            'image_alt' => "huerto_ibero",
        ];
        $data = [
            'capacitaciones'=>$capacitaciones,
            'tutoriales'=>$tutoriales,
            'sitiosrel'=>$this->sitiosrel
              ];
        
        return view('sitio.capacitaciones.verCapacitaciones', compact('capacitaciones', 'tutoriales', 'sitiosrel', 'metaTags'));
        return view("sitio.capacitaciones.verCapacitaciones")->with($data);
    }

    public function Contacto(){
       
              $metaTags = [
                'title' => "Contacta al huerto",
                'description' => "Ponte en contacto con el Huerto IBERO, CDMX.",
                'url' => route('showContactos'),
                'image' => asset('images/redes_huerto.png'),
                'image_alt' => "huerto_ibero",
            ];
            $data = [
                'sitiosrel'=>$this->sitiosrel,
                'metaTags'=>$metaTags
                  ];
        return view("sitio.tutorial.contacto")->with($data);
    }

    public function enviarMailContacto(Request $request){
        $recaptcha_response = $request->input('g-recaptcha-response');

        if (is_null($recaptcha_response) || $recaptcha_response="") {
            
            return redirect()->back()->with('status', 'Completa el reCaptcha para enviar el formulario');
        }


        //Mail::to("huertoibero@gmail.com")->send(new FormContacto($request));
        Mail::to("huertourbano@ibero.mx")->send(new FormContacto($request));
       
        return redirect()->route('ContactoOK');
    }

    public function ContactoOK(){
        $data = [
            'sitiosrel'=>$this->sitiosrel
              ];
        return view("sitio.tutorial.formok")->with($data);
    }

   
      
}
