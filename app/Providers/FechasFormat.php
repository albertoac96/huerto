<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class FechasFormat extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::share('FechaCorta', function ($PsFecha) {
            if($PsFecha=="") return("");
            $PsFecha = substr($PsFecha,0,10);
            $PsFecha = str_replace("/","-",$PsFecha);
            list($ano, $mes, $dia) = explode('-', $PsFecha);
            $mes = intval($mes);

            $LaMes = array ("","Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");

            return($dia." de ".$LaMes[$mes]." ".$ano);
        });

        View::share('Hoy', function () {
            $newDate = date("Y-m-d");
            return $newDate;
        });

        View::share('FechaEsp', function ($PsFecha) {
            if($PsFecha=="") return(date("d-m-Y"));
            $PsFecha = substr($PsFecha,0,10);
            $PsFecha = str_replace("/","-",$PsFecha);
            list($ano, $mes, $dia) = explode('-', $PsFecha);
           // $mes = intval($mes);

            return($dia."-".$mes."-".$ano);
        });

        View::share('FechaEng', function ($PsFecha) {
            if($PsFecha=="") return(date("d-m-Y"));
            $PsFecha = substr($PsFecha,0,10);
            return($PsFecha);
            $PsFecha = str_replace("/","-",$PsFecha);
            list($ano, $mes, $dia) = explode('-', $PsFecha);
           // $mes = intval($mes);

            return($ano."-".$mes."-".$dia);
        });
    }
}
