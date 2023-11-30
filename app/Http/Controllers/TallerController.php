<?php

namespace App\Http\Controllers;

use App\Models\ServicioToTaller;
use App\Models\Taller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TallerController extends Controller
{
    public function index(Request $request){
        $taller = DB::select('SELECT * FROM tallers WHERE propietario_id = ?',[$request->user()->id]);
        return response()->json($taller,200);
    }

    public function tallers(Request $request){
        $taller = DB::select('SELECT * FROM tallers');
        return response()->json($taller,200);
    }
    public function create(Request $request){
        $taller = new Taller();
        $taller->nombre = $request->nombre;
        $taller->ubicacion = $request->ubicacion;
        $taller->telefono = $request->telefono;
        $taller->propietario_id = $request->user()->id;
        $taller->save();
        return response()->json(["Menssage"=> "TALLER CREADO","taller"=> $taller],200);
    }

    public function addServicioToTaller (Request $request){
        $taller = DB::select('SELECT * FROM tallers WHERE propietario_id = ?',[$request->user()->id]);

        DB::table('servicio_to_tallers')->insert([
        'taller_id' =>$taller[0]->id,
        'servicio_id'=>$request->servicio_id,
        'precio'=>$request->precioBase],);
        return response()->json(["Menssage"=> "SERVICIO AGREGADO"],200);
    }

    public function getServicioToTaller (Request $request){
        $taller = DB::select('SELECT * FROM tallers WHERE propietario_id = ?',[$request->user()->id]);

        $servicios = DB::select('SELECT servicios.nombre,servicio_to_tallers.precio FROM servicio_to_tallers,servicios WHERE servicio_to_tallers.servicio_id=servicios.id and servicio_to_tallers.taller_id = ?', [$taller[0]->id]);
        return response()->json($servicios,200);
    }
}
