<?php

namespace App\Http\Controllers;
use App\Lugar;
use App\Item;
use App\Item_Lugar;
use Illuminate\Http\Request;;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ExistenciaController extends Controller
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

	function createExistencia(Request $request){
		if($request->isJson()){
			try {
				$data=$request->json()->all();
				$existlugar=Lugar::where("id", $data['lugar_id'])->exists();
				$existitem=Item::where("id", $data['item_id'])->exists();
				if($existlugar==FALSE && $existitem==FALSE){
					return response()->Json(['error'=>'no se encuentra el lugar o el item'],404);
				}
				$lugar=Lugar::find($data['lugar_id']);
				$lugar->items()->attach($data['item_id']);

			    return response()->Json([$lugar,'status'=>true,'exitoso'],201);

			} catch (ModelNotFoundException $e) {
				return response()->Json([$e, 'error'=>'surgio algun error'],406);
			}

		}else {
			return response()->Json(['status'=>false,'error'=>'no es formato Json'],401);
		}
	}

	/*function mostrarExistencia(Request $request){
		$existencia=Existencia::all();
		return response()->json($existencia,200);
	}*/

	function findLugarExistencia(Request $request, $lugar_id){
		if($request->isJson()){
			try {
				$existlugar=Lugar::where("id", $lugar_id)->exists();

				if($existlugar==FALSE ){
					return response()->Json(['error'=>'no se encuentra el lugar '],404);
				}
				//en esta parte obtengo los items que se encuentran en u sala especifica pero solo el id de los items
				$existencia=Lugar::find($lugar_id);
				$existencia->items;
				/*foreach ($existencia->items as $item) {
    				$salida[]= $item->pivot->item_id;
				}*/
				return response()->json($existencia,200);
			} catch (ModelNotFoundException $e) {
				return response()->json(['error' => 'No se encuentra el lugar'], 406);
			}
		}else {
			return response()->Json(['status'=>false,'error'=>'no es formato Json'],401);
		}
	}
    //
}
