<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('inicio','/');

/*==================================
=            Navigation            =
==================================*/
Route::get('/', 'GeneralController@homeView');
Route::get('usuarios','GeneralController@usersView');
Route::get('empresas','GeneralController@corporationsView');
Route::get('vehiculos','GeneralController@vehiclesView');
Route::get('revisiones','GeneralController@checksView');
Route::get('revision/crear/{last?}','GeneralController@newCheckView');
Route::get('parametros', 'GeneralController@ParametersView');
Route::get('resultado/{id}','GeneralController@resultView');
Route::get('pdfs/generar','CheckController@pdfGenerate');

/*=============================
=            Users            =
=============================*/
Route::post('/', 'UserController@ctrUserLog');
Route::post('ajax/usuarios/editar','UserController@ajaxUserEdit');
Route::post('ajax/usuarios/editarme','UserController@ajaxSelfEdit');
Route::post('ajax/usuarios/activar','UserController@ajaxUserActivate');
Route::post('ajax/usuarios/check','UserController@ajaxUserCheck');
Route::post('ajax/usuarios/borrar','UserController@ctrUserDelete');
Route::post('editarme/{rank}/{id}','UserController@ctrSelfEdit');
Route::post('usuarios', 'UserController@ctrUserCreate');
Route::post('usuarios/editar', 'UserController@ctrUserEdit');
Route::post('ajax/datatable/usuarios','UserController@ajaxUserDatatable');
Route::get('salir','UserController@ctrUserLogout');

/*====================================
=            Corporations            =
====================================*/
Route::post('ajax/empresas/editar','CorporationController@ajaxCorporationEdit');
Route::post('ajax/empresas/activar','CorporationController@ajaxCorporationActivate');
Route::post('ajax/empresas/check','CorporationController@ajaxCorporationCheck');
Route::post('ajax/empresas/borrar','CorporationController@ctrCorporationDelete');
Route::post('empresas', 'CorporationController@ctrCorporationCreate');
Route::post('empresas/editar', 'CorporationController@ctrCorporationEdit');
Route::post('ajax/datatable/empresas','CorporationController@ajaxCorporationDatatable');

/*================================
=            Vehicles            =
================================*/
Route::post('ajax/vehiculos/editar','VehicleController@ajaxVehicleEdit');
Route::post('ajax/vehiculos/check','VehicleController@ajaxVehicleCheck');
Route::post('ajax/vehiculos/borrar','VehicleController@ctrVehicleDelete');
Route::post('vehiculos', 'VehicleController@ctrVehicleCreate');
Route::post('vehiculos/editar', 'VehicleController@ctrVehicleEdit');
Route::post('ajax/datatable/vehiculos','VehicleController@ajaxVehicleDatatable');

/*================================
=            Checks            =
================================*/
Route::post('ajax/revisiones/check','CheckController@ajaxCheckSummary');
Route::post('ajax/revisiones/recheck','CheckController@ajaxCheckEdit');
Route::post('ajax/revisiones/borrar','CheckController@ctrCheckDelete');
Route::post('revisiones', 'CheckController@ctrCheckCreate');
Route::post('ajax/datatable/revisiones','CheckController@ajaxCheckDatatable');
Route::get('revision/error/SOAT','GeneralController@SOATError');
Route::get('revision/error/tecno','GeneralController@technicianError');

/*================================
=           Parametros            =
================================*/
Route::post('ajax/parametros/editar','ParameterController@ajaxParameterSearch');
Route::post('parametros/editar', 'ParameterController@ctrParameterEdit');
Route::post('parametros', 'ParameterController@ctrImagesEdit');
