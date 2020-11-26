<?php

namespace cdi\Http\Controllers;

use Illuminate\Http\Request;

use cdi;

class CorporationController extends Controller
{
	
	/*===================================
	=            USER CREATE            =
	===================================*/
	
	static public function ctrCorporationCreate(){

		if (isset($_POST['newCorporation'])) {
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ&\.\-  ]+$/', $_POST["newName"])) {
			   	/*======================================
			   	=            Validar Imagen            =
			   	======================================*/
			   	$ruta="";
			   	if (isset($_FILES['photo']['tmp_name']) && !empty($_FILES['photo']['tmp_name'])) {
			   		list($ancho,$alto) = getimagesize($_FILES['photo']['tmp_name']);
			   		$nuevoAncho = 500;
			   		$nuevoAlto = 500;
			   		/*==========================================
			   		=            CREANDO DIRECTORIO            =
			   		==========================================*/
			   		$directorio = "Views/img/empresas";
			   		/*===========================================================================
			   		=            Funciones defecto PHP dependiendo de tipo de imagen            =
			   		===========================================================================*/
			   		switch ($_FILES['photo']['type']) {
			   			case 'image/jpeg':
			   				$preruta = date('Y-m-d_his');
			   				$preruta = (string)$preruta;
			   				$ruta = $directorio.'/'.$_POST['newIdNumber'].'_'.$preruta.'.jpg';
			   				$origen = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
			   				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			   				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			   				imagejpeg($destino,$ruta);
			   				break;
			   			case 'image/png':
			   				$preruta = date('Y-m-d_his');
			   				$preruta = (string)$preruta;
			   				$ruta = $directorio.'/'.$_POST['newIdNumber'].'_'.$preruta.'.png';
			   				$origen = imagecreatefrompng($_FILES['photo']['tmp_name']);
			   				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			   				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			   				imagepng($destino,$ruta);
			   				break;
			   			default:
			   				# code...
			   				break;
			   		}
			   		
			   		
			   	}
			   	$answer = new cdi\Corporation();
			   	$answer->name = $_POST['newName'];
			   	$answer->username = $_POST['newUsername'];
			   	$answer->password = password_hash($_POST["newPassword"], PASSWORD_DEFAULT);
			   	$answer->id_type = $_POST['newIdType'];
			   	$answer->id_number = $_POST['newIdNumber'];
			   	$answer->address = $_POST['newAddress'];
			   	$answer->phone = $_POST['newPhone'];
			   	$answer->email = $_POST['newEmail'];
			   	$answer->city = $_POST['newCity'];
			   	$answer->photo = $ruta;
			   	$answer->contact_name = $_POST['newContactName'];
			   if ($answer->save()) {
			   	return redirect('empresas');
			   }
			 } else {
			 	return view('layouts.corporations_error');
			 }
		}

	}
	/*===================================
	=            USER EDIT            =
	===================================*/
	
	static public function ctrCorporationEdit(){

		if (isset($_POST['editCorporation'])) {
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ&\.\- ]+$/', $_POST["newName"])) {
				$answer = cdi\Corporation::find($_POST['editId']);
			   	/*======================================
			   	=            Validar Imagen             =
			   	======================================*/
			   		$ruta=$_POST['lastphoto'];
			   	if (isset($_FILES['photo']['tmp_name']) && !empty($_FILES['photo']['tmp_name'])) {
			   		list($ancho,$alto) = getimagesize($_FILES['photo']['tmp_name']);
			   		$nuevoAncho = 500;
			   		$nuevoAlto = 500;
			   		/*==========================================
			   		=            CREANDO DIRECTORIO            =
			   		==========================================*/
			   		$directorio = "Views/img/empresas";
			   		if (!empty($_POST['lastphoto'])) {
			   			unlink($_POST['lastphoto']);
			   		}
			   		
			   		
			   		/*===========================================================================
			   		=            Funciones defecto PHP dependiendo de tipo de imagen            =
			   		===========================================================================*/
			   		switch ($_FILES['photo']['type']) {
			   			case 'image/jpeg':
			   				$preruta = date('Y-m-d_his');
			   				$preruta = (string)$preruta;
			   				$ruta = $directorio.'/'.$_POST['newIdNumber'].'_'.$preruta.'.jpg';
			   				$origen = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
			   				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			   				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			   				imagejpeg($destino,$ruta);
			   				break;
			   			case 'image/png':
			   				$preruta = date('Y-m-d_his');
			   				$preruta = (string)$preruta;
			   				$ruta = $directorio.'/'.$_POST['newIdNumber'].'_'.$preruta.'.png';
			   				$origen = imagecreatefrompng($_FILES['photo']['tmp_name']);
			   				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			   				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			   				imagepng($destino,$ruta);
			   				break;
			   			default:
			   				# code...
			   				break;
			   		}
			   		
			   		
			   	}
			   	if ($_POST['newPassword'] != "") {
			   		$password = password_hash($_POST["newPassword"], PASSWORD_DEFAULT);
			   	}else{
			   		$password=$_POST['password'];
			   	}
			   	$answer->name = $_POST['newName'];
			   	$answer->password = $password;
			   	$answer->id_type = $_POST['newIdType'];
			   	$answer->id_number = $_POST['newIdNumber'];
			   	$answer->address = $_POST['newAddress'];
			   	$answer->phone = $_POST['newPhone'];
			   	$answer->email = $_POST['newEmail'];
			   	$answer->city = $_POST['newCity'];
			   	$answer->photo = $ruta;
			   	$answer->contact_name = $_POST['newContactName'];
			   if ($answer->save()) {
			   	return redirect('empresas');			   
			   }
			 } else {
			 	return view('layouts.corporations_error');
			 }
		}

	}
	/*======================================
	=            Borrar Unidad            =
	======================================*/
	static public function ctrCorporationDelete(){
		if (isset($_POST['idEmpresa'])) {
		$answer=cdi\Corporation::find($_POST['idEmpresa']);
			if ($_POST['fotoEmpresa'] != "") {
				unlink($_POST["fotoEmpresa"]);
			}
			$vehicles = $answer->vehicles;
			foreach ($vehicles as $vehicle) {
				$dir = "Views/img/revisiones/".$vehicle->plate;
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
				$checks = $vehicle->checks;
				foreach ($checks as $check) {
					$check->delete();
				}
				$vehicle->delete();
			}
		$answer->delete();
		}
	}
	public function ajaxCorporationEdit(){
		$answer = cdi\Corporation::find($_POST['idEmpresa']);
		echo json_encode($answer);
	} 
	public function ajaxCorporationCheck(){
		$answer = cdi\Corporation::where('id_type',$_POST['tipoId'])->where('id_number',$_POST['numeroId'])->first();
		echo json_encode($answer);
	} 
	public function ajaxCorporationActivate(){
		if (session('rank')=="Admin") {
			$answer = cdi\Corporation::find($_POST['activarEmpresa']);
			$answer->state = $_POST['estadoEmpresa'];
			$answer->save();
		}
	} 
	/*===============================================
	=            Mostrar tabla propiedades           =
	===============================================*/
	
	public function ajaxCorporationDatatable(){
		if (session('rank')=='Admin' || session('rank')=='Empleado') {
		  	$corporations = cdi\Corporation::all();
		  	echo '{
					"data": [';

				for($i = 0; $i < count($corporations)-1; $i++){
					/*=============================
					=            Stock            =
					=============================*/
					if ($corporations[$i]->photo != null && $corporations[$i]->photo != "") {
						$img ="<img src='".$corporations[$i]->photo."' class='img-thumbnail' width='40px'>";
					}else{
						$img ="<img src='Views/img/usuarios/anonymous.png' class='img-thumbnail' width='40px'>";
					}
					if ($corporations[$i]->state == 1) {
						$state ="<button class='btn btn-success btn-sm btnActivarEmpresa' idEmpresa='".$corporations[$i]->id."' estadoEmpresa='0'>Activado</button>";
					}else{
						$state ="<button class='btn btn-danger btn-sm btnActivarEmpresa' idEmpresa='".$corporations[$i]->id."' estadoEmpresa='1'>Desactivado</button>";
					}
					if (session('rank')=='Admin') {
						$buttons ="<div class='btn-group'><button class='btn btn-warning btnEditarEmpresa' idEmpresa='".$corporations[$i]->id."' data-toggle='modal' data-target='#modalEditarEmpresa'><i class='fa fa-pen'></i></button><button class='btn btn-danger btnBorrarEmpresa' idEmpresa='".$corporations[$i]->id."' fotoEmpresa='".$corporations[$i]->photo."'><i class='fa fa-times'></i></button></div>";
					}else {
						$buttons ="<div class='btn-group'><button class='btn btn-warning btnEditarEmpresa' idEmpresa='".$corporations[$i]->id."' data-toggle='modal' data-target='#modalEditarEmpresa'><i class='fa fa-pen'></i></button></div>";
					}
	                    
	                    $identification = "<b>".$corporations[$i]->id_type."</b> ".$corporations[$i]->id_number;
					 echo '[
				      "'.($i+1).'",
				      "'.$img.'",
				      "'.$corporations[$i]->name.'",
				      "'.$identification.'",
				      "'.$state.'",
				      "'.$corporations[$i]->email.'",
				      "'.$corporations[$i]->phone.'",
				      "'.$corporations[$i]->address.'",
				      "'.$corporations[$i]->city.'",
				      "'.$corporations[$i]->contact_name.'",
				      "'.$corporations[$i]->username.'",
				      "'.$corporations[$i]->last_log.'",
				      "'.$buttons.'"
				    ],';

				}
					if ($corporations[count($corporations)-1]->photo != null && $corporations[count($corporations)-1]->photo != "") {
						$img ="<img src='".$corporations[count($corporations)-1]->photo."' class='img-thumbnail' width='40px'>";
					}else{
						$img ="<img src='Views/img/usuarios/anonymous.png' class='img-thumbnail' width='40px'>";
					}
					if ($corporations[count($corporations)-1]->state == 1) {
						$state ="<button class='btn btn-success btn-sm btnActivarEmpresa' idEmpresa='".$corporations[count($corporations)-1]->id."' estadoEmpresa='0'>Activado</button>";
					}else{
						$state ="<button class='btn btn-danger btn-sm btnActivarEmpresa' idEmpresa='".$corporations[count($corporations)-1]->id."' estadoEmpresa='1'>Desactivado</button>";
					}
					if (session('rank')=='Admin') {
						$buttons ="<div class='btn-group'><button class='btn btn-warning btnEditarEmpresa' idEmpresa='".$corporations[count($corporations)-1]->id."' data-toggle='modal' data-target='#modalEditarEmpresa'><i class='fa fa-pen'></i></button><button class='btn btn-danger btnBorrarEmpresa' idEmpresa='".$corporations[count($corporations)-1]->id."' fotoEmpresa='".$corporations[count($corporations)-1]->photo."'><i class='fa fa-times'></i></button></div>";
					}else {
						$buttons ="<div class='btn-group'><button class='btn btn-warning btnEditarEmpresa' idEmpresa='".$corporations[count($corporations)-1]->id."' data-toggle='modal' data-target='#modalEditarEmpresa'><i class='fa fa-pen'></i></button></div>";
					}
	                    $identification = "<b>".$corporations[count($corporations)-1]->id_type."</b> ".$corporations[count($corporations)-1]->id_number;
					 echo '[
				      "'.(count($corporations)).'",
				      "'.$img.'",
				      "'.$corporations[count($corporations)-1]->name.'",
				      "'.$identification.'",
				      "'.$state.'",
				      "'.$corporations[count($corporations)-1]->email.'",
				      "'.$corporations[count($corporations)-1]->phone.'",
				      "'.$corporations[count($corporations)-1]->address.'",
				      "'.$corporations[count($corporations)-1]->city.'",
				      "'.$corporations[count($corporations)-1]->contact_name.'",
				      "'.$corporations[count($corporations)-1]->username.'",
				      "'.$corporations[count($corporations)-1]->last_log.'",
				      "'.$buttons.'"
				    ]
				]
			}';
		}else{
			echo "Wrong Auth!";
		}
	}
	
}
