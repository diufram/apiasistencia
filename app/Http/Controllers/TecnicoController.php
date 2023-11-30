<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TecnicoController extends Controller
{
    public function tecnicos(){
        $tecnicos =  DB::select('SELECT * FROM users WHERE tipo = ?',["t"]);
        return response()->json($tecnicos);
    }

    public function addtecnico(Request $request){
        $taller = DB::select('SELECT * FROM tallers WHERE propietario_id = ?',[$request->user()->id]);

        DB::table('tecnico_to_tallers')->insert([
        'taller_id' =>$taller[0]->id,
        'tecnico_id'=>$request->tecnico_id],);
        return response()->json(["Menssage"=> "TECNICO AGREGADO"],200);
    }

    public function tecnicoToTaller(Request $request){
        $taller = DB::select('SELECT * FROM tallers WHERE propietario_id = ?',[$request->user()->id]);
        $tecnicos = DB::select('SELECT users.id,users.name,users.telefono FROM tecnico_to_tallers,users WHERE tecnico_to_tallers.tecnico_id=users.id and tecnico_to_tallers.taller_id = ?', [$taller[0]->id]);
        return response()->json($tecnicos,200);
    }

    public function addTecnicoToAsistencia(Request $request){
        $asistencia = Asistencia::find($request->asistencia_id);
        $asistencia->tecnico_id= $request->tecnico_id;
        $asistencia->save();
    }

    
}
