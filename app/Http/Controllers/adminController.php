<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\DB; //consulta a db
use Illuminate\Support\Facades\Auth; //identificar usuario
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;


use App\Models\Evento;
use App\Models\Biografia;
use App\Models\Proyecto;
use App\Models\Noticia;
use App\Models\Contenedor;
use App\Models\Experimento;
use App\Models\Planta;
use App\Models\Actividad;
use App\Models\Capacitacion;
use App\Models\Huerto;
use App\Models\Semilla;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\ContenedorTipo;
use App\Models\Bitacora;
use App\Models\BitacoraImagen;
use App\Models\relPlantaContenedor;
use SplFileInfo;
use Exception;

class adminController extends Controller
{
    public function showRol()
    {
        $rol = DB::select("select tipo from h_usuarios where email = '" . Auth::user()->email . "'");
        return $rol[0]->tipo;
    }

    public function verjson()
    {
        $path = 'reporte.json'; // El nombre del archivo en el storage
        if (!Storage::disk('local')->exists($path)) {
            return response()->json(['error' => 'Archivo no encontrado'], 404);
        }
        $content = Storage::disk('local')->get($path);
        $type = Storage::disk('local')->mimeType($path);
        return response($content, 200)->header('Content-Type', $type);
    }

    public function iniciaSesion(Request $request)
    {

        $recaptcha_response = $request->input('g-recaptcha-response');


        // Verifica si la respuesta del reCAPTCHA está presente
        if (is_null($recaptcha_response) || $recaptcha_response == "") {
            return redirect('/admin')->with(['status' => 'Completa el reCaptcha para iniciar sesión']);
            //return redirect()->back()->with('status', 'Completa el reCaptcha para iniciar sesión');
        }



        // Verifica la respuesta del reCAPTCHA con Google
        $response = $this->verifyRecaptcha($recaptcha_response);

        if (!$response['success']) {
            return redirect()->with('status', 'La verificación del reCaptcha falló. Inténtalo de nuevo.');
        }




        // Intenta autenticar al usuario
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $user = Auth::user();

        // Verificar el estado del usuario
        $estatus = DB::table('usuarios')->where('email', $user->email)->value('cEstatus');

        if ($estatus !== 'A') {
            Auth::logout();
            return redirect('/admin')->with(['status' => 'Su cuenta está inactiva.']);
        }

        // Si el usuario está activo, continúa con el inicio de sesión
        return redirect('/admin');
    } else {
        return redirect()->back()->with(['status' => 'Credenciales incorrectas']);
    }
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

