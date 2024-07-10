<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//RUTAS DE SITIO
Route::get('/', [App\Http\Controllers\datosController::class, 'inicio'])->name('inicio');

Route::get('/acerca', [App\Http\Controllers\datosController::class, 'acercade'])->name('acercaDe');
Route::get('/catalogo', [App\Http\Controllers\datosController::class, 'verCatalogo'])->name('showCatalogo');
Route::get('/catalogo/infoCama/{id}', [App\Http\Controllers\datosController::class, 'verInfoCama'])->name('verInfoCama');
Route::get('/proyectos', [App\Http\Controllers\datosController::class, 'verProyectos'])->name('showProyectos');
Route::get('/actividades', [App\Http\Controllers\datosController::class, 'verActividades'])->name('showActividades');
Route::get('/capacitacion', [App\Http\Controllers\datosController::class, 'verCapacitacion'])->name('showCapacitacion');
Route::get('/contacto', [App\Http\Controllers\datosController::class, 'Contacto'])->name('showContactos');
Route::get('/eventos', [App\Http\Controllers\datosController::class, 'verEventos'])->name('showEventos');
Route::get('/noticias', [App\Http\Controllers\datosController::class, 'verNoticias'])->name('showNoticias');
//RUTAS DE SITIO CON VARIABLES
Route::get('/proyecto/{id}', [App\Http\Controllers\datosController::class, 'verProyecto'])->name('verProyecto');

Route::get('/planta/{id}', [App\Http\Controllers\datosController::class, 'verPlanta'])->name('verPlanta');

Route::post('/contacto', [App\Http\Controllers\datosController::class, 'enviarMailContacto'])->name('FormContacto');

Route::get('/contactook', [App\Http\Controllers\datosController::class, 'ContactoOK'])->name('ContactoOK');




Route::get('/admin', [App\Http\Controllers\adminController::class, 'entrarAdmin'])->name('admin.inicio');


Route::post('/login', [App\Http\Controllers\adminController::class, 'iniciaSesion'])->name('login');

Route::get('/mwkft6yt3AkEqft7Wu9jQegN9ARiKx', [App\Http\Controllers\adminController::class, 'verjson'])->name('verjson');


Auth::routes(['register' => false, 'login' => false]);



