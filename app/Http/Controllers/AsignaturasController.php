<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eje;
use App\Models\Proceso;
use App\Models\Area;
use App\Models\Programa;
use App\Models\Asignatura;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Validator;

class AsignaturasController extends Controller
{

    
    public function index(){    
        
        $areas = Area::all();      
     
        return view('livewire.asignaturas.index',compact('areas'));
        
       }
    
    public function areaAsignaturas($id){
      
        $area = Area::findOrFail($id);               
        $asignaturas = Asignatura::where('area_id', $id)->get();       
        
        return view('livewire.asignaturas.asignaturas',compact('area','asignaturas'));
    }

    public function programaProceso($id){
       
    $eje = Eje::findOrFail($id);
    $proceso = Proceso::findOrFail($eje->proceso_id);
    return response()->json(['data' => $proceso]);


    }

    public function store(Request $request){ 
        
        $validator = Validator::make($request->all(), [
            'asignatura' => 'required|max:150|unique:asignaturas,asignatura,'. $request->id,
            'codigo' => 'required|max:15|unique:asignaturas,codigo,'. $request->id,
            'creditos' => 'digits_between:1,2|nullable',
            'area_id' => 'required',
        ]);
    
        if($validator->fails()){
            //devuelve errores a la vista
         return response()->json([ 'success'=>false,'errors'=>$validator->errors()->all()]);
        }
         $requisito = 1;
         $asignatura_padre = $request->asig_padre_id;
        if($request->asig_padre_id == '9999'){
            $requisito = 0;
            $asignatura_padre = null;
        }
           
        if (!$request->id) {
             
            $asignatura = new Asignatura();
            $asignatura->codigo  = $request->codigo;
            $asignatura->asignatura  = $request->asignatura;
            $asignatura->requisito   = $requisito;
            $asignatura->asig_padre_id   = $asignatura_padre;
            $asignatura->creditos  = $request->creditos;
            $asignatura->area_id  = $request->area_id;
            $asignatura->estado   = 1;            
             if($asignatura->save()){
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones'=> 'Creacion de asignatura '. $request->asignatura .' en la plataforma',
                    'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
        
                ]);
                
                $datos = Asignatura::where('area_id', $request->area_id)->get();   
                return response()->json(['success'=>true,'message'=>'Asignatura Creada','datos'=>$datos]);   
    
             }
        }else{

            $asignatura = Asignatura::findOrFail($request->id);
            $asignatura->codigo  = $request->codigo;
            $asignatura->asignatura  = $request->asignatura;
            $asignatura->requisito   = $requisito;
            $asignatura->asig_padre_id   = $asignatura_padre;
            $asignatura->creditos  = $request->creditos;                            
            if($asignatura->save()){
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones'=> 'Actualizacion de Asignatura '. $request->asignatura .' en la plataforma',
                    'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
        
                ]);
                   $datos  =Asignatura::where('area_id', $request->area_id)->get();   
                   return response()->json(['success'=>true,'message'=>'Asignatura Actualizada','datos'=>$datos]);   
    
             }
    
        }
    
    
      }

      public function edit($id){
        $asignatura = Asignatura::findOrFail($id);
        return response()->json(['data' => $asignatura]);
      }

      public function changeState($id){
        $asignatura = Asignatura::findOrFail($id);
        if($asignatura->estado){
           $asignatura->estado = 0;
           $asignatura->save();
           return response()->json(['success'=>true,'message'=>'Asignatura Desactivado']); 
        }else{
            $asignatura->estado = 1;
            $asignatura->save();
           return response()->json(['success'=>true,'message'=>'Asignatura Activado']); 
        }
        
      }

      public function delete($id){
        $asignatura = Asignatura::findOrFail($id);
        
     $auditoria = Auditoria::create([
         'usuario' => auth()->user()->first_name,
         'correo' => auth()->user()->email,
         'observaciones'=> 'Eliminación de asignatura '. $asignatura->asignatura .' en la plataforma',
         'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
 
     ]);
     $asignatura->delete();
         
         return response()->json(['success'=>true,'message'=>'Asignatura Eliminada']); 
   }
}
