<?php

namespace cdi\Http\Controllers;

use Illuminate\Http\Request;

use cdi;

use Carbon\Carbon;

class VehicleController extends Controller
{
    /*===================================
	=            USER CREATE            =
	===================================*/
	
	static public function ctrVehicleCreate(){

		if (isset($_POST['newVehicle'])) {
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["newPlate"])) {
			   	$answer = new cdi\Vehicle();
			   	$answer->corporation_id = $_POST['newCorporationId'];
			   	$answer->propietary = $_POST['newPropietary'];
			   	$answer->id_type = $_POST['newIdType'];
			   	$answer->id_number = $_POST['newIdNumber'];
			   	$answer->plate = $_POST['newPlate'];
			   	$answer->brand = $_POST['newBrand'];
			   	$answer->type = $_POST['newType'];
			   	$answer->model = $_POST['newModel'];
			   	$answer->inscription = $_POST['newInscription'];
			   	$answer->SOAT_expiration = Carbon::createFromFormat('d/m/Y',$_POST['newSOATExpiration']);
			   	$answer->technician_check_expiration = Carbon::createFromFormat('d/m/Y',$_POST['newTechnicianCheckExpiration']);
			   if ($answer->save()) {
			   	return redirect('vehiculos');
			   }
			 } else {
			 	return view('layouts.vehicles_error');
			 }
		}
	}
	/*===================================
	=            USER EDIT            =
	===================================*/
	
	static public function ctrVehicleEdit(){

		if (isset($_POST['editVehicle'])) {
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["newPlate"])) {
				$answer = cdi\Vehicle::find($_POST['editId']);
			   	$answer->corporation_id = $_POST['newCorporationId'];
			   	$answer->propietary = $_POST['newPropietary'];
			   	$answer->id_type = $_POST['newIdType'];
			   	$answer->id_number = $_POST['newIdNumber'];
			   	$answer->plate = $_POST['newPlate'];
			   	$answer->brand = $_POST['newBrand'];
			   	$answer->type = $_POST['newType'];
			   	$answer->model = $_POST['newModel'];
			   	$answer->inscription = $_POST['newInscription'];
			   	$answer->SOAT_expiration = Carbon::createFromFormat('d/m/Y',$_POST['newSOATExpiration']);
			   	$answer->technician_check_expiration = Carbon::createFromFormat('d/m/Y',$_POST['newTechnicianCheckExpiration']);
			   	$answer->SOAT_notification = 0;
			   	$answer->technician_notification = 0;
			   	$answer->check_notification = 0;
			   if ($answer->save()) {
			   	return redirect('vehiculos');			   
			   }
			 } else {
			 	return view('layouts.vehicles_error');
			 }
		}

	}
	/*======================================
	=            Borrar Vehiculo           =
	======================================*/
	static public function ctrVehicleDelete(){
		if (isset($_POST['idVehiculo'])) {
			$answer=cdi\Vehicle::find($_POST['idVehiculo']);
			$dir = "Views/img/revisiones/".$answer->plate;
		    // Check for files 
		    if (is_file($dir)) { 
		          
		        // If it is file then remove by 
		        // using unlink function 
		        unlink($dir); 
		    } 
		      
		    // If it is a directory. 
		    elseif (is_dir($dir)) { 
		          
		        // Get the list of the files in this 
		        // directory 
		        $scan = glob(rtrim($dir, '/').'/*'); 
		          
		        // Loop through the list of files 
		        foreach($scan as $index=>$path) { 
		              
		            // Call recursive function 
		            unlink($path); 
		        } 
		          
		        // Remove the directory itself 
		        rmdir($dir); 
		    }
			$checks = $answer->checks;
			foreach ($checks as $check) {
				$check->delete();
			}
			$answer->delete();
		}
	}
	public function ajaxVehicleEdit(){
		$answer = cdi\Vehicle::find($_POST['idVehiculo'])->load('corporation');
		echo json_encode($answer);
	} 
	public function ajaxVehicleCheck(){
		$answer = cdi\Vehicle::where('plate',$_POST['placa'])->first();
		echo json_encode($answer);
	} 
	/*===============================================
	=            Mostrar tabla vehiculos           =
	===============================================*/
	
	public function ajaxVehicleDatatable(){	
		if (session('rank')=='Admin' || session('rank')=='Empleado') {
		  	$vehicles = cdi\Vehicle::all();
		  	$hoy = Carbon::now();
		  	echo '{
					"data": [';

				for($i = 0; $i < count($vehicles)-1; $i++){

					$SOATExpiration = Carbon::parse($vehicles[$i]->SOAT_expiration);
					$tecnoExpiration = Carbon::parse($vehicles[$i]->technician_check_expiration);
					if ($hoy > $SOATExpiration) {
						$SOAT ="<button class='btn btn-danger btn-sm'>".$SOATExpiration->format('d/m/Y')."</button>";
					}else{
						$SOAT ="<button class='btn btn-success btn-sm'>".$SOATExpiration->format('d/m/Y')."</button>";
					}
					if ($hoy > $tecnoExpiration) {
						$tecno ="<button class='btn btn-danger btn-sm'>".$tecnoExpiration->format('d/m/Y')."</button>";
					}else{
						$tecno ="<button class='btn btn-success btn-sm'>".$tecnoExpiration->format('d/m/Y')."</button>";
					}
					if (session('rank')=='Admin') {
	                    $buttons ="<div class='btn-group'><button class='btn btn-warning btnEditarVehiculo' idVehiculo='".$vehicles[$i]->id."' data-toggle='modal' data-target='#modalEditarVehiculo'><i class='fa fa-pen'></i></button><button class='btn btn-danger btnBorrarVehiculo' idVehiculo='".$vehicles[$i]->id."'><i class='fa fa-times'></i></button></div>";
					}else{
	                    $buttons ="<div class='btn-group'><button class='btn btn-warning btnEditarVehiculo' idVehiculo='".$vehicles[$i]->id."' data-toggle='modal' data-target='#modalEditarVehiculo'><i class='fa fa-pen'></i></button></div>";
					}
	                    $identification = "<b>".$vehicles[$i]->id_type."</b> ".$vehicles[$i]->id_number;
					 echo '[
				      "'.($i+1).'",
				      "'.$vehicles[$i]->corporation->name.'",
				      "'.$vehicles[$i]->plate.'",
				      "'.$SOAT.'",
				      "'.$tecno.'",
				      "'.$vehicles[$i]->propietary.'",
				      "'.$identification.'",
				      "'.$vehicles[$i]->type.'",
				      "'.$vehicles[$i]->brand.'",
				      "'.$vehicles[$i]->model.'",
				      "'.$vehicles[$i]->inscription.'",
				      "'.$buttons.'"
				    ],';

				}
					$SOATExpiration = Carbon::parse($vehicles[count($vehicles)-1]->SOAT_expiration);
					$tecnoExpiration = Carbon::parse($vehicles[count($vehicles)-1]->technician_check_expiration);
					if ($hoy > $SOATExpiration) {
						$SOAT ="<button class='btn btn-danger btn-sm'>".$SOATExpiration->format('d/m/Y')."</button>";
					}else{
						$SOAT ="<button class='btn btn-success btn-sm'>".$SOATExpiration->format('d/m/Y')."</button>";
					}
					if ($hoy > $tecnoExpiration) {
						$tecno ="<button class='btn btn-danger btn-sm'>".$tecnoExpiration->format('d/m/Y')."</button>";
					}else{
						$tecno ="<button class='btn btn-success btn-sm'>".$tecnoExpiration->format('d/m/Y')."</button>";
					}
					if (session('rank')=='Admin') {
	                    $buttons ="<div class='btn-group'><button class='btn btn-warning btnEditarVehiculo' idVehiculo='".$vehicles[count($vehicles)-1]->id."' data-toggle='modal' data-target='#modalEditarVehiculo'><i class='fa fa-pen'></i></button><button class='btn btn-danger btnBorrarVehiculo' idVehiculo='".$vehicles[count($vehicles)-1]->id."'><i class='fa fa-times'></i></button></div>";
					}else{
	                    $buttons ="<div class='btn-group'><button class='btn btn-warning btnEditarVehiculo' idVehiculo='".$vehicles[count($vehicles)-1]->id."' data-toggle='modal' data-target='#modalEditarVehiculo'><i class='fa fa-pen'></i></button></div>";
					}
	                    $identification = "<b>".$vehicles[count($vehicles)-1]->id_type."</b> ".$vehicles[count($vehicles)-1]->id_number;
					 echo '[
				      "'.(count($vehicles)).'",
				      "'.$vehicles[count($vehicles)-1]->corporation->name.'",
				      "'.$vehicles[count($vehicles)-1]->plate.'",
				      "'.$SOAT.'",
				      "'.$tecno.'",
				      "'.$vehicles[count($vehicles)-1]->propietary.'",
				      "'.$identification.'",
				      "'.$vehicles[count($vehicles)-1]->type.'",
				      "'.$vehicles[count($vehicles)-1]->brand.'",
				      "'.$vehicles[count($vehicles)-1]->model.'",
				      "'.$vehicles[count($vehicles)-1]->inscription.'",
				      "'.$buttons.'"
				    ]
				]
			}';
		}else{
			echo "Wrong Auth!";
		}
	}
}