Route::group(['middleware' => 'auth'], function () {

    Route::get('/traerRol', [App\Http\Controllers\adminController::class, 'showRol'])->name('traeRol');

    Route::group(['prefix' => 'admin'], function(){
      
        
        Route::group(['prefix' => 'act'], function(){
            Route::get('/show', [App\Http\Controllers\adminController::class, 'showActividades'])->name('actividades');
            Route::get('/form/{id}', [App\Http\Controllers\adminController::class, 'formActividades'])->name('formActividad');
            Route::get('/delete/{id}', [App\Http\Controllers\adminController::class, 'delActividades'])->name('delActividad');
            Route::post('/create', [App\Http\Controllers\adminController::class, 'creaActividades'])->name('creaActividad');
            Route::post('/update', [App\Http\Controllers\adminController::class, 'upActividades'])->name('upActividad');
        });

        Route::group(['prefix' => 'cap'], function(){
            Route::get('/show', [App\Http\Controllers\adminController::class, 'showCapacitaciones'])->name('capacitaciones');
            Route::get('/form/{id}', [App\Http\Controllers\adminController::class, 'formCapacitaciones'])->name('formCapacitacion');
            Route::get('/delete/{id}', [App\Http\Controllers\adminController::class, 'delCapacitaciones'])->name('delCapacitacion');
            Route::post('/create', [App\Http\Controllers\adminController::class, 'creaCapacitaciones'])->name('creaCapacitacion');
            Route::post('/update', [App\Http\Controllers\adminController::class, 'upCapacitaciones'])->name('upCapacitacion');
        });

        Route::group(['prefix' => 'noticias'], function(){
            Route::get('/show', [App\Http\Controllers\adminController::class, 'showNoticias'])->name('noticias');
            Route::get('/form/{id}', [App\Http\Controllers\adminController::class, 'formNoticias'])->name('formNoticia');
            Route::get('/delete/{id}', [App\Http\Controllers\adminController::class, 'delNoticias'])->name('delNoticia');
            Route::post('/create', [App\Http\Controllers\adminController::class, 'creaNoticias'])->name('creaNoticia');
            Route::post('/update', [App\Http\Controllers\adminController::class, 'upNoticias'])->name('upNoticia');
        });

        Route::group(['prefix' => 'eventos'], function(){
            Route::get('/show', [App\Http\Controllers\adminController::class, 'showEventos'])->name('eventos');
            Route::get('/form/{id}', [App\Http\Controllers\adminController::class, 'formEventos'])->name('formEvento');
            Route::get('/delete/{id}', [App\Http\Controllers\adminController::class, 'delEventos'])->name('delEvento');
            Route::post('/create', [App\Http\Controllers\adminController::class, 'creaEventos'])->name('creaEvento');
            Route::post('/update', [App\Http\Controllers\adminController::class, 'upEventos'])->name('upEvento');
        });

        Route::group(['prefix' => 'bios'], function(){
            Route::get('/show', [App\Http\Controllers\adminController::class, 'showBios'])->name('bios');
            Route::get('/form/{id}', [App\Http\Controllers\adminController::class, 'formBios'])->name('formBios');
            Route::get('/delete/{id}', [App\Http\Controllers\adminController::class, 'delBios'])->name('delBios');
            Route::post('/create', [App\Http\Controllers\adminController::class, 'creaBios'])->name('creaBios');
            Route::post('/update', [App\Http\Controllers\adminController::class, 'upBios'])->name('upBios');
        });

        Route::group(['prefix' => 'huertos'], function(){
            Route::get('/show', [App\Http\Controllers\adminController::class, 'showHuertos'])->name('huertos');
            Route::get('/form/{id}', [App\Http\Controllers\adminController::class, 'formHuertos'])->name('formHuerto');
            Route::get('/delete/{id}', [App\Http\Controllers\adminController::class, 'delHuertos'])->name('delHuerto');
            Route::post('/create', [App\Http\Controllers\adminController::class, 'creaHuertos'])->name('creaHuerto');
            Route::post('/update', [App\Http\Controllers\adminController::class, 'upHuertos'])->name('upHuerto');
        });

        Route::group(['prefix' => 'proyectos'], function(){
            Route::get('/show', [App\Http\Controllers\adminController::class, 'showProyectos'])->name('proyectos');
            Route::get('/form/{id}', [App\Http\Controllers\adminController::class, 'formProyectos'])->name('formProyecto');
            Route::get('/delete/{id}', [App\Http\Controllers\adminController::class, 'delProyectos'])->name('delProyecto');
            Route::post('/create', [App\Http\Controllers\adminController::class, 'creaProyectos'])->name('creaProyecto');
            Route::post('/update', [App\Http\Controllers\adminController::class, 'upProyectos'])->name('upProyecto');
        });

        Route::group(['prefix' => 'exp'], function(){
            Route::get('/show', [App\Http\Controllers\adminController::class, 'showExperimentos'])->name('experimentos');
            Route::get('/form/{id}', [App\Http\Controllers\adminController::class, 'formExperimentos'])->name('formExp');
            Route::get('/delete/{id}', [App\Http\Controllers\adminController::class, 'delExperimentos'])->name('delExp');
            Route::post('/create', [App\Http\Controllers\adminController::class, 'creaExperimentos'])->name('creaExp');
            Route::post('/update', [App\Http\Controllers\adminController::class, 'upExperimentos'])->name('upExp');
        });

        Route::group(['prefix' => 'plantas'], function(){
            Route::get('/show', [App\Http\Controllers\adminController::class, 'showPlantas'])->name('plantas');
            Route::get('/form/{id}', [App\Http\Controllers\adminController::class, 'formPlantas'])->name('formPlanta');
            Route::get('/delete/{id}', [App\Http\Controllers\adminController::class, 'delPlantas'])->name('delPlanta');
            Route::post('/create', [App\Http\Controllers\adminController::class, 'creaPlantas'])->name('creaPlanta');
            Route::post('/update', [App\Http\Controllers\adminController::class, 'upPlantas'])->name('upPlanta');
            Route::get('/search', [App\Http\Controllers\adminController::class, 'autocompletePlantas'])->name('autocomplete.plantas');
            Route::get('/info/{id}', [App\Http\Controllers\adminController::class, 'infoPlanta'])->name('infoPlanta');
        });

        Route::group(['prefix' => 'semillas'], function(){
            Route::get('/show', [App\Http\Controllers\adminController::class, 'showSemillas'])->name('semillas');
            Route::get('/form/{id}', [App\Http\Controllers\adminController::class, 'formSemillas'])->name('formSem');
            Route::get('/delete/{id}', [App\Http\Controllers\adminController::class, 'delSemillas'])->name('delSem');
            Route::post('/create', [App\Http\Controllers\adminController::class, 'creaSemillas'])->name('creaSem');
            Route::post('/update', [App\Http\Controllers\adminController::class, 'upSemillas'])->name('upSem');
        });

        Route::group(['prefix' => 'contenedor'], function(){
            Route::get('/show', [App\Http\Controllers\adminController::class, 'showContenedores'])->name('contenedores');
            Route::get('/form/{id}', [App\Http\Controllers\adminController::class, 'formContenedores'])->name('formCont');
            Route::get('/delete/{id}', [App\Http\Controllers\adminController::class, 'delContenedores'])->name('delCont');
            Route::post('/create', [App\Http\Controllers\adminController::class, 'creaContenedores'])->name('creaCont');
            Route::post('/update', [App\Http\Controllers\adminController::class, 'upContenedores'])->name('upCont');

            Route::group(['prefix' => 'tipos'], function(){
                Route::get('/show', [App\Http\Controllers\adminController::class, 'showContenedoresTipos'])->name('contenedores.tipos');
                Route::post('/update', [App\Http\Controllers\adminController::class, 'upContenedoresTipos'])->name('upCont.tipos');
                Route::get('/delete/{id}', [App\Http\Controllers\adminController::class, 'delContenedoresTipos'])->name('delCont.tipos');
                Route::post('/create', [App\Http\Controllers\adminController::class, 'creaContenedoresTipos'])->name('creaCont.tipos');
                Route::get('/form/{id}', [App\Http\Controllers\adminController::class, 'formContenedoresTipo'])->name('formCont.tipos');
            });

            Route::group(['prefix' => 'bitacora'], function(){
                Route::get('/show/{idPlanta}', [App\Http\Controllers\adminController::class, 'showBitacora'])->name('contenedores.bit');
                Route::post('/update', [App\Http\Controllers\adminController::class, 'upBitacora'])->name('upCont.bit');
                Route::get('/delete/{id}', [App\Http\Controllers\adminController::class, 'delBitacora'])->name('delCont.bit');
                Route::get('/baja/{id}/{estatus}', [App\Http\Controllers\adminController::class, 'estatusBitacora'])->name('estCont.bit');
                Route::post('/create', [App\Http\Controllers\adminController::class, 'creaBitacora'])->name('creaCont.bit');
                Route::get('/form/{id}/{idRel}', [App\Http\Controllers\adminController::class, 'formBitacora'])->name('formCont.bit');
                Route::get('/imgs/{id}', [App\Http\Controllers\adminController::class, 'verImagenesBitacora'])->name('verImg.bit');
                Route::post('/uploadimg', [App\Http\Controllers\adminController::class, 'subirImagenBitacora'])->name('subirImg.bit');
                Route::get('/delimg/{id}', [App\Http\Controllers\adminController::class, 'delImagenBitacora'])->name('delImg.bit');
            });
            
            Route::group(['prefix' => 'plantas'], function(){
                Route::get('/show/{id}', [App\Http\Controllers\adminController::class, 'showContenedoresPlantas'])->name('contenedores.plantas');
                Route::get('/form/{id}/{idRel}', [App\Http\Controllers\adminController::class, 'formContenedoresPlantas'])->name('formCont.plantas');
                Route::get('/delete/{id}/{conte}', [App\Http\Controllers\adminController::class, 'delContenedoresPlantas'])->name('delCont.plantas');
                Route::get('/baja/{id}/{conte}/{estatus}', [App\Http\Controllers\adminController::class, 'bajaContenedoresPlantas'])->name('bajaCont.plantas');
                Route::post('/create', [App\Http\Controllers\adminController::class, 'creaContenedoresPlantas'])->name('creaCont.plantas');
            });
        });

        Route::group(['prefix' => 'user'], function(){
            Route::get('/show', [App\Http\Controllers\adminController::class, 'showUsers'])->name('usuarios');
            Route::get('/form/{id}', [App\Http\Controllers\adminController::class, 'formUsers'])->name('formUser');
            Route::get('/delete/{id}', [App\Http\Controllers\adminController::class, 'delUsers'])->name('delUser');
            Route::post('/create', [App\Http\Controllers\adminController::class, 'creaUsers'])->name('creaUser');
            Route::post('/update', [App\Http\Controllers\adminController::class, 'upUsers'])->name('upUser');
        });
 
    });


});



