<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Programa;
use App\Models\Malla;
use App\Models\MallaDetalle;
use App\Models\MallaAsignatura;
use Illuminate\Validation\Rule;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Validator;

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
        return ' hola en colectivos';
    }
    public function mallaAsignaturas($id, $area_id)
    {
        return 'HOLA EN ASIGNATURAS';
        if ($area_id == 2) {
            //malla detalle_id 
            //query con where a malla_Asignatura
        } else {
            //malla_id
            //inner join malla detalle id y asignaturas
        }
    }
}
