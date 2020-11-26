<?php

namespace cdi\Http\Controllers;

use Illuminate\Http\Request;

use cdi;

class ParameterController extends Controller
{
	/*===================================
	=            USER EDIT            =
	===================================*/
	
	static public function ctrParameterEdit(){
		if (session('rank')=='Admin') {
			$answer = cdi\Parameter::find($_POST['idParametro']);
		   	$answer->value = $_POST['newValue'];
		   	$answer->save();
		}
 	}	
	static public function ctrImagesEdit(){
		if (session('rank')=='Admin') {
			if (isset($_POST['newSign'])) {
				if ($_FILES['sign']['name'] == "") {
					return redirect('/parametros');
				}
				if ($_FILES['sign']['size'] == 0 && $_FILES['sign']['error'] == 0){
					return redirect('/parametros');
				}
				$answer = cdi\Parameter::where('name','Firma Ingeniero')->first();
				try{
					unlink($answer->value);
				}catch(Exception $e){}
				   	if (isset($_FILES['sign']['tmp_name']) && !empty($_FILES['sign']['tmp_name'])) {
				   		list($ancho,$alto) = getimagesize($_FILES['sign']['tmp_name']);
				   		$nuevoAncho = 133;
				   		$nuevoAlto = 100;
				   		/*==========================================
				   		=            CREANDO DIRECTORIO            =
				   		==========================================*/
				   		$directorio = "Views/img/firma";
				   		$ruta = "";
				   		/*===========================================================================
				   		=            Funciones defecto PHP dependiendo de tipo de imagen            =
				   		===========================================================================*/
				   		switch ($_FILES['sign']['type']) {
				   			case 'image/jpeg':
				   				$ruta = $directorio.'/'.$_FILES['sign']['name'];
				   				$origen = imagecreatefromjpeg($_FILES['sign']['tmp_name']);
				   				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
				   				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
				   				imagejpeg($destino,$ruta);
				   				break;
				   			case 'image/png':
				   				$ruta = $directorio.'/'.$_FILES['sign']['name'];
				   				$origen = imagecreatefrompng($_FILES['sign']['tmp_name']);
				   				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
				   				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
				   				imagepng($destino,$ruta);
				   				break;
				   			default:
				   				# code...
				   				break;
				   		}
				   	}
				$answer->value = $ruta;
			   	$answer->save();
			   	return redirect('parametros');
			}elseif (isset($_POST['newLogo1'])) {
				if ($_FILES['logo1']['name'] == "") {
					return redirect('/parametros');
				}
				if ($_FILES['logo1']['size'] == 0 && $_FILES['logo1']['error'] == 0){
					return redirect('/parametros');
				}
				$answer = cdi\Parameter::where('name','Logo Login')->first();
				try{
					unlink($answer->value);
				}catch(Exception $e){}
				   	if (isset($_FILES['logo1']['tmp_name']) && !empty($_FILES['logo1']['tmp_name'])) {
				   		list($ancho,$alto) = getimagesize($_FILES['logo1']['tmp_name']);
				   		$nuevoAncho = 1080;
				   		$nuevoAlto = 1080;
				   		/*==========================================
				   		=            CREANDO DIRECTORIO            =
				   		==========================================*/
				   		$ruta ="";
				   		$directorio = "Views/img/plantilla";
				   		/*===========================================================================
				   		=            Funciones defecto PHP dependiendo de tipo de imagen            =
				   		===========================================================================*/
				   		switch ($_FILES['logo1']['type']) {
				   			case 'image/jpeg':
				   				$ruta = $directorio.'/'.$_FILES['logo1']['name'];
				   				$origen = imagecreatefromjpeg($_FILES['logo1']['tmp_name']);
				   				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
				   				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
				   				imagejpeg($destino,$ruta);
				   				break;
				   			case 'image/png':
				   				$ruta = $directorio.'/'.$_FILES['logo1']['name'];
				   				$origen = imagecreatefrompng($_FILES['logo1']['tmp_name']);
				   				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
				   				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
				   				imagepng($destino,$ruta);
				   				break;
				   			default:
				   				# code...
				   				break;
				   		}
				   	}
			   	$answer->value = $ruta;
			   	$answer->save();
			   	return redirect('parametros');
			}elseif (isset($_POST['newLogo2'])) {
				if ($_FILES['logo2']['name'] == "") {
					return redirect('/parametros');
				}
				if ($_FILES['logo2']['size'] == 0 && $_FILES['logo2']['error'] == 0){
					return redirect('/parametros');
				}
				$answer = cdi\Parameter::where('name','Logo Reporte')->first();
				try{
					unlink($answer->value);
				}catch(Exception $e){}

				   	if (isset($_FILES['logo2']['tmp_name']) && !empty($_FILES['logo2']['tmp_name'])) {
				   		list($ancho,$alto) = getimagesize($_FILES['logo2']['tmp_name']);
				   		$nuevoAncho = 100;
				   		$nuevoAlto = 75;
				   		/*==========================================
				   		=            CREANDO DIRECTORIO            =
				   		==========================================*/
				   		$ruta = "";
				   		$directorio = "Views/img/plantilla";
				   		/*===========================================================================
				   		=            Funciones defecto PHP dependiendo de tipo de imagen            =
				   		===========================================================================*/
				   		switch ($_FILES['logo2']['type']) {
				   			case 'image/jpeg':
				   				$ruta = $directorio.'/'.$_FILES['logo2']['name'];
				   				$origen = imagecreatefromjpeg($_FILES['logo2']['tmp_name']);
				   				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
				   				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
				   				imagejpeg($destino,$ruta);
				   				break;
				   			case 'image/png':
				   				$ruta = $directorio.'/'.$_FILES['logo2']['name'];
				   				$origen = imagecreatefrompng($_FILES['logo2']['tmp_name']);
				   				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
				   				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
				   				imagepng($destino,$ruta);
				   				break;
				   			default:
				   				# code...
				   				break;
				   		}
				   	}
			   	$answer->value = $ruta;
			   	$answer->save();
			   	return redirect('parametros');
			}elseif (isset($_POST['newLogo3'])) {
				if ($_FILES['logo3']['name'] == "") {
					return redirect('/parametros');
				}
				if ($_FILES['logo3']['size'] == 0 && $_FILES['logo3']['error'] == 0){
					return redirect('/parametros');
				}
				$answer = cdi\Parameter::where('name','Logo Correo')->first();
				try{
					unlink($answer->value);
				}catch(Exception $e){}

				   	if (isset($_FILES['logo3']['tmp_name']) && !empty($_FILES['logo3']['tmp_name'])) {
				   		list($ancho,$alto) = getimagesize($_FILES['logo3']['tmp_name']);
				   		$nuevoAncho = 1182;
				   		$nuevoAlto = 710;
				   		/*==========================================
				   		=            CREANDO DIRECTORIO            =
				   		==========================================*/
				   		$ruta = "";
				   		$directorio = "Views/img/plantilla";
				   		/*===========================================================================
				   		=            Funciones defecto PHP dependiendo de tipo de imagen            =
				   		===========================================================================*/
				   		switch ($_FILES['logo3']['type']) {
				   			case 'image/jpeg':
				   				$ruta = $directorio.'/'.$_FILES['logo3']['name'];
				   				$origen = imagecreatefromjpeg($_FILES['logo3']['tmp_name']);
				   				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
				   				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
				   				imagejpeg($destino,$ruta);
				   				break;
				   			case 'image/png':
				   				$ruta = $directorio.'/'.$_FILES['logo3']['name'];
				   				$origen = imagecreatefrompng($_FILES['logo2']['tmp_name']);
				   				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
				   				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
				   				imagepng($destino,$ruta);
				   				break;
				   			default:
				   				# code...
				   				break;
				   		}
				   	}
			   	$answer->value = $ruta;
			   	$answer->save();
			   	return redirect('parametros');
			}
	 	}	
	 }
	public function ajaxParameterSearch(){
		$answer = cdi\Parameter::find($_POST['idParametro']);
		echo json_encode($answer);
	} 
}
