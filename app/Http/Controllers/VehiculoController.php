<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VehiculoController extends Controller
{
    public function index(Request $request){
         $vehiculos = DB::select('SELECT * FROM vehiculos WHERE cliente_id = ?',[$request->user()->id]);
        return response()->json($vehiculos,200);
    }
    public function create(Request $request){
        //$imagen64 = $request->imagen64;
        //$fp = fopen("./images/".rand(1,100)."png","w+");
        //fwrite($fp,base64_decode($imagen64));
        //$image = base64_decode($imagen64);
        //Storage::put()(public_path('/img/'.$imagenName), base64_decode($imagen));
        $vehiculo = new Vehiculo();
        
        $vehiculo->marca = $request->marca;
        $vehiculo->anho = $request->anho;
        $vehiculo->modelo = $request->modelo;
        $nameImg = time() . '_' . $request->photos->getClientOriginalName();

        $pathImg = $request->photos->storeAs('public/images/vehiculos',$nameImg);

        $urlImg = Storage::url($pathImg);
        $vehiculo->path = $urlImg;
        $vehiculo->cliente_id = $request->user()->id;
        $vehiculo->save();

        return response()->json([
            "imagen" => "LISTO",
            "message" => "Vehiculo Añadido"],200);
        
    }
}
