<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instrumento;
use App\Models\Colectivo;
use Illuminate\Support\Facades\DB;
use App\Models\Auditoria;
use Illuminate\Support\Facades\Validator;

class InstrumentosController extends Controller
{
    public function index()
    {
        $instrumentos = $this->cargarDatos();
        $colectivos = Colectivo::all();
        return view('livewire.instrumentos.index', compact('instrumentos', 'colectivos'));
    }

    private function cargarDatos()
    {
        return Instrumento::select('instrumentos.id', 'instrumentos.instrumento','colectivos.colectivo')
            ->join('colectivos', 'instrumentos.colectivo_id','=','colectivos.id')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'instrumento' => 'required|max:50|unique:instrumentos,instrumento,'. $request->id,
            'colectivo_id'=> 'required|'
        ]);

        if ($validator->fails()) {
            //devuelve errores a la vista
            return response()->json(['success' => false, 'errors' => $validator->errors()->all()]);
        }

        if (!$request->id) {
            $instrumentos = new Instrumento();
            $instrumentos->instrumento = $request->instrumento;
            $instrumentos->colectivo_id = $request->colectivo_id;
            if ($instrumentos->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Creacion de instrumento ' . $request->instrumento . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);

                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Instrumento Creado', 'datos' => $datos]);
            }
        } else {
            $instrumentos = Instrumento::findOrFail($request->id);
            $instrumentos->instrumento = $request->instrumento;
            $instrumentos->colectivo_id = $request->colectivo_id;
            if ($instrumentos->save()) {
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones' => 'Actualizacion de instrumento ' . $request->area . ' en la plataforma',
                    'direccion_ip' => $_SERVER['REMOTE_ADDR'],
                ]);
                $datos = $this->cargarDatos();
                return response()->json(['success' => true, 'message' => 'Instrumento Actualizado', 'datos' => $datos]);
            }
        }
    }

    public function edit($id)
    {
        $instrumentos = Instrumento::findOrFail($id);
        return response()->json(['data' => $instrumentos]);
    }

    public function delete($id)
    {
        $instrumentos = Instrumento::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de instrumento ' . $instrumentos->instrumento . ' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $instrumentos->delete();

        return response()->json(['success' => true, 'message' => 'Instrumento Eliminado']);
    }
}
