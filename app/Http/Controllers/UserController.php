<?php

namespace cdi\Http\Controllers;

use Illuminate\Http\Request;
use cdi;
use Session;

class UserController extends Controller
{/*=============================================
	=                    LOGIN               =
	=============================================*/
	static public function ctrUserLog(){
		
		if (isset($_POST['user']) && isset($_POST['pass'])) {
			if (preg_match('/^[a-zA-Z-0-9 ]+$/', $_POST['user'])) {
				switch ($_POST['rol']) {
					case 'Empresa':
						$answer = cdi\Corporation::where('username',$_POST['user'])->first();
						break;
					default:
						$answer = cdi\User::where('username',$_POST['user'])->first();
						break;
				}
				$password = $_POST["pass"];
				if (is_object($answer)) {
					if (password_verify($password,$answer->password) ) {
						if ($answer->state == 1) {
							if ($_POST['rol'] == 'Empresa') {
								session(['rank' => $_POST['rol']]);
							}else{
								session(['rank' => $answer->type]);
							}
							session(['user' => $answer->username]);
							session(['name' => $answer->name]);
							session(['id' => $answer->id]);
							session(['photo' => $answer->photo]);
							$compName = cdi\Parameter::where('name','Razon Social')->first();
							session(['comp'	=> $compName->value]);
							/*=============================================
							=                  REGISTRAR LOGIN               =
							=============================================*/
							date_default_timezone_set('America/Bogota');
							session(['log' => date("Y-m-d h:i:s")]);
							$answer->last_log = session('log');
							if ($answer->save()) {
								echo ' <script>
							window.location = "inicio"; </script> ';

							}
							
						}else{
							return view('layouts.unactive_user');
						}
						
					}else{
						return view('layouts.credentials_error');
					}
				}else{
					return view('layouts.credentials_error');
				}
			}else{
				return view('layouts.characters_error');
			}
		}else{
			return view('layouts.blank_error');
		}
	}
	/*===================================
	=            USER CREATE            =
	===================================*/
	
