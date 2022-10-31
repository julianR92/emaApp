<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Programa;
use App\Models\Malla;
use App\Models\MallaDetalle;
use App\Models\MallaAsignatura;
use App\Models\Asignatura;
use App\Models\Colectivo;
use Illuminate\Validation\Rule;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MallaController extends Controller
{
    public function index()
    {


        $areas = Area::all();

        return view('livewire.mallas.index', compact('areas'));
    }

    public function areaMallas($id)
    {

        $area = Area::findOrFail($id);
        $programas = Programa::where('area_id', $id)->where('estado', 1)->orderBy('id', 'desc')->get();
        $mallas =  Malla::select(['malla.cualificacion', 'malla.resolucion', 'malla.duracion', 'malla.horas', 'malla.id','malla.numero_cualificacion', 'programas.programa', 'programas.area_id'])->join('programas', 'programas.id', '=', 'malla.programa_id')->where('programas.area_id', $id)->where('malla.estado', 1)->orderBy('id', 'desc')->get();
        $cualificacion = explode(',', env('CUALIFICACION'));

        return view('livewire.mallas.malla', compact('area', 'programas', 'mallas', 'cualificacion'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'programa_id' => 'required|unique:malla,programa_id,'.$request->id,
            'cualificacion' => 'required|max:20',
            'resolucion' => 'required',
            'numero_cualificacion' => 'required_if:cualificacion,==,SEMESTRE|required_if:cualificacion,==,CICLO',
            'duracion' => 'required',
            'horas' => 'digits_between:1,4|nullable',
            'area_id' => 'required'
        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        if (!$request->id) {
            $mallas = new Malla();
            $mallas->programa_id = $request->programa_id;
            $mallas->cualificacion = $request->cualificacion;
            $mallas->resolucion = $request->resolucion;
            $mallas->numero_cualificacion = ($request->numero_cualificacion) ? $request->numero_cualificacion : 0;
            $mallas->duracion = $request->duracion;
            $mallas->horas = $request->horas;
            $mallas->estado = 1;
            if ($mallas->save()) {

                if ($request->cualificacion != 'CICLO') {
                    $malla_detalle = new MallaDetalle();
                    $malla_detalle->malla_id = $mallas->id;
                    $malla_detalle->descripcion = ($request->numero_cualificacion) ? $request->cualificacion.'-'.$request->numero_cualificacion : $request->cualificacion;
                    $malla_detalle->nivel = 'CURRICULAR';
                    $malla_detalle->estado = 1;
                    $malla_detalle->save();
                }


                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de Malla ' . $mallas->id . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],

                ]);

                $datos =  Malla::select(['malla.cualificacion', 'malla.resolucion', 'malla.duracion', 'malla.horas', 'malla.id','malla.numero_cualificacion', 'programas.programa', 'programas.area_id'])->join('programas', 'programas.id', '=', 'malla.programa_id')->where('programas.area_id', $request->area_id)->where('malla.estado', 1)->orderBy('id', 'desc')->get();
                return response()->json(['success' => true, 'message' => 'Programa Incluido en la Malla', 'datos' => $datos]);
            }
        } else {
            $mallas = Malla::findOrFail($request->id);
            $malla_detalle = MallaDetalle::where('malla_id',$request->id)->get();
            if ($malla_detalle->count() <= 1) {
                $mallas->programa_id = $request->programa_id;
                $mallas->cualificacion = $request->cualificacion;
                $mallas->resolucion = $request->resolucion;
                $mallas->numero_cualificacion = ($request->numero_cualificacion) ? $request->numero_cualificacion : 0;
                $mallas->duracion = $request->duracion;
                $mallas->horas = $request->horas;
                $mallas->estado = 1;
                if ($mallas->save()) {
                    if ($request->cualificacion !='CICLO') {
                        MallaDetalle::where('malla_id',$request->id)->update([
                           'descripcion'=> ($request->numero_cualificacion) ? $request->cualificacion.'-'.$request->numero_cualificacion : $request->cualificacion,
                           'nivel'=> 'CURRICULAR'
                        ]);                     
                    
                    }


                    $auditoria = Auditoria::create([
                        'usuario' => auth()->user()->first_name,
                        'correo' => auth()->user()->email,
                        'observaciones' => 'Actualizacion de malla ' . $request->id . ' en la plataforma',
                        'direccion_ip' => $_SERVER['REMOTE_ADDR'],

                    ]);
                    $datos =  Malla::select(['malla.cualificacion', 'malla.resolucion', 'malla.duracion', 'malla.horas', 'malla.id','malla.numero_cualificacion', 'programas.programa', 'programas.area_id'])->join('programas', 'programas.id', '=', 'malla.programa_id')->where('programas.area_id', $request->area_id)->where('malla.estado', 1)->orderBy('id', 'desc')->get();
                    return response()->json(['success' => true, 'message' => 'Programa Actualizado en la Malla', 'datos' => $datos]);
                }
            } else {
                if ($request->cualificacion == $request->anterior_cualificacion) {
                    $mallas->programa_id = $request->programa_id;
                    $mallas->cualificacion = $request->cualificacion;
                    $mallas->resolucion = $request->resolucion;
                    $mallas->numero_cualificacion = ($request->numero_cualificacion) ? $request->numero_cualificacion : 0;
                    $mallas->duracion = $request->duracion;
                    $mallas->horas = $request->horas;
                    $mallas->estado = 1;
                    if ($mallas->save()) {
                        if ($request->cualificacion != 'CICLO') {
                            MallaDetalle::where('malla_id',$request->id)->update([
                                'descripcion'=> ($request->numero_cualificacion) ? $request->cualificacion.'-'.$request->numero_cualificacion : $request->cualificacion,
                                'nivel'=> 'CURRICULAR'
                             ]);        
                        }

                        $auditoria = Auditoria::create([
                            'usuario' => auth()->user()->first_name,
                            'correo' => auth()->user()->email,
                            'observaciones' => 'Actualizacion de malla ' . $request->id . ' en la plataforma',
                            'direccion_ip' => $_SERVER['REMOTE_ADDR'],

                        ]);
                        $datos =  Malla::select(['malla.cualificacion', 'malla.resolucion', 'malla.duracion', 'malla.horas', 'malla.id','malla.numero_cualificacion', 'programas.programa', 'programas.area_id'])->join('programas', 'programas.id', '=', 'malla.programa_id')->where('programas.area_id', $request->area_id)->where('malla.estado', 1)->orderBy('id', 'desc')->get();
                        return response()->json(['success' => true, 'message' => 'Programa Actualizado en la Malla', 'datos' => $datos]);
                    }
                } else {
                    return response()->json(['success' => false, 'errors' => ['NO PUEDES ACTUALIZAR EL PROGRAMA SI YA CREASTE SUS NIVELES']]);
                }
            }
        }
    }

    public function edit($id){
       $malla = Malla::findOrFail($id);
        return response()->json(['data' => $malla]);
      }

      public function delete($id){
        $malla = Malla::findOrFail($id);
        $malla_detalle = MallaDetalle::where('malla_id', $malla->id);           
        $malla_asignaturas = MallaAsignatura::where('malla_det_id',$malla_detalle->get()[0]->id);     
        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones'=> 'Eliminación de malla '. $malla->id .' en la plataforma',
            'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
            
        ]);
        if($malla_asignaturas->get()){
            $malla_asignaturas->delete();
        }
        $malla_detalle->delete();
        $malla->delete();
         return response()->json(['success'=>true,'message'=>'Programa Eliminado de la Malla']); 
   }


    public function mallaColectivos($id)
    {
      $colectivos = Colectivo::all();
      $malla = Malla::select(['malla.cualificacion', 'malla.resolucion', 'malla.duracion', 'malla.horas', 'malla.id','malla.numero_cualificacion', 'programas.programa', 'programas.area_id'])->join('programas', 'programas.id', '=', 'malla.programa_id')->where('malla.id', $id)->where('malla.estado', 1)->orderBy('id', 'desc')->get();
      $niveles = explode(',', env('NIVELES'));
      $malla_detalle = MallaDetalle::select(['malla_detalle.id','malla_detalle.descripcion','malla_detalle.nivel', 'malla_detalle.estado','malla_detalle.malla_id','colectivos.colectivo'])->join('colectivos','colectivos.id','=',DB::raw("CONVERT(malla_detalle.descripcion, UNSIGNED)"))->where('malla_detalle.malla_id',$id)->orderBy('malla_detalle.id', 'desc')->get();
      return view('livewire.mallas.malla-colectivos', compact('colectivos','niveles','malla_detalle','malla'));
      
    }

    public function storeColectivos(Request $request){
      
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required',
            'nivel' => 'required|max:25',
            'malla_id' => 'required',            
           
        ]);
        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        if (!$request->id) {
            $malla_detalle = new MallaDetalle();
            $malla_detalle->descripcion = $request->descripcion;
            $malla_detalle->nivel = $request->nivel;
            $malla_detalle->malla_id = $request->malla_id;
            $malla_detalle->estado = 1;
            

            if ($malla_detalle->save()) {
                
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Incorporacion de colectivo ' . $request->descripcion . ' en la malla-detalle '.$malla_detalle->id.' plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],

                ]);
                $datos = MallaDetalle::select(['malla_detalle.id','malla_detalle.descripcion','malla_detalle.nivel', 'malla_detalle.estado','malla_detalle.malla_id','colectivos.colectivo'])->join('colectivos','colectivos.id','=',DB::raw("CONVERT(malla_detalle.descripcion, UNSIGNED)"))->where('malla_detalle.malla_id',$request->malla_id)->orderBy('malla_detalle.id', 'desc')->get();
                return response()->json(['success' => true, 'message' => 'Colectivo Incluida', 'datos' => $datos]);
            }

        }else{

            $malla_detalle = MallaDetalle::findOrFail($request->id);
            $malla_detalle->descripcion = $request->descripcion;
            $malla_detalle->nivel = $request->nivel;
            $malla_detalle->malla_id = $request->malla_id;
            
            if ($malla_detalle->save()) {
                
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacion de colectivo ' . $request->descripcion . ' en la malla-detalle '.$malla_detalle->id.' plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],

                ]);
                $datos = MallaDetalle::select(['malla_detalle.id','malla_detalle.descripcion','malla_detalle.nivel', 'malla_detalle.estado','malla_detalle.malla_id','colectivos.colectivo'])->join('colectivos','colectivos.id','=',DB::raw("CONVERT(malla_detalle.descripcion, UNSIGNED)"))->where('malla_detalle.malla_id',$request->malla_id)->orderBy('malla_detalle.id', 'desc')->get();
                return response()->json(['success' => true, 'message' => 'Colectivo Actualizado', 'datos' => $datos]);
            }
           

        }



    }
    public function editColectivo($id){
        $malla_detalle = MallaDetalle::findOrFail($id);
         return response()->json(['data' => $malla_detalle]);
    }
    public function deleteMallaColectivo($id){
              
        $malla_detalle = MallaDetalle::findOrFail($id);      
        $malla_asignaturas = MallaAsignatura::where('malla_det_id',$malla_detalle->id);   
        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones'=> 'Eliminación de asignatura-detalle '. $malla_detalle->id .' en la plataforma',
            'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
            
        ]);
        if($malla_asignaturas->get()){
            $malla_asignaturas->delete();
        }
         $malla_detalle->delete();      
         return response()->json(['success'=>true,'message'=>'Colectivo Eliminado del Programa']); 
   }
    public function mallaAsignaturas($id, $area_id)
    {
        
        if ($area_id == 2) {
            $asignaturas = Asignatura::where('area_id',$area_id)->Orwhere('area_id',5)->where('estado',1)->get();
            $malla_programa = Malla::select(['malla.cualificacion', 'malla.resolucion', 'malla.duracion', 'malla.horas', 'malla.id','malla.numero_cualificacion', 'programas.programa as nombre_programa', 'programas.area_id', 'malla_detalle.id as detalle_id', 'malla_detalle.descripcion', 'malla_detalle.nivel', 'colectivos.colectivo'])->join('programas', 'programas.id', '=', 'malla.programa_id')->join('malla_detalle','malla_detalle.malla_id', '=', 'malla.id')->join('colectivos','colectivos.id','=',DB::raw("CONVERT(malla_detalle.descripcion, UNSIGNED)"))->where('malla_detalle.id', $id)->get();            
            $malla_detalleAsigna = MallaAsignatura::select(['malla_asignatura.id','malla_asignatura.modalidad', 'malla_asignatura.horas','asignaturas.codigo', 'asignaturas.asignatura', 'asignaturas.creditos'])->join('asignaturas', 'asignaturas.id', '=', 'malla_asignatura.asignatura_id')->where('malla_asignatura.malla_det_id', $id)->get();
            return view('livewire.mallas.malla-asignaturas-colectivos', compact('asignaturas','malla_programa','malla_detalleAsigna'));

        } else {
            $asignaturas = Asignatura::where('area_id',$area_id)->Orwhere('area_id',5)->where('estado',1)->get();
            $malla_programa = Malla::select(['malla.cualificacion', 'malla.resolucion', 'malla.duracion', 'malla.horas', 'malla.id','malla.numero_cualificacion', 'programas.programa as nombre_programa', 'programas.area_id', 'malla_detalle.id as detalle_id', 'malla_detalle.descripcion', 'malla_detalle.nivel'])->join('programas', 'programas.id', '=', 'malla.programa_id')->join('malla_detalle','malla_detalle.malla_id', '=', 'malla.id')->where('malla.id', $id)->get();           
            $malla_detalleAsigna = MallaAsignatura::select(['malla_asignatura.id','malla_asignatura.modalidad', 'malla_asignatura.horas','asignaturas.codigo', 'asignaturas.asignatura', 'asignaturas.creditos'])->join('asignaturas', 'asignaturas.id', '=', 'malla_asignatura.asignatura_id')->where('malla_asignatura.malla_det_id', $malla_programa[0]->detalle_id)->get();
           
            return view('livewire.mallas.malla-asignaturas', compact('asignaturas','malla_programa','malla_detalleAsigna'));
              
       }
    }
    public function storeAsignatura(Request $request){
      
        $validator = Validator::make($request->all(), [
            'asignatura_id' => 'required',
            'modalidad' => 'required|max:25',
            'malla_detalle_id' => 'required',
            'horas' => 'digits_between:1,4',
           
        ]);
        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        if (!$request->id) {
            $malla_asignatura = new MallaAsignatura();
            $malla_asignatura->malla_det_id = $request->malla_detalle_id;
            $malla_asignatura->asignatura_id = $request->asignatura_id;
            $malla_asignatura->horas = $request->horas;
            $malla_asignatura->modalidad = $request->modalidad;

            if ($malla_asignatura->save()) {
                
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Incorporacion de asignatura en malla-detalle ' . $request->malla_detalle_id . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],

                ]);
                $datos = MallaAsignatura::select(['malla_asignatura.id','malla_asignatura.modalidad', 'malla_asignatura.horas','asignaturas.codigo', 'asignaturas.asignatura', 'asignaturas.creditos'])->join('asignaturas', 'asignaturas.id', '=', 'malla_asignatura.asignatura_id')->where('malla_asignatura.malla_det_id', $request->malla_detalle_id)->get();
                return response()->json(['success' => true, 'message' => 'Asignatura Incluida', 'datos' => $datos]);
            }

        }else{

            $malla_asignatura = MallaAsignatura::findOrFail($request->id);
            $malla_asignatura->malla_det_id = $request->malla_detalle_id;
            $malla_asignatura->asignatura_id = $request->asignatura_id;
            $malla_asignatura->horas = $request->horas;
            $malla_asignatura->modalidad = $request->modalidad;
            
            if ($malla_asignatura->save()) {
                
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacion de asignatura en malla-detalle ' . $request->malla_detalle_id . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],

                ]);
                $datos = MallaAsignatura::select(['malla_asignatura.id','malla_asignatura.modalidad', 'malla_asignatura.horas','asignaturas.codigo', 'asignaturas.asignatura', 'asignaturas.creditos'])->join('asignaturas', 'asignaturas.id', '=', 'malla_asignatura.asignatura_id')->where('malla_asignatura.malla_det_id', $request->malla_detalle_id)->get();
                return response()->json(['success' => true, 'message' => 'Asignatura Actualizada', 'datos' => $datos]);
            }
           

        }



    }

    public function editAsignatura($id){
        $malla_asignatura = MallaAsignatura::findOrFail($id);
         return response()->json(['data' => $malla_asignatura]);
       }
       public function deleteMallaAsignatura($id){
              
        $malla_asignaturas = MallaAsignatura::findOrFail($id);     
        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones'=> 'Eliminación de asignatura-malla '. $malla_asignaturas->id .' en la plataforma',
            'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
            
        ]);
        
         $malla_asignaturas->delete();      
         return response()->json(['success'=>true,'message'=>'Asignatura Eliminado del Programa']); 
   }
}