    public function entrarAdmin()
    {

        $idUser = Auth::id();
        if ($idUser == "") {
            return view('admin.login');
        }

        $data = DB::select("select T1.*, T3.idContenedor, IFNULL(T3.cNombre, 'Sin contenedor') as cContenedor, 
        IFNULL(T3.cTipo, 'Sin tipo') as cTipo, T4.idExperimento, IFNULL(T4.cExperimento, 'Sin experimento') as cExperimento,
        T4.nExperimento, T4.dinicio, T4.dFin, T5.idProyecto, IFNULL(T5.cNombre, 'Sin Proyecto') as cProyecto, 
        IFNULL(T6.name, 'Sin usuario') as cUsuario from
        h_plantas as T1
        left join h_relPlantaContenedor as T2 on T1.idPlanta = T2.idPlanta
        left join h_contenedores as T3 on T3.idContenedor = T2.idContenedor
        left join h_contenedores_tipos as T7 on T3.idTipo = T7.idTipo
        left join h_experimentos as T4 on T2.idExperimento = T4.idExperimento
        left join h_proyectos as T5 on T4.idProyecto = T5.idProyecto
        left join h_users as T6 on T6.id = T2.idUsrAlta
        where T1.cEstatus = 'A'");

        // Convertir los datos a JSON
        $jsonData = json_encode($data);

        // Guardar el JSON en storage en lugar de public
        Storage::disk('local')->put('reporte.json', $jsonData);

        return view('admin.inicio');
    }

    public function showActividades()
    {
        // Supongamos que tienes un modelo llamado 'Actividad' que está vinculado a la tabla 'h_actividades'.

        $actividades = Actividad::where('cEstatus', 'A')
            ->orderBy('idActividad')
            ->get();

        // $actividades ahora contiene los resultados de la consulta.
        return view('admin/pages/ActividadesShow')->with(['actividades' => $actividades]);
    }
    public function formActividades($id)
    {
        if ($id == 0) {
            $item = json_decode('[{"idActividad":0}]');
        } else {
            $item = Actividad::where('idActividad', $id)->get();
        }
        return view('admin/pages/ActividadesForm')->with(['item' => $item[0]]);
    }
    public function delActividades($id)
    {
        Actividad::where('idActividad', $id)->update(['cEstatus' => 'B']);
        return redirect()->route('actividades');
    }
    public function creaActividades(Request $request)
    {
        //VARIABLES DE ARCHIVO ADJUNTO
        $cArchivo = $_FILES["archivo"]["name"];
        $ext = $this->verExtension($cArchivo);
        //CREA LA ACTIVIDAD
        $item = Actividad::create([
            'cActividad' => $request->nombre,
            'cLugar' => $request->lugar,
            'cDescripcion' => $request->desc,
            'dActividad' => $request->fecha,
            'idUsrAlta' => Auth::id(),
            'cLink' => $request->link,
            'cExt' => $ext,
        ]);

        $this->subeFoto($_FILES["archivo"], "actividades", $item->idActividad);

        return redirect()->route('actividades');
    }
    public function upActividades(Request $request)
    {

        if ($_FILES["archivo"]["name"]) {
            $cArchivo = $_FILES["archivo"]["name"];
            $ext = $this->verExtension($cArchivo);
            $this->subeFoto($_FILES["archivo"], "actividades", $request->idActividad);
            Actividad::where('idActividad', $request->idActividad)->update(['cExt' => $ext]);
        }
        $item = Actividad::where('idActividad', $request->idActividad)->update([
            'cActividad' => $request->nombre,
            'cLugar' => $request->lugar,
            'cDescripcion' => $request->desc,
            'dActividad' => $request->fecha,
            'cLink' => $request->link
        ]);

        return redirect()->route('actividades');
    }





    public function showCapacitaciones()
    {
        $items = Capacitacion::where('cEstatus', 'A')
            ->orderBy('idCapacitacion')
            ->get();
        return view('admin/pages/CapacitacionShow')->with(['items' => $items]);
    }
    public function formCapacitaciones($id)
    {
        if ($id == 0) {
            $item = json_decode('[{"idCapacitacion":0, "cTipo":"nada"}]');
        } else {
            $item = Capacitacion::where('idCapacitacion', $id)->get();
        }
        return view('admin/pages/CapacitacionForm')->with(['item' => $item[0]]);
    }
    public function delCapacitaciones($id)
    {
        Capacitacion::where('idCapacitacion', $id)->update(['cEstatus' => 'B']);
        return redirect()->route('capacitaciones');
    }
    public function creaCapacitaciones(Request $request)
    {
        $cArchivo = $_FILES["archivo"]["name"];
        $ext = $this->verExtension($cArchivo);
        $item = Capacitacion::create([
            'cCapacitacion' => $request->nombre,
            'cLugar' => $request->lugar,
            'cDescripcion' => $request->desc,
            'dCapacitacion' => $request->fecha,
            'idUsrAlta' => Auth::id(),
            'cLink' => $request->link,
            'cExt' => $ext,
            'cTipo' => $request->tipo,
            'cMultimedia' => $request->multimedia
        ]);
        $this->subeFoto($_FILES["archivo"], "capacitaciones", $item->idCapacitacion);
        return redirect()->route('capacitaciones');
    }
    public function upCapacitaciones(Request $request)
    {
        if ($_FILES["archivo"]["name"]) {
            $cArchivo = $_FILES["archivo"]["name"];
            $ext = $this->verExtension($cArchivo);
            $subeFoto = $this->subeFoto($_FILES["archivo"], "capacitaciones", $request->idCapacitacion);
            Capacitacion::where('idCapacitacion', $request->idCapacitacion)->update(['cExt' => $ext]);
        }
        $item = Capacitacion::where('idCapacitacion', $request->idCapacitacion)->update([
            'cCapacitacion' => $request->nombre,
            'cLugar' => $request->lugar,
            'cDescripcion' => $request->desc,
            'dCapacitacion' => $request->fecha,
            'cLink' => $request->link,
            'cTipo' => $request->tipo,
            'cMultimedia' => $request->multimedia
        ]);


        return redirect()->route('capacitaciones');
    }









    public function showNoticias()
    {
        $items = DB::table('noticias as T1')
            ->select('T1.*', 'T2.nombre', 'T2.apellido')
            ->leftJoin('usuarios as T2', 'T1.idUsrAlta', '=', 'T2.idUsuario')
            ->where('T1.cEstatus', '=', 'A')
            ->orderBy('T1.idNoticia')
            ->get();
        return view('admin/pages/NoticiasShow')->with(['items' => $items]);
    }
    public function formNoticias($id)
    {
        if ($id == 0) {
            $item = json_decode('[{"idNoticia":0}]');
        } else {
            $item = Noticia::where('idNoticia', $id)->get();
        }
        return view('admin/pages/NoticiasForm')->with(['item' => $item[0]]);
    }
    public function delNoticias($id)
    {
        Noticia::where('idNoticia', $id)->update(['cEstatus' => 'B']);
        return redirect()->route('noticias');
    }
    public function creaNoticias(Request $request)
    {
        $cArchivo = $_FILES["archivo"]["name"];
        $ext = $this->verExtension($cArchivo);
        $item = Noticia::create([
            'cNoticia' => $request->nombre,
            'cContenido' => $request->desc,
            'cLink' => $request->link,
            'cExt' => $ext,
            'idUsrAlta' => Auth::id()
        ]);
        $this->subeFoto($_FILES["archivo"], "noticias", $item->idNoticia);
        return redirect()->route('noticias');
    }
    public function upNoticias(Request $request)
    {
        if ($_FILES["archivo"]["name"]) {
            $cArchivo = $_FILES["archivo"]["name"];
            $ext = $this->verExtension($cArchivo);
            $this->subeFoto($_FILES["archivo"], "noticias", $request->idNoticia);
            Noticia::where('idNoticia', $request->idNoticia)->update(['cExt' => $ext]);
        }
        $item = Noticia::where('idNoticia', $request->idNoticia)->update([
            'cNoticia' => $request->nombre,
            'cContenido' => $request->desc,
            'cLink' => $request->link
        ]);
        return redirect()->route('noticias');
    }





    public function showEventos()
    {
        $items = Evento::where('cEstatus', 'A')
            ->orderBy('idEvento')
            ->get();
        return view('admin/pages/EventosShow')->with(['items' => $items]);
    }
    public function formEventos($id)
    {
        if ($id == 0) {
            $item = json_decode('[{"idEvento":0}]');
        } else {
            $item = Evento::where('idEvento', $id)->get();
        }
        return view('admin/pages/EventosForm')->with(['item' => $item[0]]);
    }
    public function delEventos($id)
    {
        Evento::where('idEvento', $id)->update(['cEstatus' => 'B']);
        return redirect()->route('eventos');
    }
    public function creaEventos(Request $request)
    {
        $cArchivo = $_FILES["archivo"]["name"];
        $ext = $this->verExtension($cArchivo);
        $item = Evento::create([
            'cEvento' => $request->nombre,
            'cLugar' => $request->lugar,
            'cDescripcion' => $request->desc,
            'dEvento' => $request->fecha,
            'idUsrAlta' => Auth::id(),
            'cLink' => $request->link,
            'cExt' => $ext,
        ]);
        $this->subeFoto($_FILES["archivo"], "eventos", $item->idEvento);
        return redirect()->route('eventos');
    }
    public function upEventos(Request $request)
    {
        if ($_FILES["archivo"]["name"]) {
            $cArchivo = $_FILES["archivo"]["name"];
            $ext = $this->verExtension($cArchivo);
            $this->subeFoto($_FILES["archivo"], "eventos", $request->idEvento);
            Evento::where('idEvento', $request->idEvento)->update(['cExt' => $ext]);
        }
        $item = Evento::where('idEvento', $request->idEvento)->update([
            'cEvento' => $request->nombre,
            'cLugar' => $request->lugar,
            'cDescripcion' => $request->desc,
            'dEvento' => $request->fecha,
            'cLink' => $request->link
        ]);
        return redirect()->route('eventos');
    }






    public function showBios()
    {
        $items = Biografia::where('cEstatus', 'A')
            ->orderBy('idBiografia')
            ->get();
        return view('admin/pages/BioShow')->with(['items' => $items]);
    }
    public function formBios($id)
    {
        if ($id == 0) {
            $item = json_decode('[{"idBiografia":0}]');
        } else {
            $item = Biografia::where('idBiografia', $id)->get();
        }
        return view('admin/pages/BioForm')->with(['item' => $item[0]]);
    }
    public function delBios($id)
    {
        Biografia::where('idBiografia', $id)->update(['cEstatus' => 'B']);
        return redirect()->route('bios');
    }
    public function creaBios(Request $request)
    {
        $cArchivo = $_FILES["archivo"]["name"];
        $ext = $this->verExtension($cArchivo);
        $item = Biografia::create([
            'cTitulo' => $request->nombre,
            'cContenido' => $request->lugar,
            'iPublica' => $request->desc,
            'idUsrAlta' => Auth::id(),
            'cExt' => $ext,
        ]);
        $this->subeFoto($_FILES["archivo"], "bios", $item->idBiografia);
        return redirect()->route('bios');
    }
    public function upBios(Request $request)
    {
        if ($_FILES["archivo"]["name"]) {
            $cArchivo = $_FILES["archivo"]["name"];
            $ext = $this->verExtension($cArchivo);
            $this->subeFoto($_FILES["archivo"], "bios", $request->idBiografia);
            Biografia::where('idBiografia', $request->idBiografia)->update(['cExt' => $ext]);
        }
        $item = Biografia::where('idBiografia', $request->idBiografia)->update([
            'cTitulo' => $request->nombre,
            'cContenido' => $request->lugar,
            'iPublica' => $request->desc
        ]);
        return redirect()->route('bios');
    }





    public function showHuertos()
    {
        $items = Huerto::where('cEstatus', 'A')
            ->orderBy('idHuerto')
            ->get();
        return view('admin/pages/HuertoShow')->with(['items' => $items]);
    }
    public function formHuertos($id)
    {
        if ($id == 0) {
            $item = json_decode('[{"idHuerto":0}]');
        } else {
            $item = Huerto::where('idHuerto', $id)->get();
        }
        return view('admin/pages/HuertoForm')->with(['item' => $item[0]]);
    }
    public function delHuertos($id)
    {
        Huerto::where('idHuerto', $id)->update(['cEstatus' => 'B']);
        return redirect()->route('huertos');
    }
    public function creaHuertos(Request $request)
    {
        $item = Huerto::create([
            'cHuerto' => $request->nombre,
            'cDescripcion' => $request->desc,
            'dCreacion' => $request->fecha,
            'cLat' => $request->lat,
            'cLong' => $request->long,
            'cAltura' => $request->altura,
            'idUsrAlta' => Auth::id()
        ]);
        return redirect()->route('huertos');
    }
    public function upHuertos(Request $request)
    {
        Huerto::where('idHuerto', $request->idHuerto)->update([
            'cHuerto' => $request->nombre,
            'cDescripcion' => $request->desc,
            'dCreacion' => $request->fecha,
            'cLat' => $request->lat,
            'cLong' => $request->long,
            'cAltura' => $request->altura,
        ]);
        return redirect()->route('huertos');
    }




    public function showProyectos()
    {
        $items = Proyecto::select('proyectos.*', 'usuarios.nombre', 'usuarios.apellido', 'huertos.cHuerto')
            ->leftJoin('usuarios', 'proyectos.idResponsable', '=', 'usuarios.idUsuario')
            ->leftJoin('huertos', 'proyectos.idHuerto', '=', 'huertos.idHuerto')
            ->where('proyectos.cEstatus', '=', 'A')
            ->orderBy('proyectos.idProyecto')
            ->get();
        return view('admin/pages/ProyectosShow')->with(['items' => $items]);
    }
    public function formProyectos($id)
    {
        if ($id == 0) {
            $item = json_decode('[{"idProyecto":0}]');
        } else {
            $item = Proyecto::where('idProyecto', $id)->get();
        }
        $res = DB::table('usuarios')
            ->select('idUsuario', 'nombre', 'apellido', 'comunidadIbero')
            ->orderBy('apellido')
            ->get();
        $huertos = Huerto::select('idHuerto', 'cHuerto')
            ->orderBy('idHuerto')
            ->get();
        return view('admin/pages/ProyectosForm')->with(['item' => $item[0], 'responsables' => $res, 'huertos' => $huertos]);
    }
    public function delProyectos($id)
    {
        Proyecto::where('idProyecto', $id)->update(['cEstatus' => 'B']);
        return redirect()->route('proyectos');
    }
    public function creaProyectos(Request $request)
    {
        $cArchivo = $_FILES["archivo"]["name"];
        $ext = $this->verExtension($cArchivo);
        $item = Proyecto::create([
            'cNombre' => $request->nombre,
            'cProblematica' => $request->problem,
            'cDescripcion' => $request->desc,
            'cIncidencia' => $request->inci,
            'idHuerto' => $request->huerto,
            'idResponsable' => $request->res,
            'dInicio' => $request->inicio,
            'dFin' => $request->fin,
            'idUsrAlta' => Auth::id(),
            'cExt' => $ext
        ]);
        $this->subeFoto($_FILES["archivo"], "proyectos", $item->idProyecto);
        return redirect()->route('proyectos');
    }
    public function upProyectos(Request $request)
    {
        if ($_FILES["archivo"]["name"]) {
            $cArchivo = $_FILES["archivo"]["name"];
            $ext = $this->verExtension($cArchivo);
            $this->subeFoto($_FILES["archivo"], "proyectos", $request->idProyecto);
            Proyecto::where('idProyecto', $request->idProyecto)->update(['cExt' => $ext]);
        }
        $item = Proyecto::where('idProyecto', $request->idProyecto)->update([
            'cNombre' => $request->nombre,
            'cProblematica' => $request->problem,
            'cDescripcion' => $request->desc,
            'cIncidencia' => $request->inci,
            'idHuerto' => $request->huerto,
            'idResponsable' => $request->res,
            'dInicio' => $request->inicio,
            'dFin' => $request->fin,
        ]);
        return redirect()->route('proyectos');
    }




    public function showExperimentos()
    {
        $items = DB::table('experimentos as T1')
            ->select('T1.*', 'T2.cNombre')
            ->leftJoin('proyectos as T2', 'T1.idProyecto', '=', 'T2.idProyecto')
            ->where('T1.cEstatus', '=', 'A')
            ->orderBy('T1.idExperimento')
            ->get();
        return view('admin/pages/ExpShow')->with(['items' => $items]);
    }
    public function formExperimentos($id)
    {
        if ($id == 0) {
            $item = json_decode('[{"idExperimento":0}]');
        } else {
            $item = Experimento::where('idExperimento', $id)->get();
        }
        $proyectos = DB::table('proyectos')
            ->select('idProyecto', 'cNombre')
            ->where('cEstatus', '=', 'A')
            ->orderBy('cNombre')
            ->get();
        return view('admin/pages/ExpForm')->with(['item' => $item[0], 'proyectos' => $proyectos]);
    }
    public function delExperimentos($id)
    {
        Experimento::where('idExperimento', $id)->update(['cEstatus' => 'B']);
        return redirect()->route('experimentos');
    }
    public function creaExperimentos(Request $request)
    {
        $item = Experimento::create([
            'cExperimento' => $request->nombre,
            'nExperimento' => $request->num,
            'idProyecto' => $request->proyecto,
            'dInicio' => $request->inicio,
            'dFin' => $request->fin,
            'idUsrAlta' => Auth::id(),
            'cNotas' => $request->notas
        ]);
        return redirect()->route('experimentos');
    }
    public function upExperimentos(Request $request)
    {
        $item = Experimento::where('idExperimento', $request->idExperimento)->update([
            'cExperimento' => $request->nombre,
            'nExperimento' => $request->num,
            'idProyecto' => $request->proyecto,
            'dInicio' => $request->inicio,
            'dFin' => $request->fin,
            'cNotas' => $request->notas
        ]);
        return redirect()->route('experimentos');
    }




    public function showPlantas()
    {
        $items = Planta::select('plantas.*', 'users.name')
            ->leftJoin('users', 'plantas.idUsrAlta', 'users.id')
            ->where('cEstatus', 'A')
            ->orderBy('idPlanta')
            ->get();
        return view('admin/pages/PlantasShow')->with(['items' => $items]);
    }
    public function formPlantas($id)
    {
        if ($id == 0) {
            $item = json_decode('[{"idPlanta":0}]');
        } else {
            $item = Planta::where('idPlanta', $id)->get();
        }
        return view('admin/pages/PlantasForm')->with(['item' => $item[0]]);
    }
    public function delPlantas($id)
    {
        Planta::where('idPlanta', $id)->update(['cEstatus' => 'B']);
        return redirect()->route('plantas');
    }
    public function autocompletePlantas(Request $request)
    {
        $query = $request->query;
        $field = $request->field; // 'nombre' o 'ciudad'
        $results = Planta::where($field, 'LIKE', '%' . $query . '%')->get();
        return response()->json($results);
    }
    public function infoPlanta($id)
    {
        $items = relPlantaContenedor::select(
            'relPlantaContenedor.*',
            'T2.cNombre',
            'T3.cNombre as contenedor',
            'T4.cNombre as tipoc',
            'T6.name as creador',
            'T7.cExperimento'
        )
            ->leftJoin('plantas as T2', 'T2.idPlanta', 'relPlantaContenedor.idPlanta')
            ->leftJoin('contenedores as T3', 'relPlantaContenedor.idContenedor', 'T3.idContenedor')
            ->leftJoin('contenedores_tipos as T4', 'T3.idTipo', 'T4.idTipo')
            ->leftJoin('users as T6', 'relPlantaContenedor.idUsrAlta', 'T6.id')
            ->leftJoin('experimentos as T7', 'T7.idExperimento', 'relPlantaContenedor.idExperimento')
            ->where('T3.cEstatus', 'A')
            ->where('relPlantaContenedor.idPlanta', $id)
            ->withCount('bitacoras')
            ->orderBy('relPlantaContenedor.idRel')
            ->get();
        return $items;
    }

    private function handleSeasons($request, $fields)
    {
        $result = "";
        $seasons = [
            'prim' => 'primavera, ',
            'ver'  => 'verano, ',
            'oto'  => 'otoño, ',
            'invi' => 'invierno, '
        ];

        foreach ($seasons as $suffix => $season) {
            $field = $fields . $suffix;
            if ($request->$field != "") {
                $result .= $season;
            }
        }

        return rtrim($result, ', ');
    }
    public function creaPlantas(Request $request)
    {
        $cArchivo = $_FILES["archivo"]["name"];
        $ext = $this->verExtension($cArchivo);

        //OPERADOR TERNARIO
        $comestible = $request->comestible != "" ? 1 : 0;
        $endemica = $request->endemica != "" ? 1 : 0;
        $medicinal = $request->medicinal != "" ? 1 : 0;
        $perene = $request->perene != "" ? 1 : 0;
        $nitro = $request->fijNitro != "" ? 1 : 0;

        $tSiembra = $this->handleSeasons($request, 'tsiembra');
        $tCosecha = $this->handleSeasons($request, 'tcosecha');

        $item = Planta::create([
            'cNombre' => $request->nombre,
            'cNombreLatin' => $request->latin,
            'cOtrosNombres' => $request->otrosnombres,
            'cEspecie' => $request->especie,
            'cDescripcion' => $request->desc,
            'cOrigen' => $request->origen,
            'cAportacion' => $request->aportacion,
            'cBeneficios' => $request->beneficios,
            'cMantenimiento' => $request->mantenimiento,
            'iComestible' => $comestible,
            'iEndemica' => $endemica,
            'iMedicinal' => $medicinal,
            'iPerenne' => $perene,
            'grupo' => $request->grupo,
            'cicloDeVida' => $request->cicloDeVida,
            'crecimiento' => $request->crecimiento,
            'familia' => $request->familia,
            'zSiembra' => $request->zSiembra,
            'profRaiz' => $request->profRaiz,
            'fijNitro' => $nitro,
            'tipoSuelo' => $request->tipoSuelo,
            'humSuelo' => $request->humSuelo,
            'phSuelo' => $request->phSuelo,
            'tGerminacion' => $request->tgerminacion,
            'firstCosecha' => $request->firstCosecha,
            'cicloCosecha' => $request->cicloCosecha,
            'altura' => $request->altura,
            'ancho' => $request->ancho,
            'distPlantas' => $request->distPlantas,
            'tempSiembra' => $tSiembra,
            'tempCosecha' => $tCosecha,
            'dimHojas' => $request->dimHojas,
            'tRiego' => $request->tRiego,
            'cIluminacion' => $request->cIluminacion,
            'tempMin' => $request->tempMin,
            'tempMax' => $request->tempMax,
            'idUsrAlta' => Auth::id(),
            'cExt' => $ext
        ]);
        $this->subeFoto($_FILES["archivo"], "catalogo", $item->idPlanta);
        return redirect()->route('plantas');
    }
    public function upPlantas(Request $request)
    {
        if ($_FILES["archivo"]["name"]) {
            $cArchivo = $_FILES["archivo"]["name"];
            $ext = $this->verExtension($cArchivo);
            $this->subeFoto($_FILES["archivo"], "catalogo", $request->idPlanta);
            Planta::where('idPlanta', $request->idPlanta)->update(['cExt' => $ext]);
        }
        //OPERADOR TERNARIO
        $comestible = $request->comestible != "" ? 1 : 0;
        $endemica = $request->endemica != "" ? 1 : 0;
        $medicinal = $request->medicinal != "" ? 1 : 0;
        $perene = $request->perene != "" ? 1 : 0;
        $nitro = $request->fijNitro != "" ? 1 : 0;

        $tSiembra = $this->handleSeasons($request, 'tsiembra');
        $tCosecha = $this->handleSeasons($request, 'tcosecha');

        $item = Planta::where('idPlanta', $request->idPlanta)->update([
            'cNombre' => $request->nombre,
            'cNombreLatin' => $request->latin,
            'cOtrosNombres' => $request->otrosnombres,
            'cEspecie' => $request->especie,
            'cDescripcion' => $request->desc,
            'cOrigen' => $request->origen,
            'cAportacion' => $request->aportacion,
            'cBeneficios' => $request->beneficios,
            'cMantenimiento' => $request->mantenimiento,
            'iComestible' => $comestible,
            'iEndemica' => $endemica,
            'iMedicinal' => $medicinal,
            'iPerenne' => $perene,
            'grupo' => $request->grupo,
            'cicloDeVida' => $request->cicloDeVida,
            'crecimiento' => $request->crecimiento,
            'familia' => $request->familia,
            'zSiembra' => $request->zSiembra,
            'profRaiz' => $request->profRaiz,
            'fijNitro' => $nitro,
            'tipoSuelo' => $request->tipoSuelo,
            'humSuelo' => $request->humSuelo,
            'phSuelo' => $request->phSuelo,
            'tGerminacion' => $request->tgerminacion,
            'firstCosecha' => $request->firstCosecha,
            'cicloCosecha' => $request->cicloCosecha,
            'altura' => $request->altura,
            'ancho' => $request->ancho,
            'distPlantas' => $request->distPlantas,
            'tempSiembra' => $tSiembra,
            'tempCosecha' => $tCosecha,
            'dimHojas' => $request->dimHojas,
            'tRiego' => $request->tRiego,
            'cIluminacion' => $request->cIluminacion,
            'tempMin' => $request->tempMin,
            'tempMax' => $request->tempMax,
        ]);
        return redirect()->route('plantas');
    }




    public function showSemillas()
    {
        $items = Semilla::where('cEstatus', 'A')
            ->orderBy('idSemilla')
            ->get();


        return view('admin/pages/SemillasShow')->with(['items' => $items]);
    }
    public function formSemillas($id)
    {
        if ($id == 0) {
            $item = json_decode('[{"idSemilla":0}]');
        } else {
            $item = Semilla::where('idSemilla', $id)->get();
        }
        return view('admin/pages/SemillasForm')->with(['item' => $item[0]]);
    }
    public function delSemillas($id)
    {
        Semilla::where('idSemilla', $id)->update(['cEstatus' => 'B']);
        return redirect()->route('semillas');
    }
    public function creaSemillas(Request $request)
    {

        $item = Semilla::create([
            'cNombre' => $request->nombre,
            'cColor' => $request->color,
            'nPeso' => $request->peso,
            'cCosecha' => $request->cosecha,
            'cTipoPolinizacion' => $request->poli,
            'nCostoUnitario' => $request->costo,
            'nLote' => $request->lote,
            'cProveedor' => $request->prov,
            'idUsrAlta' => Auth::id(),
        ]);
        return redirect()->route('semillas');
    }
    public function upSemillas(Request $request)
    {

        $item = Semilla::where('idSemilla', $request->idSemilla)->update([
            'cNombre' => $request->nombre,
            'cColor' => $request->color,
            'nPeso' => $request->peso,
            'cCosecha' => $request->cosecha,
            'cTipoPolinizacion' => $request->poli,
            'nCostoUnitario' => $request->costo,
            'nLote' => $request->lote,
            'cProveedor' => $request->prov
        ]);
        return redirect()->route('semillas');
    }




    public function showContenedores()
    {
        $items = DB::table('contenedores as T1')
            ->select('T1.*', 'T2.cExperimento', 'T3.nombre', 'T3.apellido', 'T4.cNombre as tipo')
            ->leftJoin('experimentos as T2', 'T1.idExperimento', '=', 'T2.idExperimento')
            ->leftJoin('usuarios as T3', 'T1.idEncargado', '=', 'T3.idUsuario')
            ->leftJoin('contenedores_tipos as T4', 'T1.idTipo', '=', 'T4.idTipo')
            ->where('T1.cEstatus', '=', 'A')
            ->orderBy('tipo')
            ->get();
        return view('admin/pages/ContenedorShow')->with(['items' => $items]);
    }
    public function formContenedores($id)
    {
        if ($id == 0) {
            $item = json_decode('[{"idContenedor":0}]');
        } else {
            $item = Contenedor::where('idContenedor', $id)->get();
        }
        $res = DB::table('usuarios')
            ->select('idUsuario', 'nombre', 'apellido', 'comunidadIbero')
            ->orderBy('apellido')
            ->get();
        $exp = Experimento::where('cEstatus', 'A')->orderBy('cExperimento')->get();
        $tipos = ContenedorTipo::orderBy('cNombre')->get();
        $mapa = Contenedor::where('cEstatus', 'A')->where('idContenedor', '!=', $id)->get();
        return view('admin/pages/ContenedorForm')->with(['item' => $item[0], 'responsables' => $res, 'experimentos' => $exp, 'tipos' => $tipos, 'mapa' => $mapa]);
    }
    public function delContenedores($id)
    {
        Contenedor::where('idContenedor', $id)->update(['cEstatus' => 'B']);
        return redirect()->route('contenedores');
    }
    public function creaContenedores(Request $request)
    {
        $item = Contenedor::create([
            'cNombre' => $request->nombre,
            'cTipo' => $request->tipo,
            'idExperimento' => $request->exp,
            'idEncargado' => $request->res,
            'idUsrAlta' => Auth::id(),
            'idTipo' => $request->tipo,
            'cNota' => $request->nota,
            'cUbicacion' => $request->ubicacion
        ]);
        return redirect()->route('contenedores');
    }
    public function upContenedores(Request $request)
    {

        $item = Contenedor::where('idContenedor', $request->idContenedor)->update([
            'cNombre' => $request->nombre,
            'cTipo' => $request->tipo,
            'idExperimento' => $request->exp,
            'idEncargado' => $request->res,
            'idTipo' => $request->tipo,
            'cNota' => $request->nota,
            'cUbicacion' => $request->ubicacion
        ]);
        return redirect()->route('contenedores');
    }



    public function showContenedoresPlantas($id)
    {
        $items = DB::table('relPlantaContenedor as T1')
            ->select('T2.*', 'T1.idRel', 'T1.cEstatus as estatus', 'T1.idUsrAlta as usuario', 'T1.created_at as fecha', 'T1.cNota', 'T3.name', 'T4.cExperimento')
            ->leftJoin('plantas as T2', 'T1.idPlanta', '=', 'T2.idPlanta')
            ->leftJoin('users as T3', 'T1.idUsrAlta', '=', 'T3.id')
            ->leftJoin('experimentos as T4', 'T1.idExperimento', '=', 'T4.idExperimento')
            ->where('T1.idContenedor', '=', $id)
            ->get();

        $contenedor = Contenedor::where('idContenedor', $id)->get();
        return view('admin/pages/ContenedorPlantaShow')->with(['plantas' => $items, 'info' => $contenedor[0]]);
    }
    public function formContenedoresPlantas($id, $idRel)
    {
        $plantas = Planta::where('cEstatus', 'A')->orderBy('cNombre')->get();
        $contenedor = Contenedor::where('idContenedor', $id)->get();
        $exps = Experimento::where('cEstatus', 'A')->get();
        if ($idRel > 0) {
            $registro = relPlantaContenedor::where('idRel', $idRel)->get();
            return view('admin/pages/ContenedorPlantaForm')->with(['plantas' => $plantas, 'exps' => $exps, 'info' => $contenedor[0], 'registro' => $registro[0]]);
        } else {
            $registro = 0;
            return view('admin/pages/ContenedorPlantaForm')->with(['plantas' => $plantas, 'exps' => $exps, 'info' => $contenedor[0], 'registro' => $registro]);
        }
    }
    public function delContenedoresPlantas($id, $conte)
    {
        /*DB::table('relPlantaContenedor')
        ->where('idPlanta', '=', $id)
        ->where('idContenedor', $conte)
        ->delete();*/
        return redirect()->route('contenedores.plantas', ['id' => $conte]);
    }
    public function bajaContenedoresPlantas($id, $conte, $estatus)
    {
        relPlantaContenedor::where('idPlanta', '=', $id)
            ->where('idContenedor', $conte)
            ->update([
                'cEstatus' => $estatus
            ]);
        return redirect()->route('contenedores.plantas', ['id' => $conte]);
    }
    public function creaContenedoresPlantas(Request $request)
    {
        if ($request->idRel > 0) {
            relPlantaContenedor::where('idRel', $request->idRel)
                ->update([
                    'idExperimento' => $request->exp,
                    'cNota' => $request->cNota
                ]);
        } else {
            relPlantaContenedor::create([
                'idPlanta' => $request->planta,
                'idContenedor' => $request->idContenedor,
                'idExperimento' => $request->exp,
                'cNota' => $request->cNota,
                'idUsrAlta' => Auth::id()
            ]);
        }

        return redirect()->route('contenedores.plantas', ['id' => $request->idContenedor]);
    }



    public function showContenedoresTipos()
    {
        $LcResp = ContenedorTipo::withCount('contenedores')->get();
        return view('admin/pages/ContenedorTipoShow')->with(['items' => $LcResp]);
    }
    public function upContenedoresTipos(Request $request)
    {
        $item = ContenedorTipo::where('idTipo', $request->idTipo)->update([
            'cNombre' => $request->nombre
        ]);
        return redirect()->route('contenedores.tipos');
    }
    public function delContenedoresTipos($id)
    {
        ContenedorTipo::where('idTipo', $id)
            ->delete();
        return redirect()->route('contenedores.tipos');
    }
    public function creaContenedoresTipos(Request $request)
    {
        $item = ContenedorTipo::create([
            'cNombre' => $request->nombre,
            'idUsrAlta' => Auth::id()
        ]);
        return redirect()->route('contenedores.tipos');
    }
    public function formContenedoresTipo($id)
    {
        if ($id == 0) {
            $item = json_decode('[{"idTipo":0}]');
        } else {
            $item = ContenedorTipo::where('idTipo', $id)->get();
        }


        return view('admin/pages/ContenedorTipoForm')->with(['item' => $item[0]]);
    }




    public function showBitacora($id)
    {
        //$LcResp = Bitacora::where('idRelPlantaContenedor', $id)->get();
        $items = Bitacora::select('bitacora_plantas.*', 'users.name', 'plantas.cNombre as planta', 'contenedores.cNombre as contenedor')
            ->leftJoin('users', 'bitacora_plantas.idUsrAlta', '=', 'users.id')
            ->leftJoin('relPlantaContenedor', 'relPlantaContenedor.idRel', '=', 'bitacora_plantas.idrelPlantaContenedor')
            ->leftJoin('plantas', 'relPlantaContenedor.idPlanta', '=', 'plantas.idPlanta')
            ->leftJoin('contenedores', 'relPlantaContenedor.idContenedor', '=', 'contenedores.idContenedor')
            ->where('relPlantaContenedor.idRel', $id)
            ->where('bitacora_plantas.cEstatus', 'A')
            ->get();
        return view('admin/pages/BitacorasShow')->with(['items' => $items]);
    }
    public function upBitacora(Request $request)
    {
        $item = Bitacora::where('idBitacora', $request->idBitacora)->update([
            'cTitulo' => $request->titulo,
            'cNota' => $request->nota
        ]);
        return redirect()->route('contenedores.bit', ['idPlanta' => $request->idrelPlantaContenedor]);
    }
    public function delBitacora($id)
    {
        Bitacora::where('idTipo', $id)
            ->delete();
        return redirect()->route('contenedores.bit', ['id' => $id]);
    }
    public function estatusBitacora($id, $estatus)
    {
        Bitacora::where('idBitacora', '=', $id)
            ->update([
                'cEstatus' => $estatus
            ]);
        $item = Bitacora::where('idBitacora', $id)->first();
        return redirect()->route('contenedores.bit', ['idPlanta' => $item->idrelPlantaContenedor]);
    }
    public function creaBitacora(Request $request)
    {
        $item = Bitacora::create([
            'idrelPlantaContenedor' => $request->idrelPlantaContenedor,
            'idUsrAlta' => Auth::id(),
            'cTitulo' => $request->titulo,
            'cNota' => $request->nota,
        ]);
        return redirect()->route('contenedores.bit', ['idPlanta' => $request->idrelPlantaContenedor]);
    }
    public function formBitacora($id, $idRel)
    {
        if ($id == 0) {
            $item = json_decode('[{"idBitacora":0, "idrelPlantaContenedor": ' . $idRel . '}]');
        } else {
            $item = Bitacora::where('idBitacora', $id)->get();
        }


        return view('admin/pages/BitacorasForm')->with(['item' => $item[0]]);
    }
    public function verImagenesBitacora($id)
    {
        $items = BitacoraImagen::where('idBitacora', $id)->get();
        return $items;
    }
    public function subirImagenBitacora(Request $request)
    {
        $cArchivo = $_FILES["image"]["name"];
        $idBitacora = $request->idBitacora;

        try {
            $item = BitacoraImagen::create([
                'idBitacora' => $idBitacora,
                'cNombre' => $cArchivo
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        $this->subeFoto($_FILES["image"], "bitacora", $item->idBitacora . "-" . $item->idBitImg);
        //$filePath = $file->storeAs('bitacora', $originalName, 'public');
        return ("archivo subido correctamente");
    }
    public function delImagenBitacora($id)
    {
        $item = BitacoraImagen::where('idBitImg', $id)->first();
        $LcResp = $this->deleteImage($item->idBitacora . "-" . $id . ".webp");
        $cExt = $this->verExtension($item->cNombre);
        $this->deleteImage($item->idBitacora . "-" . $id . "." . $cExt);
        BitacoraImagen::where('idBitImg', $id)->delete();
        return ($LcResp);
    }
    private function deleteImage($filename)
    {
        $path = public_path('images/content/bitacora/' . $filename);

        if (File::exists($path)) {
            File::delete($path);
            return "Archivo eliminado con éxito." . $filename;
        } else {
            return "Archivo no encontrado." . $filename;
        }
    }






    public function showUsers()
    {
        if ($this->showRol() > 1) {
            return redirect()->route('admin.inicio');
        }
        $items = UserInfo::orderBy('apellido')
            ->get();
        return view('admin/pages/UsuariosShow')->with(['items' => $items]);
    }
    public function formUsers($id)
    {
        if ($this->showRol() > 1) {
            return redirect()->route('admin.inicio');
        }
        if ($id == 0) {
            $item = json_decode('[{"idUsuario":0}]');
        } else {
            $item = UserInfo::where('idUsuario', $id)->get();
        }
        return view('admin/pages/UsuariosForm')->with(['item' => $item[0]]);
    }
    public function delUsers($id)
    {
        if ($this->showRol() > 1) {
            return redirect()->route('admin.inicio');
        }
        UserInfo::where('idUsuario', $id)->update(['cEstatus' => 'B']);
        return redirect()->route('usuarios');
    }
    public function creaUsers(Request $request)
    {
        if ($this->showRol() > 1) {
            return redirect()->route('admin.inicio');
        }
        $cArchivo = $_FILES["archivo"]["name"];
        $ext = $this->verExtension($cArchivo);
        if ($request->estatus === "on") {
            $estatus = 'A';
        } else {
            $estatus = 'B';
        }
        if ($request->public === "on") {
            $public = 1;
        } else {
            $public = 0;
        }
        $pass = "INIAT-Huerto23";
        $item = UserInfo::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'telefono' => $request->tel,
            'escolaridad' => $request->esco,
            'semblanza' => $request->cv,
            'comunidadIbero' => $request->comunidad,
            'otraInstitucion' => $request->otro,
            'discapacidad' => $request->dis,
            'cExt' => $ext,
            'tipo' => $request->tipo,
            'cEstatus' => $estatus,
            'iPublic' => $public,
            'idUsrAlta' => Auth::id(),
            'dNacimiento' => $request->fecha,
            'cLink' => $request->link,
        ]);
        User::create([
            'name' => $request->nombre . " " . $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($pass),
        ]);
        $this->subeFoto($_FILES["archivo"], "colaboradores", $item->idUsuario);
        return redirect()->route('usuarios');
    }
    public function upUsers(Request $request)
    {
        if ($this->showRol() > 1) {
            return redirect()->route('admin.inicio');
        }
        if ($_FILES["archivo"]["name"]) {
            $cArchivo = $_FILES["archivo"]["name"];
            $ext = $this->verExtension($cArchivo);
            $subeFoto = $this->subeFoto($_FILES["archivo"], "colaboradores", $request->idUsuario);
            UserInfo::where('idUsuario', $request->idUsuario)->update(['cExt' => $ext]);
        }



        //return $subeFoto;
        if ($request->estatus === "on") {
            $estatus = 'A';
        } else {
            $estatus = 'B';
        }
        if ($request->public === "on") {
            $public = 1;
        } else {
            $public = 0;
        }
        $item = UserInfo::where('idUsuario', $request->idUsuario)->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'telefono' => $request->tel,
            'escolaridad' => $request->esco,
            'semblanza' => $request->cv,
            'comunidadIbero' => $request->comunidad,
            'otraInstitucion' => $request->otro,
            'discapacidad' => $request->dis,
            'tipo' => $request->tipo,
            'cEstatus' => $estatus,
            'iPublic' => $public,
            'dNacimiento' => $request->fecha,
            'cLink' => $request->link,
        ]);
        User::where('id', $request->idUsuario)->update([
            'name' => $request->nombre . " " . $request->apellido,
            'email' => $request->email,
        ]);


        return redirect()->route('usuarios');
    }













