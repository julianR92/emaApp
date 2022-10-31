<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesor;
use Illuminate\Support\Facades\Validator;
use App\Models\Auditoria;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Notificaciones;


class ProfesorController extends Controller
{
    public function index(){

        $docentes = Profesor::all();     
        return view('livewire.profesores.index',compact('docentes'));        
       }

    public function create(){
        $titulo = 'Creación de docentes';
        $butttonMessage = 'Crear Docente';
        return view('livewire.profesores.create', compact('titulo','butttonMessage'));
    }

    public function store(Request $request){ 
        
        $validator = Validator::make($request->all(), [
            'nombres' => 'required|max:15',
            'apellidos' => 'required|max:15',
            'tipo_doc' => 'required',
            'documento' => 'required|max:15|unique:docentes,documento,'. $request->id,
            'celular'=>'digits_between:7,10',
            'correo'=>['required','unique:docentes,correo,'. $request->id,'unique:users,email,'. $request->user_id],
            

        ]);
    
        if($validator->fails()){
            //devuelve errores a la vista
         return response()->json([ 'success'=>false,'errors'=>$validator->errors()->all()]);
        }
       
    
        if(!$request->id){
           
            $password = $this->generateRandomString();

            $username = new User();
            $username->first_name = $request->nombres;
            $username->last_name = $request->apellidos;
            $username->email  = $request->correo;      
            $username->number= $request->celular;
            $username->password = Hash::make($password);
            $username->role_id = 3;
            $username->city = 'BUCARAMANGA';
            $username->estado   = 1;           
             if($username->save()){
                $username->assignRole(3);
                $docente = new Profesor();
                $docente->nombres = $request->nombres;
                $docente->apellidos = $request->apellidos;
                $docente->tipo_doc = $request->tipo_doc;
                $docente->documento = $request->documento;
                $docente->celular = $request->celular;
                $docente->correo = $request->correo;
                $docente->profesion = $request->profesion;
                $docente->user_id = $username->id;
                $docente->save();
                
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones'=> 'Creacion de Docente '.$request->nombres.' '.$request->apellidos.' en la plataforma',
                    'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
        
                ]);
                $detalleCorreo = [
                    'name' => $request->nombres, 
                    'usuario'=> $request->correo, 
                    'password'=>$password,         
                    'Subject' => 'Notificacion de Registro en Aplicativo EMA',
                    'modulo'=>'I'                    
                          
                ];
                Mail::to($request->correo)->queue(new Notificaciones($detalleCorreo));
                return response()->json(['success'=>true,'message'=>'Docente Creado']);   
    
             }
        }else{

            $username = User::findOrFail($request->user_id);
            $username->first_name = $request->nombres;
            $username->last_name = $request->apellidos;
            $username->email  = $request->correo;      
            $username->number= $request->celular;
            if($username->save()){
               
                $docente = Profesor::findOrFail($request->id);
                $docente->nombres = $request->nombres;
                $docente->apellidos = $request->apellidos;
                $docente->tipo_doc = $request->tipo_doc;
                $docente->documento = $request->documento;
                $docente->celular = $request->celular;
                $docente->correo = $request->correo;
                $docente->profesion = $request->profesion;               
                $docente->save();
                
                $auditoria = Auditoria::create([
                    'usuario' => auth()->user()->first_name,
                    'correo' => auth()->user()->email,
                    'observaciones'=> 'Actualizacion de Docente '.$request->nombres.' '.$request->apellidos.' en la plataforma',
                    'direccion_ip'=> $_SERVER['REMOTE_ADDR'],           
        
                ]);
                
                return response()->json(['success'=>true,'message'=>'Docente Actualizado']);   
    
             }
    
        }
    
    
      }

      public function edit($id){
        $datos = Profesor::findOrFail($id);
        $titulo = 'Actualizacion de docentes';
        $butttonMessage = 'Actualizar Docente';
        return view('livewire.profesores.create', compact('titulo','butttonMessage','datos'));
      }

      public function delete($id)
    {
        $docente = Profesor::findOrFail($id);

        $auditoria = Auditoria::create([
            'usuario' => auth()->user()->first_name,
            'correo' => auth()->user()->email,
            'observaciones' => 'Eliminación de docente '.$docente->nombres.' '.$docente->apellidos.' en la plataforma',
            'direccion_ip' => $_SERVER['REMOTE_ADDR'],
        ]);
        $user = User::findOrFail($docente->user_id);
        $docente->delete();
        if($user){
            $user->delete();
        }

        return response()->json(['success' => true, 'message' => 'Docente Eliminado']);
    }

      function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
}
