<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\ServicioToTaller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicioController extends Controller
{
    public function index(){
        $servicios = Servicio::all();
        return response()->json($servicios,200);
    }

    public function servicioToTallers(Request $request){
        $servicioToTaller = DB::select('SELECT precio, servicio_id, taller_id, tallers.nombre as taller_nombre, servicios.nombre as servicio_nombre FROM servicio_to_tallers, servicios, tallers WHERE servicio_to_tallers.servicio_id = servicios.id and servicio_to_tallers.taller_id = tallers.id and servicio_to_tallers.servicio_id = ?', [$request->servicio_id]);
        return response()->json($servicioToTaller,200);
    }
}
