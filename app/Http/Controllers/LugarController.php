<?php

namespace App\Http\Controllers;
use App\Lugar;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class LugarController extends Controller
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

	function mostrarLugares(Request $request){
		$lugar=Lugar::all();
		return response()->Json($lugar,200);
	}

	function createLugar(Request $request){
		if($request->isJson()){
			try {
				$data=$request->Json()->all();
				$lugar=Lugar::create([
				'nombre' => $data['nombre'],
			     ]);
				return response()->Json([$lugar,'status'=>true,'exitoso'],201);

			} catch (ModelNotFoundException $e) {
				return response()->Json([$e, 'error'=>'surgio algun error'],406);
			}

		}else {
			return response()->Json(['status'=>false,'error'=>'no es formato Json'],401);
		}
	}
	function updateLugar(Request $request,$id){
		if($request->isJson()){

			try {
				$data=$request->Json()->all();
				$lugar=Lugar::findOrFail($id);

				$lugar->nombre=$data['nombre'];
				$lugar->save();
				return response()->json(['status'=>true,'exitoso'=>'lugar actualizado'], 200);
			} catch (ModelNotFoundException $e) {
				return response()->json(['error' => 'No se encuentra el lugar'], 406);
			}

		}else {
			return response()->json(['error' => 'No es formato Json'], 401);
		}
	}
	function deleteLugar(Request $request, $id){
		if($request->isJson()){
			try {
				$lugar=Lugar::findOrFail($id);
				$lugar->delete();
				return response()->json(['status'=>true,'exitoso'=>'Lugar eliminado'], 200);
			} catch (ModelNotFoundException $e) {
				return response()->json(['error' => 'No se encuentra el Lugar'], 406);
			}

		}else {
			return response()->json(['error' => 'No es formato Json'], 401);
		}
	}

	function findmaquinas(Request $request, $lugar_id){
		//if($request->isJson()){
			try {
			$lugarexist=Lugar::where("id", $lugar_id)->exists();

			if($lugarexist==FALSE){
				return response()->Json(['error'=>'no se encuetra el lugar'],404);
			}
                        

/*select item_lugar.lugar_id, lugars.nombre, pcs.num_maquina from item_lugar inner join lugars, pcs where item_lugar.lugar_id=lugars.id and pcs.item_id=item_lugar.item_id;*/
			$maquinas= DB::table('item_lugar')->join('lugars', 'lugars.id', '=', 'item_lugar.lugar_id')->join('pcs', 'pcs.item_id', '=', 'item_lugar.item_id')->join('items','pcs.item_id','=','items.id')->select('item_lugar.lugar_id', 'lugars.nombre','item_lugar.item_id','pcs.num_maquina','items.marca','items.modelo')->where("lugar_id",$lugar_id)->get();

			return response()->json($maquinas,200);

			} catch (ModelNotFoundException $e) {
				return response()->json(['error' => 'No se encuentra el Lugar'], 406);
			}

		//}else {
		//	return response()->json(['error' => 'No se formato Json'], 406);
		//}
	}

    //
}
