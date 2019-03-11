<?php

namespace App\Http\Controllers;
use App\Lugar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class PlantillaController extends Controller
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

	function mostrarPlantilla(Request $request){
		//$plantilla=Plantilla::all();
		$plantilla=DB::table('plantillas')->select('*')->orderBy('lugar_id', 'asc')->get();;
		return response()->Json($plantilla,200);
	}

	function createPlantilla(Request $request, $lugar_id){
		//if($request->isJson()){
		//	try {
				$existlugar=Lugar::where("id", $lugar_id)->exists();

				if($existlugar==FALSE){
					return response()->Json(['error'=>'no se encuetra el lugar'],404);
				}
				//primero debo realizar las consultas de acuerdo a  cada cladificacion para obtener la cantidad de las items.....
				$plantilla=DB::table('plantillas')->select('clasificacion','cantidad')->where([
				    ['plantillas.lugar_id', '=', $lugar_id],
				    ['plantillas.cantidad', '>', '0'],
				])->get();

				return response()->Json($plantilla,201);

		//	} catch (ModelNotFoundException $e) {
		//		return response()->Json([$e, 'error'=>'surgio algun error'],406);
		//	}

		//}else {
		//	return response()->Json(['status'=>false,'error'=>'no es formato Json'],401);
		//}
	}



    //
}
