<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eje;
use App\Models\Proceso;
use Illuminate\Support\Facades\DB;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Validator;

class EjeController extends Controller
{
    public function index(){
    
     $ejes = Eje::select('eje.id', 'eje.descripcion', 'eje.proceso_id','procesos.name as proceso')->join('procesos','procesos.id','=','eje.proceso_id')->orderBy('eje.id', 'desc')->get();
     $procesos = Proceso::all();
     
  
     return view('livewire.ejes.index',compact('procesos','ejes'));
     
    }

   public function store(Request $request){ 
    
    $validator = Validator::make($request->all(), [
        'descripcion' => 'required|max:100',
        'proceso' => 'required'
    ]);

    if($validator->fails()){
        //devuelve errores a la vista
     return response()->json(['errors'=>$validator->errors()->all()]);
    }

    if(!$request->id){
        $ejes = new Eje();
        $ejes->descripcion = $request->descripcion;
        $ejes->proceso_id = $request->proceso;
         if($ejes->save()){
            $auditoria = Auditoria::create([
                'usuario' => auth()->user()->first_name,
                'correo' => auth()->user()->email,
                'observaciones'=> 'Creacion de eje '. $request->area .' en la plataforma',
                'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
    
            ]);
               return response()->json(['success'=>true,'message'=>'Eje Creado']);   

         }
    }else{
        $ejes = Eje::findOrFail($request->id);
        $ejes->descripcion = $request->descripcion;
        $ejes->proceso_id = $request->proceso;
        if($ejes->save()){
            $auditoria = Auditoria::create([
                'usuario' => auth()->user()->first_name,
                'correo' => auth()->user()->email,
                'observaciones'=> 'Actualizacion de eje '. $request->area .' en la plataforma',
                'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
    
            ]);
               return response()->json(['success'=>true,'message'=>'Eje Actualizado']);   

         }

    }


  }
//   public function listarEjes(){
   
//     $ejes = Eje::select('eje.id', 'eje.descripcion', 'eje.proceso_id','procesos.name as proceso')->join('procesos','procesos.id','=','eje.proceso_id')->orderBy('eje.id', 'desc')->get();
//     return response()->json(['data' => $ejes]);

//   }

  public function edit($id){
    $eje = Eje::findOrFail($id);
    return response()->json(['data' => $eje]);
  }
  public function delete($id){
       $eje = Eje::findOrFail($id);
       
    $auditoria = Auditoria::create([
        'usuario' => auth()->user()->first_name,
        'correo' => auth()->user()->email,
        'observaciones'=> 'Eliminación de eje '. $eje->descripcion .' en la plataforma',
        'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           

    ]);
    $eje->delete();
        
        return response()->json(['success'=>true,'message'=>'Eje Eliminado']); 
  }
}