    private function subeFoto($archivo, $ruta, $id)
    {
        $target_dir = public_path() . "/images/content";
        $infoArchivo = new SplFileInfo($archivo['name']);
        $ext = $infoArchivo->getExtension();
        /*if(move_uploaded_file($archivo['tmp_name'], $target_dir."/".$ruta."/".$id.".".$ext)){
            //CREA UNA IMAGEN EN FORMATO WEBP
            shell_exec("convert -colorspace sRGB '".$target_dir."/".$ruta."/".$id.".".$ext."' -quality 90 ".$target_dir."/".$ruta."/".$id.".webp");
        } */

        try {
            if (move_uploaded_file($archivo['tmp_name'], $target_dir . "/" . $ruta . "/" . $id . "." . $ext)) {
                //CREA UNA IMAGEN EN FORMATO WEBP
                $command = "convert -colorspace sRGB '" . $target_dir . "/" . $ruta . "/" . $id . "." . $ext . "' -quality 90 " . $target_dir . "/" . $ruta . "/" . $id . ".webp";
                shell_exec($command);
                echo 'archivo subido correctamente';
            } else {
                $error = error_get_last();
                throw new Exception('Error al mover el archivo subido. Detalles: ' . ($error ? $error['message'] : 'No se pudo determinar el error.'));
            }
        } catch (Exception $e) {
            // Manejo del error
            echo 'Error: ' . $e->getMessage();
        }
    }

    private function verExtension($nombre)
    {
        $infoArchivo = new SplFileInfo($nombre);
        $ext = $infoArchivo->getExtension();
        return $ext;
    }
}
