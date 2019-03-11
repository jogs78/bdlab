<?php

namespace App\Http\Controllers;
use App\User;
use App\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

	function mostrarUsers(Request $request){
		$user=User::all();
		return response()->Json($user,200);
	}

	function createUser(Request $request){
		if($request->isJson()){
			try {
				$data=$request->Json()->all();
				$user=User::create([
				'nombre' => $data['nombre'],
				'apellido' =>$data['apellido'],
				'telefono' =>$data['telefono'],
				'horas_cubrir'=> $data['horas_cubrir'],
				'tipo_usuario' =>$data['tipo_usuario'],
				'email' =>$data['email'],
				'numcontrol'=> $data['numcontrol'],
				'password'=> Hash::make($data['password'])
			     ]);
				return response()->Json([$user,'status'=>true,'exitoso'],201);

			} catch (ModelNotFoundException $e) {
				return response()->Json([$e, 'error'=>'surgio algun error'],406);
			}

		}else {
			return response()->Json(['status'=>false,'error'=>'no es formato Json'],401);
		}
	}
	function updateUser(Request $request,$id){
		if($request->isJson()){

			try {
				$data=$request->Json()->all();
				$user=User::findOrFail($id);

				$user->nombre=$data['nombre'];
				$user->apellido=$data['apellido'];
				$user->telefono=$data['telefono'];
				$user->horas_cubrir=$data['horas_cubrir'];
				$user->tipo_usuario=$data['tipo_usuario'];
				$user->email=$data['email'];
				$user->username=$data['numcontrol'];

				$user->save();
				return response()->json(['status'=>true,'exitoso'=>'usuario actualizado'], 200);
			} catch (ModelNotFoundException $e) {
				return response()->json(['error' => 'No se encuentra el usuario'], 406);
			}

		}else {
			return response()->json(['error' => 'No es formato Json'], 401);
		}
	}
	function deleteUser(Request $request, $id){
		if($request->isJson()){
			try {
				$user=User::findOrFail($id);
				$user->delete();
				return response()->json(['status'=>true,'exitoso'=>'usuario eliminado'], 200);
			} catch (ModelNotFoundException $e) {
				return response()->json(['error' => 'No se encuentra el usuario'], 406);
			}

		}else {
			return response()->json(['error' => 'No es formato Json'], 401);
		}
	}
	function login(Request $request){
		if($request->isJson()){
			try {
				$data=$request->Json()->all();
				$user=User::where('numcontrol', $data['numcontrol'])->first();

				if($user && Hash::check($data['password'],$user->password)){
					return response()->Json(['status'=>true,'exito'=>'usuario autenticado'],200);
				}else {
					return response()->Json(['status'=>false,'error'=>'datos incorrectos'],406);
				}
			} catch (ModelNotFoundException $e) {
				return response()->Json(['status'=>false,'error'=>'No se encuentra'],406);
			}
		}else {
			return response()->Json(['status'=>false,'error'=>'No es Json'],401);
		}
	}

	function loginLog(Request $request){
		if($request->isJson()){
			try {
				$data=$request->Json()->all();
				$user=User::where('email', $data['email'])->first();

				if($user && Hash::check($data['password'],$user->password)){
					DB::table('logs')->insert(
    				['user_id' => $user['id'], 'accion' => 'inicio con movil']);

					return response()->Json($user,200);
				}else {
					return response()->Json(['status'=>false,'error'=>'datos incorrectos'],406);
				}
			} catch (ModelNotFoundException $e) {
				return response()->Json(['status'=>false,'error'=>'No se encuentra'],406);
			}
		}else {
			return response()->Json(['status'=>false,'error'=>'No es Json'],401);
		}
	}

	function fechaHora(){
		ini_set('date.timezone','America/Mexico_City');
		$time = date("Y-m-d (H:i:s)", time());
		return $time;
	}

    //
}
