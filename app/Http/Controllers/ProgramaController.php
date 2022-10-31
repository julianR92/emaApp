<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eje;
use App\Models\Proceso;
use App\Models\Area;
use App\Models\Programa;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Validator;

class ProgramaController extends Controller
{
    
    public function index(){
    
        
        $areas = Area::all();      
     
        return view('livewire.programas.index',compact('areas'));
        
       }
    
    public function areaProgramas($id){
      
        $area = Area::findOrFail($id);
        $ejes = Eje::all();         
        $programas = Programa::select(['programas.programa', 'procesos.name as nombre_proceso', 'eje.descripcion as nombre_eje', 'programas.estado','programas.id'])->join('procesos','procesos.id','=','programas.proceso_id')->join('eje','eje.id','=','programas.eje_id')->where('programas.area_id', $id)->orderBy('programas.id', 'desc')->get();       
        
        return view('livewire.programas.programa',compact('area','programas','ejes'));
    }

    public function programaProceso($id){
       
    $eje = Eje::findOrFail($id);
    $proceso = Proceso::findOrFail($eje->proceso_id);
    return response()->json(['data' => $proceso]);


    }

    public function store(Request $request){ 
        
        $validator = Validator::make($request->all(), [
            'programa' => 'required|max:150',
            'proceso_id' => 'required',
            'area_id' => 'required',
            'eje_id' => 'required',
            'duracion_programa'=>'required'
        ]);
    
        if($validator->fails()){
            //devuelve errores a la vista
         return response()->json([ 'success'=>false,'errors'=>$validator->errors()->all()]);
        }
        $validacion = Programa::where('area_id', $request->area_id)->where('programa',$request->programa)->get();
        
    
        if(!$request->id){
            if($validacion->count()>0){
                return response()->json(['success'=>false, 'errors'=>['ESTE PROGRAMA YA REGISTRADO']]);
            }
            $programas = new Programa();
            $programas->proceso_id  = $request->proceso_id;
            $programas->area_id  = $request->area_id;
            $programas->eje_id   = $request->eje_id;
            $programas->programa   = $request->programa;
            $programas->duracion_programa   = $request->duracion_programa;
            $programas->estado   = 1;
            $programas->vigencia   = env('VIGENCIA_ACTUAL');
             if($programas->save()){
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones'=> 'Creacion de Programa '. $request->programa .' en la plataforma',
                    'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
        
                ]);
                
                $datos =Programa::select(['programas.programa', 'procesos.name as nombre_proceso', 'eje.descripcion as nombre_eje', 'programas.estado','programas.id'])->join('procesos','procesos.id','=','programas.proceso_id')->join('eje','eje.id','=','programas.eje_id')->where('programas.area_id', $request->area_id)->orderBy('programas.id', 'desc')->get();
                return response()->json(['success'=>true,'message'=>'Programa Creado','datos'=>$datos]);   
    
             }
        }else{

            $programas = Programa::findOrFail($request->id);
            $programas->proceso_id  = $request->proceso_id;
            $programas->area_id  = $request->area_id;
            $programas->eje_id   = $request->eje_id;
            $programas->programa   = $request->programa;
            $programas->duracion_programa   = $request->duracion_programa;
            if($programas->save()){
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones'=> 'Actualizacion de Programa '. $request->programa .' en la plataforma',
                    'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
        
                ]);
                   $datos  =Programa::select(['programas.programa', 'procesos.name as nombre_proceso', 'eje.descripcion as nombre_eje', 'programas.estado','programas.id'])->join('procesos','procesos.id','=','programas.proceso_id')->join('eje','eje.id','=','programas.eje_id')->where('programas.area_id', $request->area_id)->orderBy('programas.id', 'desc')->get();
                   return response()->json(['success'=>true,'message'=>'Programa Actualizado','datos'=>$datos]);   
    
             }
    
        }
    
    
      }

      public function edit($id){
        $programa = Programa::select(['programas.programa', 'procesos.name as proceso', 'programas.eje_id', 'programas.proceso_id','programas.id', 'programas.area_id', 'programas.duracion_programa'])->join('procesos','procesos.id','=','programas.proceso_id')->where('programas.id', $id)->get();
        return response()->json(['data' => $programa]);
      }

      public function changeState($id){
        $programa = Programa::findOrFail($id);
        if($programa->estado){
           $programa->estado = 0;
           $programa->save();
           return response()->json(['success'=>true,'message'=>'Programa Desactivado']); 
        }else{
            $programa->estado = 1;
            $programa->save();
           return response()->json(['success'=>true,'message'=>'Programa Activado']); 
        }
        
      }

      public function delete($id){
        $programa = Programa::findOrFail($id);
        
     $auditoria = Auditoria::create([
         'usuario' => auth()->user()->first_name,
         'correo' => auth()->user()->email,
         'observaciones'=> 'Eliminación de eje '. $programa->programa .' en la plataforma',
         'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
 
     ]);
     $programa->delete();
         
         return response()->json(['success'=>true,'message'=>'Programa Eliminado']); 
   }
}
