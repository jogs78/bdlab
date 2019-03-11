<?php

namespace App\Http\Controllers;
use App\Item;
use App\Pc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class PcsController extends Controller
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

	function mostrarPcs(Request $request){
		$pc=Pc::all();
		return response()->Json($pc,200);
	}

	function createPc(Request $request){
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

			$pc=DB::table('pcs')->insert([
				'item_id' => $item['id'],
				'num_maquina'=>$data['num_maquina'],
				'tiene_camara'=>$data['tiene_camara'],
				'tiene_bocinas'=>$data['tiene_bocinas'],
				'num_serie_cpu'=>$data['num_serie_cpu'],
				'ram'=>$data['ram'],
				'disco_duro'=>$data['disco_duro'],
				'sistema_operativo'=>$data['sistema_operativo'],
				'sistema_operativo_activado'=>$data['sistema_operativo_activado'],
				'cable_vga'=>$data['cable_vga'],
			    'tiene_monitor'=>$data['tiene_monitor'],
			    'num_serie_monitor'=>$data['num_serie_monitor'],
			    'tiene_teclado'=>$data['tiene_teclado'],
			    'tiene_raton'=>$data['tiene_raton'],
			    'controlador_red'=>$data['controlador_red'],
			    'paq_office_version'=>$data['paq_office_version'],
			    'paq_office_activado'=>$data['paq_office_activado'],
			    'observaciones'=>$data['observaciones']]);

				return response()->Json([$pc,'status'=>true,'exitoso'],201);

			} catch (ModelNotFoundException $e) {
				return response()->Json([$e, 'error'=>'surgio algun error'],406);
			}

		}else {
			return response()->Json(['status'=>false,'error'=>'no es formato Json'],401);
		}
	}

	function updatePc(Request $request, $item_id){
		if($request->isJson()){
			try {
				$data=$request->Json()->all();

	     		$pc=Pc::findOrFail($item_id);

				$pc->num_maquina=$data['num_maquina'];
				$pc->perifericos=$data['perifericos'];
				$pc->funciona=$data['funciona'];
				$pc->num_serie_cpu=$data['num_serie_cpu'];
				$pc->ram=$data['ram'];
				$pc->disco_duro=$data['disco_duro'];
				$pc->sistema_operativo=$data['sistema_operativo'];
				$pc->sistema_operativo_activado=$data['sistema_operativo_activado'];
				$pc->cable_vga=$data['cable_vga'];
			    $pc->funciona_monitor=$data['funciona_monitor'];
			    $pc->detalle_monitor=$data['detalle_monitor'];
			    $pc->num_serie_monitor=$data['num_serie_monitor'];
			    $pc->detalle_teclado=$data['detalle_teclado'];
			    $pc->detalle_raton=$data['detalle_raton'];
			    $pc->controlador_red=$data['controlador_red'];
			    $pc->paq_office_version=$data['paq_office_version'];
			    $pc->paq_office_activado=$data['paq_office_activado'];
			    $pc->observaciones=$data['observaciones'];


				$pc->save();
				return response()->json(['status'=>true,'exitoso'=>'pc actualizado'], 200);
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
