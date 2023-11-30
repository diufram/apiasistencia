<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AsistenciaController extends Controller
{
    public function asistencia(Request $request)
    {

        if ($request->user()->tipo[0] == "c") {
            $asistencias = DB::select('SELECT asistencias.id,asistencias.descripcion,asistencias.latitud,asistencias.longitud,asistencias.url,asistencias.taller_id,asistencias.cliente_id,asistencias.cobro_id,asistencias.tecnico_id,asistencias.servicio_id,asistencias.sw,asistencias.total,servicios.nombre, tallers.nombre as taller_nombre FROM asistencias,servicios,tallers WHERE asistencias.taller_id=tallers.id and servicios.id= asistencias.servicio_id and  sw = false and cliente_id = ?', [$request->user()->id]);
            return response()->json($asistencias,200);
        } else if ($request->user()->tipo[0] == "p") {
            $taller_id = DB::select('SELECT tallers.id FROM tallers WHERE propietario_id = ?', [$request->user()->id]);
            $asistencias = DB::select('SELECT asistencias.id,asistencias.descripcion,asistencias.latitud,asistencias.longitud,asistencias.url,asistencias.taller_id,asistencias.cliente_id,asistencias.cobro_id,asistencias.tecnico_id,asistencias.servicio_id,asistencias.sw,asistencias.total,servicios.nombre FROM asistencias,servicios WHERE servicios.id= asistencias.servicio_id  and sw = ? and taller_id= ?  ',[false,$taller_id[0]->id]);
            return response()->json($asistencias,200);
        } else if ($request->user()->tipo[0] == 't') {
            $asistencias = DB::select('SELECT asistencias.id,asistencias.descripcion,asistencias.latitud,asistencias.longitud,asistencias.url,asistencias.taller_id,asistencias.cliente_id,asistencias.cobro_id,asistencias.tecnico_id,asistencias.servicio_id,asistencias.sw,asistencias.total,servicios.nombre, users.name as cliente_name FROM asistencias,servicios,users WHERE  asistencias.cliente_id= users.id and sw = false and servicios.id= asistencias.servicio_id and tecnico_id = ?', [$request->user()->id]);
            return response()->json($asistencias,200);
        }
    }
    public function create(Request $request)
    {
        $asistencia = new Asistencia();
        $asistencia->descripcion = $request->descripcion;
        $asistencia->latitud = $request->latitud;
        $asistencia->longitud = $request->longitud;
        $asistencia->cliente_id = $request->user()->id;
        $asistencia->url = $request->user()->id;
        $asistencia->taller_id = $request->taller_id;
        $asistencia->servicio_id = $request->servicio_id;
        $nameImg = time() . '_' . $request->photos->getClientOriginalName();
        $pathImg = $request->photos->storeAs('public/images/asistencias', $nameImg);
        $urlImg = Storage::url($pathImg);
        $asistencia->url = $urlImg;
        $asistencia->save();

        return response()->json(["Message" => "Solicitud de asistencia creada"], 200);
    }
    public function cancelarAsistencia(Request $request){
        $asistencia = Asistencia::find($request->asistencia_id);
        $asistencia->sw= true;
        $asistencia->save();
    }
    

    public function cobroasistencia(Request $request){
        $asistencia = Asistencia::find($request->asistencia_id);
        $asistencia->total= $request->total;
        $asistencia->save();
    }

}