	static public function ctrUserCreate(){

		if (isset($_POST['newUser'])) {
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newName"]) &&
			   preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["newUsername"])) {
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
			   		$directorio = "Views/img/usuarios/".$_POST['newUsername'];
			   		mkdir($directorio,0755);
			   		/*===========================================================================
			   		=            Funciones defecto PHP dependiendo de tipo de imagen            =
			   		===========================================================================*/
			   		switch ($_FILES['photo']['type']) {
			   			case 'image/jpeg':
			   				$preruta = date('Y-m-d_his');
			   				$preruta = (string)$preruta;
			   				$ruta = $directorio.'/'.$_POST['newUsername'].'_'.$preruta.'.jpg';
			   				$origen = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
			   				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			   				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			   				imagejpeg($destino,$ruta);
			   				break;
			   			case 'image/png':
			   				$preruta = date('Y-m-d_his');
			   				$preruta = (string)$preruta;
			   				$ruta = $directorio.'/'.$_POST['newUsername'].'_'.$preruta.'.png';
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
			   	$answer = new cdi\User();
			   	$answer->name = $_POST['newName'];
			   	$answer->username = $_POST['newUsername'];
			   	$answer->password = password_hash($_POST["newPassword"], PASSWORD_DEFAULT);
			   	$answer->type = $_POST['rol'];
			   	$answer->photo = $ruta;
			   if ($answer->save()) {
			   	return redirect('usuarios');
			   }
			 } else {
			 	return view('layouts.users_error');
			 }
		}

	}
	/*===================================
	=            USER EDIT            =
	===================================*/
	static public function ctrUserEdit(){

		if (isset($_POST['editUser'])) {
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newName"])) {
			   	/*======================================
			   	=            Validar Imagen             =
			   	======================================*/
			   	$ruta=$_POST['lastPhoto'];
			   	if (isset($_FILES['photo']['tmp_name']) && !empty($_FILES['photo']['tmp_name'])) {
			   		list($ancho,$alto) = getimagesize($_FILES['photo']['tmp_name']);
			   		$nuevoAncho = 500;
			   		$nuevoAlto = 500;
			   		/*==========================================
			   		=            CREANDO DIRECTORIO            =
			   		==========================================*/
			   		$directorio = "Views/img/usuarios/".$_POST['newUsername'];
			   		if (!empty($_POST['lastPhoto'])) {
			   			unlink($_POST['lastPhoto']);
			   		}else{
			   			mkdir($directorio,0755);
			   		}
			   		
			   		
			   		/*===========================================================================
			   		=            Funciones defecto PHP dependiendo de tipo de imagen            =
			   		===========================================================================*/
			   		switch ($_FILES['photo']['type']) {
			   			case 'image/jpeg':
			   				$preruta = date('Y-m-d_his');
			   				$preruta = (string)$preruta;
			   				$ruta = $directorio.'/'.$_POST['newUsername'].'_'.$preruta.'.jpg';
			   				$origen = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
			   				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			   				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			   				imagejpeg($destino,$ruta);
			   				break;
			   			case 'image/png':
			   				$preruta = date('Y-m-d_his');
			   				$preruta = (string)$preruta;
			   				$ruta = $directorio.'/'.$_POST['newUsername'].'_'.$preruta.'.png';
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
				$answer = cdi\User::where('username',$_POST['newUsername'])->first();
			   	if ($_POST['newPassword'] != "") {
			   		$password = password_hash($_POST["newPassword"], PASSWORD_DEFAULT);
			   	}else{
			   		$password=$answer->password;
			   	}
			   	$answer->name = $_POST['newName'];
			   	$answer->password = $password;
			   	$answer->type = $_POST['rol'];
			   	$answer->photo = $ruta;
			   if ($answer->save()) {
			   	return redirect('usuarios');			   
			   }
			 } else {
			 	return view('layouts.users_error');
			 }
		}

	}
	/*======================================
	=            Borrar usuario            =
	======================================*/
	static public function ctrUserDelete(){
		if (isset($_POST['idUsuario'])) {
			if ($_POST['fotoUsuario'] != "") {
				unlink($_POST["fotoUsuario"]);
				rmdir('Views/img/usuarios/'.$_POST['usuario']);
			}
		$answer=cdi\User::find($_POST['idUsuario']);
		$answer->delete();
		}
	}
	static public function ctrUserLogout(){
		Session::flush();
		return redirect('/');
	}
	public function ajaxUserEdit(){
		$answer = cdi\User::find($_POST['idUsuario']);
		echo json_encode($answer);
	} 
	public function ajaxSelfEdit(){
		switch (session('rank')) {
			case 'Empresa':
				$answer = cdi\Corporation::find($_POST['idUsuario']);
				break;
			default:
				$answer = cdi\User::find($_POST['idUsuario']);
				break;
		}
		echo json_encode($answer);
	} 
	public function ajaxUserActivate(){
		if (session('rank')=="Admin") {
			$answer = cdi\User::find($_POST['activarUsuario']);
			$answer->state = $_POST['estadoUsuario'];
			$answer->save();
		}
	} 
	public function ajaxUserCheck(){
		$answer = cdi\User::where('username',$_POST['userCheck'])->first();
		echo json_encode($answer);
	} 
	public function ctrSelfEdit($rank,$id){
		switch ($rank) {
			case 'Empresa':
				$answer = cdi\Corporation::find($_POST['idUsuario']);
				break;
			default:
				$answer = cdi\User::find($_POST['idUsuario']);
				break;
		}

		if (isset($_POST['editUser']) && $_POST['password']==$answer->password) {
			   	/*======================================
			   	=            Validar Imagen             =
			   	======================================*/
			   	$ruta=$answer->photo;
			   	if (isset($_FILES['photo']['tmp_name']) && !empty($_FILES['photo']['tmp_name'])) {
			   		list($ancho,$alto) = getimagesize($_FILES['photo']['tmp_name']);
			   		$nuevoAncho = 500;
			   		$nuevoAlto = 500;
			   		/*==========================================
			   		=            CREANDO DIRECTORIO            =
			   		==========================================*/
			   		$directorio = "Views/img/".$folder."/".$answer->username;
			   		if (!empty($answer->photo)) {
			   			unlink($answer->photo);
			   		}else{
			   			mkdir($directorio,0755);
			   		}
			   		
			   		
			   		/*===========================================================================
			   		=            Funciones defecto PHP dependiendo de tipo de imagen            =
			   		===========================================================================*/
			   		switch ($_FILES['photo']['type']) {
			   			case 'image/jpeg':
			   				$preruta = date('Y-m-d_his');
			   				$preruta = (string)$preruta;
			   				$ruta = $directorio.'/'.$answer->username.'_'.$preruta.'.jpg';
			   				$origen = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
			   				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			   				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			   				imagejpeg($destino,$ruta);
			   				break;
			   			case 'image/png':
			   				$preruta = date('Y-m-d_his');
			   				$preruta = (string)$preruta;
			   				$ruta = $directorio.'/'.$answer->username.'_'.$preruta.'.png';
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
			   		$password=$answer->password;
			   	}
			   	$answer->password = $password;
			   	$answer->photo = $ruta;
			   	$answer->save();
			   	return redirect('/');		
		}
	}
	/*===============================================
	=            Mostrar tabla propiedades           =
	===============================================*/
	
	public function ajaxUserDatatable(){
		if (session('rank')=='Admin') {
		  	$users = cdi\User::all();
		  	echo '{
					"data": [';

				for($i = 0; $i < count($users)-1; $i++){
					/*=============================
					=            Stock            =
					=============================*/
					if ($users[$i]->photo != null && $users[$i]->photo != "") {
						$img ="<img src='".$users[$i]->photo."' class='img-thumbnail' width='40px'>";
					}else{
						$img ="<img src='Views/img/usuarios/anonymous.png' class='img-thumbnail' width='40px'>";
					}
					if ($users[$i]->state == 1) {
						$state ="<button class='btn btn-success btn-sm btnActivar' idUsuario='".$users[$i]->id."' estadoUsuario='0'>Activado</button>";
					}else{
						$state ="<button class='btn btn-danger btn-sm btnActivar' idUsuario='".$users[$i]->id."' estadoUsuario='1'>Desactivado</button>";
					}
	                    $buttons ="<div class='btn-group'><button class='btn btn-warning btnEditarUsuario' idUsuario='".$users[$i]->id."' data-toggle='modal' data-target='#modalEditarUsuario'><i class='fa fa-pen'></i></button><button class='btn btn-danger btnBorrarUsuario' idUsuario='".$users[$i]->id."' fotoUsuario='".$users[$i]->photo."' usuario='".$users[$i]->username."'><i class='fa fa-times'></i></button></div>";
					 echo '[
				      "'.($i+1).'",
				      "'.$users[$i]->name.'",
				      "'.$users[$i]->username.'",
				      "'.$img.'",
				      "'.$users[$i]->type.'",
				      "'.$state.'",
				      "'.$users[$i]->last_log.'",
				      "'.$buttons.'"
				    ],';

				}
					if ($users[count($users)-1]->photo != null && $users[count($users)-1]->photo != "") {
						$img ="<img src='".$users[count($users)-1]->photo."' class='img-thumbnail' width='40px'>";
					}else{
						$img ="<img src='Views/img/usuarios/anonymous.png' class='img-thumbnail' width='40px'>";
					}
					if ($users[count($users)-1]->state == 1) {
						$state ="<button class='btn btn-success btn-sm btnActivar' idUsuario='".$users[count($users)-1]->id."' estadoUsuario='0'>Activado</button>";
					}else{
						$state ="<button class='btn btn-danger btn-sm btnActivar' idUsuario='".$users[count($users)-1]->id."' estadoUsuario='1'>Desactivado</button>";
					}
	                    $buttons ="<div class='btn-group'><button class='btn btn-warning btnEditarUsuario' idUsuario='".$users[count($users)-1]->id."' data-toggle='modal' data-target='#modalEditarUsuario'><i class='fa fa-pen'></i></button><button class='btn btn-danger btnBorrarUsuario' idUsuario='".$users[count($users)-1]->id."' fotoUsuario='".$users[count($users)-1]->photo."' usuario='".$users[count($users)-1]->username."'><i class='fa fa-times'></i></button></div>";
					 echo '[
				      "'.(count($users)).'",
				      "'.$users[count($users)-1]->name.'",
				      "'.$users[count($users)-1]->username.'",
				      "'.$img.'",
				      "'.$users[count($users)-1]->type.'",
				      "'.$state.'",
				      "'.$users[count($users)-1]->last_log.'",
				      "'.$buttons.'"
				    ]
				]
			}';
		}else{
			echo "Wrong Auth!";
			
		}
	}
	
}
