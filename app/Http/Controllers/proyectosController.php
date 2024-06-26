<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB; //consulta a db

use App\Models\Proyecto;

class proyectosController extends Controller
{
    private $sitiosrel;

    public function __construct()
    {
        $this->sitiosrel = DB::table('h_sitiosrel')->get();
    }


    public function verProyecto($id){
        $LcResp = Proyecto::select('T1.*', 'T2.*')
        ->from('h_proyectos as T1')
        ->leftJoin('h_usuarios as T2', 'T1.idResponsable', '=', 'T2.idUsuario')
        ->where('T1.idProyecto', '=', $id)
        ->get();

        $data = [
            'proyecto'=>$LcResp[0],
            'sitiosrel'=>$this->sitiosrel
        ];

        return view("sitio.proyecto.ver")->with($data);
    }
}
