<?php

namespace App\Http\Controllers;
use App\Horario;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class HorarioController extends Controller
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

	function mostrarHorarios(Request $request){
		$horario=Horario::all();
		return response()->Json($horario,200);
	}

	function createHorario(Request $request){
		if($request->isJson()){
			try {
				$data=$request->Json()->all();
				$userexist=User::where("id", $data['user_id'])->exists();

				if($userexist==FALSE){
					return response()->Json(['error'=>'no se encuetra el usuario'],404);
				}

				$horario=Horario::create([
				'user_id' => $data['user_id'],
				'dia' =>$data['dia'],
				'hora' =>$data['hora']
			     ]);

				return response()->Json([$horario,'status'=>true,'exitoso'],201);

			} catch (ModelNotFoundException $e) {
				return response()->Json([$e, 'error'=>'surgio algun error'],406);
			}

		}else {
			return response()->Json(['status'=>false,'error'=>'no es formato Json'],401);
		}
	}
	function updateHorario(Request $request,$id){
		if($request->isJson()){

			try {
				$data=$request->Json()->all();
				$horario=Horario::findOrFail($id);

				$horario->user_id=$data['user_id'];
				$horario->dia=$data['dia'];
				$horario->hora=$data['hora'];

				$item->save();
				return response()->json(['status'=>true,'exitoso'=>'horario actualizado'], 200);
			} catch (ModelNotFoundException $e) {
				return response()->json(['error' => 'No se encuentra el horario'], 406);
			}

		}else {
			return response()->json(['error' => 'No es formato Json'], 401);
		}
	}

	function deleteHorario(Request $request, $user_id){
		if($request->isJson()){
			try {
				//$horario=Horario::findOrFail($user_id);
				$horario=Horario::where('user_id', $user_id);
				$horario->delete();
				return response()->json(['status'=>true,'exitoso'=>'horario eliminado'], 200);
			} catch (ModelNotFoundException $e) {
				return response()->json(['error' => 'No se encuentra el horario'], 406);
			}

		}else {
			return response()->json(['error' => 'No es formato Json'], 401);
		}
	}

	function findHorario(Request $request, $user_id){
		if($request->isJson()){
			try {
			$horario=Horario::where('user_id', $user_id)->get(); //verifico si el user_id de la BD= a de la ruta
			return response()->json($horario,200);

		} catch (ModelNotFoundException $e) {
				return response()->json(['error' => 'No se encuentra el horario'], 406);
			}
		}else {
			return response()->json(['error' => 'No es formato Json'], 401);
		}
	}

	function findDayHorario(Request $request, $user_id){
		if($request->isJson()){
			try {
				$data=$request->json()->all();
				$horario=Horario::where([
                    ['user_id', '=', $user_id],
                    ['dia', '=', $data['dia']]
                ])->get();
				return response()->json($horario,200);
			} catch (ModelNotFoundException $e) {
				return response()->json(['error' => 'No se encuentra el horario'], 406);
			}

		}else {
			return response()->json(['error' => 'No es formato Json'], 401);
		}

	}

    //
}
