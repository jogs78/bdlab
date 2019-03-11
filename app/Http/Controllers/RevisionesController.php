<?php

namespace App\Http\Controllers;
use App\Pc;
use App\Lugar;
use App\User;
use App\Revision;
use App\Revision_Detallada;
use App\Revision_Rapida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class RevisionesController extends Controller
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

	function mostrarRapidas(Request $request){
		//$plantilla=Plantilla::all();
		$plantilla=Revision_Rapida::all();
		return response()->Json($plantilla,200);
	}

	function createRevisonRapida(Request $request, $lugar_id, $user_id){
		if($request->isJson()){
			try {
				$data=$request->Json()->all();

				$existlugar=Lugar::where("id", $lugar_id)->exists();
				$existuser=User::where("id",$user_id)->exists();
				if($existlugar==FALSE && $existuser==FALSE){
					return response()->Json(['error'=>'no se encuentra el lugar o el usuario'],404);
				}
	        //return response()->Json($data,201);
				$revision=Revision::create([
					'user_id'=> $user_id,
					'tipo'=>'rapida.',
					'lugar_id'=> $lugar_id,
				]);
				/*for ( $i=0; $i<=$data; $i++ ){
					$rapidas=$data[$i];
					($i+1);
					$revisionRapida=DB::table('revision_rapidas')->insert([
								'revision_id' => $revision['id'],
								'clasificacion'=>$rapidas['clasificacion'],
								'cantidad'=>$rapidas['cantidad'],
								'observaciones'=>$rapidas['observaciones'],
								'momento'=>$rapidas['momento']]
								);


			   }*/

				 foreach ($data as $rapidas ) {
					 $revisionRapida=DB::table('revision_rapidas')->insert([
 						'revision_id' => $revision['id'],
 						'clasificacion'=>$rapidas['clasificacion'],
 						'cantidad'=>$rapidas['cantidad'],
 						'observaciones'=>$rapidas['observaciones'],
 					    'momento'=>$rapidas['momento']]);
				 }

				 /*
				 este de la forma del formato
				 {"Rapidas:"[
				   //los objetos
			     ]}
				 foreach ($data['rapidas'] as $rapidas ) {
					$revisionRapida=DB::table('revision_rapidas')->insert([
					   'revision_id' => $revision['id'],
					   'clasificacion'=>$rapidas['clasificacion'],
					   'cantidad'=>$rapidas['cantidad'],
					   'observaciones'=>$rapidas['observaciones'],
					   'momento'=>$rapidas['momento']]);
				}*/

				return response()->Json(['r'=>'revision rapida registrada'],201);

			} catch (ModelNotFoundException $e) {
				return response()->Json([$e, 'error'=>'surgio algun error'],406);
			}

		}else {
			return response()->Json(['status'=>false,'error'=>'no es formato Json'],401);
		}
	}

	function createRevisonRapida1(Request $request, $lugar_id, $user_id, $momento, $observaciones){
		if($request->isJson()){
			try {
				$data=$request->Json()->all();

				$existlugar=Lugar::where("id", $lugar_id)->exists();
				$existuser=User::where("id",$user_id)->exists();
				if($existlugar==FALSE && $existuser==FALSE){
					return response()->Json(['error'=>'no se encuentra el lugar o el usuario'],404);
				}
				
				$observaciones=  str_replace("%20"," ",$observaciones);

				$revision=Revision::create([
					'user_id'=> $user_id,
					'lugar_id'=> $lugar_id,
					'tipo'=>'rapida',
					'momento'=>$momento,
					'observaciones'=>$observaciones,
				]);



				 foreach ($data as $rapidas ) {
					   $revisionRapida=DB::table('revision_rapidas')->insert([
 						'revision_id' => $revision['id'],
 						'clasificacion'=>$rapidas['clasificacion'],
 						'cantidad'=>$rapidas['cantidad']]);
				 }
				//return response()->Json(['r'=>'revision rapida registrada'],201); descomentar
				return response()->Json(['status'=>'revision rapida registrad exitosamente'],201);

			} catch (ModelNotFoundException $e) {
				return response()->Json([$e, 'error'=>'surgio algun error'],406);
			}
		}else {
			return response()->Json(['status'=>false,'error'=>'no es formato Json'],401);
		}
	}

	/*function createRevisonDetallada1(Request $request, $lugar_id, $item_id, $user_id, $momento){
		if($request->isJson()){
			try {
				$data=$request->Json()->all();
				$existlugar=Lugar::where("id", $lugar_id)->exists();
				$existuser=User::where("id",$user_id)->exists();
				$existPc=Pc::where("item_id",$item_id)->exists();

				//verificar si el item_id de la ruta se encuentra en la tabla item_lugar de la BD y se encunetra en la sala correcta
   //pendientee esta parteeee aunn-....
				//$item_coincide=DB::table('item_lugar')->where([['lugar_id', '=', $lugar_id],['item_id', '=',

		        if($existlugar==FALSE && $existuser==FALSE && $existPc==FALSE ){
					return response()->Json(['error'=>'no se encuentra el lugar o el maquina o no se'],404);
				}

				$revision=Revision::create([
					'user_id'=> $user_id,
					'lugar_id'=> $lugar_id,
					'momento'=>$momento,
				]);

			  //$revision_detallada=Revision_Detallada::find($item_id);

				$revisionDetallada=DB::table('revision_detalladas')->insert([
				   'revision_id' => $revision['id'],
				   'item_id'=>$item_id,
				   'num_maquina'=>$data['num_maquina'],
				   'tiene_camara'=>$data['tiene_camara'],
				   'tiene_bocinas'=>$data['tiene_bocinas'],
				   //'num_serie_cpu'=>$existPc['num_serie_cpu'],//
				   //'ram'=>$existPc['ram'],//
				   //'disco_duro'=>$existPc['disco_duro'],//
				   'sistema_operativo' => $data['sistema_operativo'],
				   'sistema_operativo_activado' => $data['sistema_operativo_activado'],
				   'cable_vga' => $data['cable_vga'],
				   'tiene_monitor' => $data['tiene_monitor'],
				   //'num_serie_monitor' => $existPc['num_serie_monitor'], //
				   'tiene_teclado' => $data['tiene_teclado'],
				   'tiene_raton' => $data['tiene_raton'],
				   'controlador_red' => $data['controlador_red'],
				   'paq_office_version' => $data['paq_office_version'],
				   'paq_office_activado' => $data['paq_office_activado'],
				   'observaciones' => $data['observaciones']
			   ]);


			  return response()->Json(['r'=>'revision detallada registrada'],201);

			} catch (ModelNotFoundException $e) {
				return response()->Json([$e, 'error'=>'surgio algun error'],406);
			}

		}else {
			return response()->Json(['status'=>false,'error'=>'no es formato Json'],401);
		}
	}*/

	function createRevisonDetallada2(Request $request, $lugar_id, $user_id, $momento){
		if($request->isJson()){
			try {
				$data=$request->Json()->all();
				$existlugar=Lugar::where("id", $lugar_id)->exists();
				$existuser=User::where("id",$user_id)->exists();
				//$existPc=Pc::where("item_id",$item_id)->exists();

				//verificar si el item_id de la ruta se encuentra en la tabla item_lugar de la BD y se encunetra en la sala correcta
                //pendientee esta parteeee aunn-....
				//$item_coincide=DB::table('item_lugar')->where([['lugar_id', '=', $lugar_id],['item_id', '=',

		        if($existlugar==FALSE && $existuser==FALSE && $existPc==FALSE ){
					return response()->Json(['error'=>'no se encuentra el lugar o el maquina o no se'],404);
				}

				$revision=Revision::create([
					'user_id'=> $user_id,
					'lugar_id'=> $lugar_id,
					'tipo'=>'detallada',
					'momento'=>$momento,
					'observaciones'=> '',
				]);

			  //$revision_detallada=Revision_Detallada::find($item_id);

			  foreach ($data as $detalladas ) {
				  $revisionDetallada=DB::table('revision_detalladas')->insert([
					 'revision_id' => $revision['id'],
					 'item_id'=>$detalladas['item_id'],
					 'num_maquina'=>$detalladas['num_maquina'],
					 'tiene_camara'=>$detalladas['tiene_camara'],
					 'tiene_bocinas'=>$detalladas['tiene_bocinas'],
					 //'num_serie_cpu'=>$existPc['num_serie_cpu'],//
					 //'ram'=>$existPc['ram'],//
					 //'disco_duro'=>$existPc['disco_duro'],//
					 'sistema_operativo' => $detalladas['sistema_operativo'],
					 'sistema_operativo_activado' => $detalladas['sistema_operativo_activado'],
					 'cable_vga' => $detalladas['cable_vga'],
					 'tiene_monitor' => $detalladas['tiene_monitor'],
					 //'num_serie_monitor' => $existPc['num_serie_monitor'], //
					 'tiene_teclado' => $detalladas['tiene_teclado'],
					 'tiene_raton' => $detalladas['tiene_raton'],
					 'controlador_red' => $detalladas['controlador_red'],
					 'paq_office_version' => $detalladas['paq_office_version'],
					 'paq_office_activado' => $detalladas['paq_office_activado'],
					 'observaciones' => $detalladas['observaciones']
				 ]);

			  }



			  return response()->Json(['r'=>'revision detallada registrada'],201);

			} catch (ModelNotFoundException $e) {
				return response()->Json([$e, 'error'=>'surgio algun error'],406);
			}

		}else {
			return response()->Json(['status'=>false,'error'=>'no es formato Json'],401);
		}
	}



    //
}
