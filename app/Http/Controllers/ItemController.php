<?php

namespace App\Http\Controllers;
use App\Item;
use App\Pc;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ItemController extends Controller
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

	function mostrarItems(Request $request){
		$item=Item::all();
		return response()->Json($item,200);
	}

	function createItem(Request $request){
		if($request->isJson()){
			try {
				$data=$request->Json()->all();
				$item=Item::create([
				'clasificacion' => $data['clasificacion'],
				'descripcion' =>$data['descripcion'],
				'modelo' =>$data['modelo'],
				'estado'=> $data['estado'],
				'marca' =>$data['marca'],
				'path' =>$data['path'],
				'numero_inventario'=>$data['numero_inventario'],
				'numero_serie'=>$data['numero_serie']
			     ]);

				return response()->Json([$item,'status'=>true,'exitoso'],201);

			} catch (ModelNotFoundException $e) {
				return response()->Json([$e, 'error'=>'surgio algun error'],406);
			}

		}else {
			return response()->Json(['status'=>false,'error'=>'no es formato Json'],401);
		}
	}
	function updateItem(Request $request,$id){
		if($request->isJson()){

			try {
				$data=$request->Json()->all();
				$item=Item::findOrFail($id);

				$item->clasificacion=$data['clasificacion'];
				$item->descripcion=$data['descripcion'];
				$item->modelo=$data['modelo'];
				$item->estado=$data['estado'];
				$item->marca=$data['marca'];
				$item->path=$data['path'];
				
				$item->save();
				return response()->json(['status'=>true,'exitoso'=>'item actualizado'], 200);
			} catch (ModelNotFoundException $e) {
				return response()->json(['error' => 'No se encuentra el item'], 406);
			}

		}else {
			return response()->json(['error' => 'No es formato Json'], 401);
		}
	}

	function deleteItem(Request $request, $id){
		if($request->isJson()){
			try {
				$item=Item::findOrFail($id);
				$item->delete();
				return response()->json(['status'=>true,'exitoso'=>'item eliminado'], 200);
			} catch (ModelNotFoundException $e) {
				return response()->json(['error' => 'No se encuentra el item'], 406);
			}

		}else {
			return response()->json(['error' => 'No es formato Json'], 401);
		}
	}

    //
}
