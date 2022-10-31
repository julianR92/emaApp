<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eje;
use App\Models\Proceso;
use App\Models\Colectivo;
use Illuminate\Support\Facades\DB;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Validator;

class ColectivoController extends Controller
{
    public function index()
    {
        $colectivos = $this->cargarDatos();
        return view('livewire.colectivos.index', compact('colectivos'));
    }

    private function cargarDatos()
    {
        return Colectivo::select('id', 'colectivo')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'colectivo' => 'required|max:30|unique:colectivos,colectivo,'. $request->id,
        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        if (!$request->id) {
            $colectivos = new Colectivo();
            $colectivos->colectivo = $request->colectivo;
            if ($colectivos->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de colectivo ' . $request->colectivo . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Colectivo Creado', 'datos' => $datos]);
            }
        } else {
            $colectivos = Colectivo::findOrFail($request->id);
            $colectivos->colectivo = $request->colectivo;
            if ($colectivos->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacion de eje ' . $request->colectivo . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);
                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Colectivo Actualizado', 'datos' => $datos]);
            }
        }
    }

    public function edit($id)
    {
        $colectivos = Colectivo::findOrFail($id);
        return response()->json(['data' => $colectivos]);
    }

    public function delete($id)
    {
        $colectivos = Colectivo::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de colectivo ' . $colectivos->colectivo . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $colectivos->delete();

        return response()->json(['success' => true, 'message' => 'Colectivo Eliminado']);
    }
}
