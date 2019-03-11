<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function(){
	return str_random(32);
});
//ruta para login
$router->post('/users/login',['uses'=>'UsersController@loginLog']);//listo

//rutas principales CRUD de la tabla padre: USUARIO
$router->post('/createuser',['uses'=>'UsersController@createUser']); //listo
$router->get('/users', ['uses'=>'UsersController@mostrarUsers']);//listo
$router->put('/updateuser/{id}',['uses'=>'UsersController@updateUser']);//listo
$router->delete('/deleteuser/{id}',['uses'=>'UsersController@deleteUser']);//listo

//rutas principales CRUD de la tabla padre: LUGAR
$router->post('/createlugar',['uses'=>'LugarController@createLugar']);//listo
$router->get('/lugares', ['uses'=>'LugarController@mostrarLugares']);//listo
$router->put('/updatelugar/{id}',['uses'=>'LugarController@updateLugar']);//listo
$router->delete('/deletelugar/{id}',['uses'=>'LugarController@deleteLugar']);//listo

//rutas principales CRUD de la tabla padre: ITEM
$router->post('/createitem',['uses'=>'ItemController@createItem']);//listo
$router->get('/items', ['uses'=>'ItemController@mostrarItems']);//listo
$router->put('/updateitem/{id}',['uses'=>'ItemController@updateItem']);//listo
$router->delete('/deleteitem/{id}',['uses'=>'ItemController@deleteItem']);//listo

//rutas con relacion a un Horario y el usuario
$router->post('/createhorario',['uses'=>'HorarioController@createHorario']); //listo
$router->get('/horarios', ['uses'=>'HorarioController@mostrarHorarios']);//listo
$router->delete('/deletehorario/{user_id}',['uses'=>'HorarioController@deleteHorario']);//listo
$router->get('/findhorario/{user_id}',['uses'=>'HorarioController@findHorario']); //listo
$router->post('/findhorario/dia/{user_id}',['uses'=>'HorarioController@findDayHorario']); //listo


//rutas para la EXISTENCIAS
$router->post('/createexistenia',['uses'=>'ExistenciaController@createExistencia']); //listo
$router->get('/existencias', ['uses'=>'ExistenciaController@mostrarExistencia']); //aun checar $router->get('/existencias', ['uses'=>'ExistenciaController@mostrarExistencia']); //listo
$router->get('/findexistencia/{lugar_id}',['uses'=>'ExistenciaController@findLugarExistencia']);//listo
//

//aqui pegar las nuevass rutass

//rutas para la Pcs que son un items
$router->post('/createpc',['uses'=>'PcsController@createPc']);//listo
$router->get('/pcs', ['uses'=>'PcsController@mostrarPcs']); //listo

//rutas para crear plantilla
$router->get('/plantilla',['uses'=>'PlantillaController@mostrarPlantilla']);//listo
$router->get('/plantilla/{lugar_id}',['uses'=>'PlantillaController@createPlantilla']);//listo

// crear ruta para enviar las maquinas que se encuentran en la sala especificada.
$router->get('/findmaquinas/{lugar_id}',['uses'=>'LugarController@findmaquinas']); //listo

//guardar las revisiciones rapidas y detalladas
//$router->post('/createrevisionrapida/{lugar_id}/{user_id}',['uses'=>'RevisionesController@createRevisonRapida']); //listo

//revisiones rapidas .
$router->post('/createrevisionrapida/{lugar_id}/{user_id}/{momento}/{observaciones}',['uses'=>'RevisionesController@createRevisonRapida1']); //->listo

//revisiones detalladas
$router->post('/createrevisiondetallada/{lugar_id}/{user_id}/{momento}',['uses'=>'RevisionesController@createRevisonDetallada2']);