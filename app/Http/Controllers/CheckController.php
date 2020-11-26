<?php

namespace cdi\Http\Controllers;

use Illuminate\Http\Request;

use cdi;

use Carbon\Carbon;

class CheckController extends Controller
{
    /*===================================
	=            USER CREATE            =
	===================================*/
	
	static public function ctrCheckCreate(){

		if (isset($_POST['newCheck'])) {
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ& \.\/]+$/', $_POST["newDriver"]) && preg_match('/^[0-9]+$/', $_POST["newIdNumber"])) {
				$vehicle = cdi\Vehicle::find($_POST['newVehicleId']);
			   	/*======================================
			   	=            Validar Imagen            =
			   	======================================*/
			   	$ruta="";
			   	if (isset($_FILES['photo1']['tmp_name']) && !empty($_FILES['photo1']['tmp_name'])) {
			   		list($ancho,$alto) = getimagesize($_FILES['photo1']['tmp_name']);
			   		$nuevoAncho = 100;
			   		$nuevoAlto = 133;
			   		/*==========================================
			   		=            CREANDO DIRECTORIO            =
			   		==========================================*/
			   		$directorio = "Views/img/revisiones/".$vehicle->plate;
			   		if (!is_dir($directorio)) {
			   			mkdir($directorio,0755);
			   		}
			   		/*===========================================================================
			   		=            Funciones defecto PHP dependiendo de tipo de imagen            =
			   		===========================================================================*/
			   		switch ($_FILES['photo1']['type']) {
			   			case 'image/jpeg':
			   				$preruta = date('Y-m-d_his');
			   				$preruta = (string)$preruta;
			   				$ruta = $directorio.'/1_'.$preruta.'.jpg';
			   				$origen = imagecreatefromjpeg($_FILES['photo1']['tmp_name']);
			   				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			   				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			   				imagejpeg($destino,$ruta);
			   				break;
			   			case 'image/png':
			   				$preruta = date('Y-m-d_his');
			   				$preruta = (string)$preruta;
			   				$ruta = $directorio.'/1_'.$preruta.'.png';
			   				$origen = imagecreatefrompng($_FILES['photo1']['tmp_name']);
			   				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			   				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			   				imagepng($destino,$ruta);
			   				break;
			   			default:
			   				# code...
			   				break;
			   		}
			   	}
			   	$ruta2="";
			   	if (isset($_FILES['photo2']['tmp_name']) && !empty($_FILES['photo2']['tmp_name'])) {
			   		list($ancho,$alto) = getimagesize($_FILES['photo2']['tmp_name']);
			   		/*==========================================
			   		=            CREANDO DIRECTORIO            =
			   		==========================================*/
			   		$directorio = "Views/img/revisiones/".$vehicle->plate;
			   		if (!is_dir($directorio)) {
			   			mkdir($directorio,0755);
			   		}
			   		/*===========================================================================
			   		=            Funciones defecto PHP dependiendo de tipo de imagen            =
			   		===========================================================================*/
			   		switch ($_FILES['photo2']['type']) {
			   			case 'image/jpeg':
			   				$preruta = date('Y-m-d_his');
			   				$preruta = (string)$preruta;
			   				$ruta2 = $directorio.'/2_'.$preruta.'.jpg';
			   				$origen = imagecreatefromjpeg($_FILES['photo2']['tmp_name']);
			   				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			   				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			   				imagejpeg($destino,$ruta2);
			   				break;
			   			case 'image/png':
			   				$preruta = date('Y-m-d_his');
			   				$preruta = (string)$preruta;
			   				$ruta2 = $directorio.'/2_'.$preruta.'.png';
			   				$origen = imagecreatefrompng($_FILES['photo2']['tmp_name']);
			   				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			   				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			   				imagepng($destino,$ruta2);
			   				break;
			   			default:
			   				# code...
			   				break;
			   		}
			   	}
			   	$recheck = null;
			   	if (isset($_POST['newRecheck']) && !empty($_POST['newRecheck'])) {
			   		$recheck = $_POST['newRecheck'];
			   	}
			   	$vehicle = cdi\Vehicle::find($_POST['newVehicleId']);
			   	$answer = new cdi\Check();
		   		$answer->recheck = $recheck;
			   	$answer->corporation_id = $vehicle->corporation_id;
			   	$answer->vehicle_id = $_POST['newVehicleId'];
			   	$answer->driver = $_POST['newDriver'];
			   	$answer->id_type = $_POST['newIdType'];
			   	$answer->id_number = $_POST['newIdNumber'];
			   	$answer->driver_phone = $_POST['newPhone'];
			   	$answer->interior_cabin = $_POST['newInteriorCabin'];
			   	$answer->exterior_cabin = $_POST['newExteriorCabin'];
			   	$answer->road_equipment = $_POST['newRoadEquipment'];
			   	$answer->fluids_filters = $_POST['newFluidsFilters'];
			   	$answer->direction = $_POST['newDirection'];
			   	$answer->suspension = $_POST['newSuspension'];
			   	$answer->transmision = $_POST['newTransmision'];
			   	$answer->brakes = $_POST['newBrakes'];
			   	$answer->tires = $_POST['newTires'];
			   	$answer->porcentual_summary = $_POST['newPorcentualSummary'];
			   	$answer->check_summary = $_POST['newCheckSummary'];
			   	$answer->general_observations = $_POST['newGeneralObservations'];
			   	$answer->general_state = $_POST['newGeneralState'];
			   	$answer->expiration = Carbon::now()->settings(['monthOverflow' => false,])->addMonths(2);
			   	$answer->photo1 = $ruta;
			   	$answer->photo2 = $ruta2;
			   	$answer->technician_name = $_POST['newTechnicianName'];
			   	$answer->admin_name = session('name');
			   if ($answer->save()) {
			   	$answer->pdf = CheckController::ctrPrintCheck($answer->id);
			   	$answer->save();
			   	try {
				   	$vehicle = cdi\Vehicle::find($answer->vehicle_id);
				   	$corporation = $vehicle->corporation;
				   	// PARAMETROS GENERALES PLANTILLA MAIL
				   	$param_name = cdi\Parameter::where('name','Razon Social')->first();
				   	$param_name = $param_name->value;
				   	$param_logo = cdi\Parameter::where('name','Logo Correo')->first();
				   	$param_logo = $param_logo->value;
				   	$notification = "Resultado Revisión Bimensual ".$vehicle->plate;
				   	//PARAMETROS ESPECIFICOS
				   	$name = $corporation->contact_name;
				   	$plate = $vehicle->plate;
				   	$date = Carbon::now()->format('d/m/Y');
				   	$id = $answer->id;
				   	if ($answer->general_state==1) {
				   		$result = "Aprobado";
				   	}else{
				   		$result = "No aprobado";
				   	}
				   	//ENVIO MAIL
				   	// $mail = MailController::ctrSendMail($name,$corporation->email,'revision',['param_name'=>$param_name, 'param_logo'=>$param_logo, 'notification'=>$notification, 'name'=>$name, 'plate'=>$plate, 'date'=>$date, 'id'=>$id, 'result'=>$result]);
			   	} catch (Exception $e) {}
			   	return redirect('revisiones');
			   }
			 } else {
			 	return view('layouts.checks_error');
			 }
		}

	}
	/*======================================
	=            Borrar Revision           =
	======================================*/
	static public function ctrCheckDelete(){
		if (isset($_POST['idRevision'])) {
		$answer=cdi\Check::find($_POST['idRevision']);
		if ($answer->pdf != "" && $answer->pdf != null) {
			unlink($answer->pdf);
		}
		$answer->delete();
		}
	}
	public function ajaxCheckEdit(){
		$answer = cdi\Check::find($_POST['idRevision'])->load('vehicle');
		echo json_encode($answer);
	} 
	public function ajaxCheckSummary(){
		$answer = cdi\Check::where('vehicle_id',(int)$_POST['idVehiculo'])->orderByDesc('id')->first();
		if (is_object($answer)) {
			$answer = $answer->load('vehicle');
		}
		echo json_encode($answer);
	} 
	/*===============================================
	=            Mostrar tabla Revisiones           =
	===============================================*/
	
	public function ajaxCheckDatatable(){	
		if (session('rank')) {
			if (isset($_POST['fechaInicio']) && $_POST['fechaInicio'] == $_POST['fechaFinal']) {
				$date = Carbon::parse($_POST['fechaInicio']);
				if (session('rank')=='Admin' || session('rank')=='Empleado') {
			  		$checks = cdi\Check::whereDate('created_at', Carbon::parse($_POST['fechaInicio'])->format('Y-m-d'))->get();
				}else{
			  		$user = cdi\Corporation::find(session('id'));
			          $checks = $user->checks;
			  		$checks = $checks->intersect(Check::whereDate('created_at', Carbon::parse($_POST['fechaInicio'])->format('Y-m-d'))->get());
				}
			}elseif (isset($_POST['fechaInicio'])) {
				$startDate = Carbon::parse($_POST['fechaInicio']);
				$endDate = Carbon::parse($_POST['fechaFinal'])->addDay();
				if (session('rank')=='Admin' || session('rank')=='Empleado') {
			  		$checks = cdi\Check::whereBetween('created_at', [$startDate,$endDate])->get();
				}else{
			  		$user = cdi\Corporation::find(session('id'));
			          $checks = $user->checks;
			  		$checks = $checks->intersect(Check::whereBetween('created_at', [$startDate,$endDate])->get());
				}
			}else{
				if (session('rank')=='Admin' || session('rank')=='Empleado') {
			  		$checks = cdi\Check::all();
				}else{
			  		$user = cdi\Corporation::find(session('id'));
			          $checks = $user->checks;
				}
			}
		  	$hoy = Carbon::now();
		  	echo '{
					"data": [';

				for($i = 0; $i < count($checks)-1; $i++){

					$checkExpiration = Carbon::parse($checks[$i]->expiration);
					if ($hoy > $checkExpiration) {
						$expiration ="<button class='btn btn-danger btn-sm'>".$checkExpiration->format('d/m/Y')."</button>";
					}else{
						$expiration ="<button class='btn btn-success btn-sm'>".$checkExpiration->format('d/m/Y')."</button>";
					}
					if ($checks[$i]->general_state == 1) {
						if (session('rank')=='Admin') {
							$adminButtons="<button class='btn btn-danger btnBorrarRevision' idRevision='".$checks[$i]->id."'><i class='fa fa-times'></i></button>";
						}else{
							$adminButtons="";
						}
						$state ="<button class='btn btn-success btn-sm'>APROBADO</button>";
	                    $buttons ="<div class='btn-group'><button class='btn btn-success btnImprimirRevision' idRevision='".$checks[$i]->id."'><i class='fas fa-print'></i></button>".$adminButtons."</div>";
					}else{
						if (session('rank')=='Admin') {
							$adminButtons="<button class='btn btn-warning btnReingresarRevision' idRevision='".$checks[$i]->id."'><i class='fas fa-toolbox'></i></button><button class='btn btn-danger btnBorrarRevision' idRevision='".$checks[$i]->id."'><i class='fa fa-times'></i></button>";
						}elseif (session('rank')=='Empleado') {
							$adminButtons="<button class='btn btn-warning btnReingresarRevision' idRevision='".$checks[$i]->id."'><i class='fas fa-toolbox'></i></button>";
						}else{
							$adminButtons="";
						}
						$state ="<button class='btn btn-danger btn-sm'>NO APROBADO</button>";
	                    $buttons ="<div class='btn-group'><button class='btn btn-success btnImprimirRevision' idRevision='".$checks[$i]->id."'><i class='fas fa-print'></i></button>".$adminButtons."</div>";
					}
					$recheck = "";
					if ($checks[$i]->recheck != null) {
						$recheck = $checks[$i]->recheck;
					}
	                    $identification = "<b>".$checks[$i]->id_type."</b> ".$checks[$i]->id_number;
					 echo '[
				      "R-'.($checks[$i]->id).'",
				      "'.$checks[$i]->vehicle->corporation->name.'",
				      "'.$checks[$i]->vehicle->plate.'",
				      "'.$state.'",
				      "'.$checkExpiration.'",
				      "'.$checks[$i]->driver.'",
				      "'.$identification.'",
				      "'.$checks[$i]->driver_phone.'",
				      "'.$recheck.'",
				      "'.$buttons.'"
				    ],';

				}
					$checkExpiration = Carbon::parse($checks[count($checks)-1]->expiration);
					if ($hoy > $checkExpiration) {
						$expiration ="<button class='btn btn-danger btn-sm'>".$checkExpiration->format('d/m/Y')."</button>";
					}else{
						$expiration ="<button class='btn btn-success btn-sm'>".$checkExpiration->format('d/m/Y')."</button>";
					}
					if ($checks[count($checks)-1]->general_state == 1) {
						if (session('rank')=='Admin') {
							$adminButtons="<button class='btn btn-danger btnBorrarRevision' idRevision='".$checks[count($checks)-1]->id."'><i class='fa fa-times'></i></button>";
						}else{
							$adminButtons="";
						}
						$state ="<button class='btn btn-success btn-sm'>APROBADO</button>";
	                    $buttons ="<div class='btn-group'><button class='btn btn-success btnImprimirRevision' idRevision='".$checks[count($checks)-1]->id."'><i class='fas fa-print'></i></button>".$adminButtons."</div>";
					}else{
						if (session('rank')=='Admin') {
							$adminButtons="<button class='btn btn-warning btnReingresarRevision' idRevision='".$checks[count($checks)-1]->id."'><i class='fas fa-toolbox'></i></button><button class='btn btn-danger btnBorrarRevision' idRevision='".$checks[count($checks)-1]->id."'><i class='fa fa-times'></i></button>";
						}elseif (session('rank')=='Empleado') {
							$adminButtons="<button class='btn btn-warning btnReingresarRevision' idRevision='".$checks[count($checks)-1]->id."'><i class='fas fa-toolbox'></i></button>";
						}else{
							$adminButtons="";
						}
						$state ="<button class='btn btn-danger btn-sm'>NO APROBADO</button>";
	                    $buttons ="<div class='btn-group'><button class='btn btn-success btnImprimirRevision' idRevision='".$checks[count($checks)-1]->id."'><i class='fas fa-print'></i></button>".$adminButtons."</div>";
					}
					$recheck = "";
					if ($checks[count($checks)-1]->recheck != null) {
						$recheck = $checks[count($checks)-1]->recheck;
					}
	                    $identification = "<b>".$checks[count($checks)-1]->id_type."</b> ".$checks[count($checks)-1]->id_number;
					 echo '[
				      "R-'.($checks[count($checks)-1]->id).'",
				      "'.$checks[count($checks)-1]->vehicle->corporation->name.'",
				      "'.$checks[count($checks)-1]->vehicle->plate.'",
				      "'.$state.'",
				      "'.$checkExpiration.'",
				      "'.$checks[count($checks)-1]->driver.'",
				      "'.$identification.'",
				      "'.$checks[count($checks)-1]->driver_phone.'",
				      "'.$recheck.'",
				      "'.$buttons.'"
				    ]
				]
			}';
		}else{
			echo "Wrong Auth!";
		}
	}

	static public function pdfGenerate(){
		$checks = cdi\Check::all();
		foreach ($checks as $check) {
		   	$check->pdf = CheckController::ctrPrintCheck($check->id);
		   	$check->save();
		}
		echo 'Todo ok';
	}


	static public function ctrPrintCheck($id){
        $check = cdi\Check::find($id);
        if (!is_object($check)) {
          return redirect('/');        
        }
		$preruta = date('Y-m-d_his');
		$preruta = (string)$preruta;
        $individualObservations = json_decode($check->check_summary);
        $porcentualItems = json_decode($check->porcentual_summary);
        if ($check->general_state==1) {
        	$generalState='Aprobado';
        }else{
        	$generalState='No aprobado';
        }
        $logo = cdi\Parameter::where('name','Logo Reporte')->first()->value;
        $sign = cdi\Parameter::where('name','Firma Ingeniero')->first()->value;
        $docType = cdi\Parameter::where('name','Tipo Documento')->first()->value;
        $docNumber = cdi\Parameter::where('name','Documento')->first()->value;
        $corpName = cdi\Parameter::where('name','Razon Social')->first()->value;
        $phone = cdi\Parameter::where('name','Telefono')->first()->value;
        $address = cdi\Parameter::where('name','Direccion')->first()->value;
        $vehicle = $check->vehicle;
        setlocale(LC_TIME, 'es_ES');
        date_default_timezone_set('America/Bogota');
        $date = Carbon::parse($check->created_at)->format('Y-m-d');
        $reference = 'R-'.$check->id;
        $html='<html>
<head>
<style>
* {
  box-sizing: border-box;
}
table{
  empty-cells: show;
  border-collapse: collapse;
  border-spacing: 0;
}
img {
  display: block;
  margin-left: auto;
  margin-right: auto;
  max-width: 100%;
}
tr{
  width:100%;
}
td{
  padding: 3px
}
*.backgroung-gray{
background-color: #666666;
}
.row::after {
  content: "";
  clear: both;
  display: table;
}
.row {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  margin-right: -7.5px;
  margin-left: -7.5px;
    width100%;
}
[class*="col-"] {
  float: left;
  padding: 15px;
}
.font-size{
  font-size:18px;
}
.font-size2{
  font-size:14px;
}
.font-size3{
  font-size:12px;
}
.font-size4{
  font-size:10px;
}
.font-size5{
  font-size:8px;
}
.w-100{
  width:100%;
}
.pl{
  padding-left:5%
}
.m1{
    margin-bottom: 5px;
}
.m2{
    margin-bottom: 15px;
}
*.col-1 {width: 8.33%;}
*.col-2 {width: 16.66%;}
*.col-3 {width: 25%;}
*.col-4 {width: 33.33%;}
*.col-5 {width: 41.66%;}
*.col-6 {width: 50%;}
*.col-7 {width: 58.33%;}
*.col-8 {width: 66.66%;}
*.col-9 {width: 75%;}
*.col-10 {width: 83.33%;}
*.col-11 {width: 91.66%;}
*.col-12 {width: 100%;}
.btn {
  display: inline-block;
  font-weight: 400;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  user-select: none;
  border: 1px solid transparent;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  border-radius: 0.25rem;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.btn-success {
  color: #ffffff;
  background-color: #28a745;
  border-color: #28a745;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075);
  border-radius: 5px;
  border: 1px solid;
}
.btn-warning {
  color: #1F2D3D;
  background-color: #ffc107;
  border-color: #ffc107;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075);
  border-radius: 5px;
  border: 1px solid;
}
.btn-danger {
  color: #ffffff;
  background-color: #dc3545;
  border-color: #dc3545;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075);
  border-radius: 5px;
  border: 1px solid;
}
</style>
</head>
<body>
    <table cellspacing="0" class="m2" style="width:100%">
      <tr>
        <td class="col-2" style="text-align:center"><img src="'.$logo.'" alt="Logotipo CISAS"></td>
        <td class="col-3" style="text-align:left"><span class="font-size"><b>'.mb_strtoupper($docType).': </b>'.$docNumber.'</span></td>
        <td class="col-2" style="border: 1px solid #000; text-align:center"><span class="font-size">FECHA: <br>'.$date.'</span></td>
        <td class="col-4" style="border: 1px solid #000; text-align:center"><span class="font-size"><b>MANTENIMIENTO PREVENTIVO BIMENSUAL</b></span></td>
        <td class="col-4" style="border: 1px solid #000; text-align:center"><span class="font-size">'.$reference.'</span></td>
      </tr>
    </table>
    <table cellspacing="0" class="m2" style="width:100%">
      <tr>
        <td class="col-1" style="border: 1px solid #000; text-align:center"><span class="font-size2"><b>PLACA</b></span></td>
        <td class="col-2" style="border: 1px solid #000; text-align:center"><span class="font-size2"><b>MARCA</b></span></td>
        <td class="col-1" style="border: 1px solid #000; text-align:center"><span class="font-size2"><b>MATRÍCULA</b></span></td>
        <td class="col-4" style="border: 1px solid #000; text-align:center"><span class="font-size2"><b>NOMBRE</b></span></td>
        <td class="col-2" style="border: 1px solid #000; text-align:center"><span class="font-size2"><b>TELÉFONO</b></span></td>
        <td class="col-1" style="border: 1px solid #000; text-align:center"><span class="font-size2"><b>SOAT</b></span></td>
        <td class="col-1" style="border: 1px solid #000; text-align:center"><span class="font-size2"><b>TMECÁNICA</b></span></td>
       </tr>
      <tr>
        <td class="col-1" style="border: 1px solid #000; text-align:center"><span class="font-size2">'.$vehicle->plate.'</span></td>
        <td class="col-2" style="border: 1px solid #000; text-align:center"><span class="font-size2">'.$vehicle->brand.'</span></td>
        <td class="col-1" style="border: 1px solid #000; text-align:center"><span class="font-size2">'.$vehicle->inscription.'</span></td>
        <td class="col-4" style="border: 1px solid #000; text-align:center"><span class="font-size2">'.$check->driver.'</span></td>
        <td class="col-2" style="border: 1px solid #000; text-align:center"><span class="font-size2">'.$check->driver_phone.'</span></td>
        <td class="col-1" style="border: 1px solid #000; text-align:center"><span class="font-size2">'.Carbon::parse($vehicle->SOAT_expiration)->format('d/m/Y').'</span></td>
        <td class="col-1" style="border: 1px solid #000; text-align:center"><span class="font-size2">'.Carbon::parse($vehicle->technician_check_expiration)->format('d/m/Y').'</span></td>
       </tr>
    </table>
    <table cellspacing="0" class="m2" style="width:100%">
      <tr>
        <td class="col-6" style="border: 1px solid #000; text-align:center"><span class="font-size3"><b>NOMBRE</b></span></td>
        <td class="col-2" style="border-top: 1px solid #000; border-bottom: 1px solid #000; text-align:center"><span class="font-size3"><b>ESTADO</b></span></td>
        <td class="col-4" style="border: 1px solid #000; text-align:center"><span class="font-size3"><b>OBSERVACIONES</b></span></td>
       </tr>
      <tr>
        <td class="col-6" style="border-left: 1px solid #000; border-right: 1px solid #000; text-align:left"><span class="font-size3">CABINA INTERIOR</span></td>
        <td class="col-2" style="text-align:left"><span class="font-size3">'.$check->interior_cabin.'</span></td>
        <td class="col-4" rowspan="8" style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align:left"><span class="font-size4">';
        foreach ($individualObservations as $observation) {
        	$html .= '<b>'.$observation->description.'</b> ('.$observation->value.') : '.$observation->observations.'<br>';
        }
        $html .= '<br><b>Oservaciones Generales: </b>'.$check->general_observations.'</span></td>
       </tr>
      <tr>
        <td class="col-6" style="border-left: 1px solid #000; border-right: 1px solid #000; text-align:left"><span class="font-size3">CABINA EXTERIOR</span></td>
        <td class="col-2" style="text-align:left"><span class="font-size3">'.$check->exterior_cabin.'</span></td>
       </tr>
      <tr>
        <td class="col-6" style="border-left: 1px solid #000; border-right: 1px solid #000; text-align:left"><span class="font-size3">EQUIPO DE CARRETERA</span></td>
        <td class="col-2" style="text-align:left"><span class="font-size3">'.$check->road_equipment.'</span></td>
       </tr>
      <tr>
        <td class="col-6" style="border-left: 1px solid #000; border-right: 1px solid #000; text-align:left"><span class="font-size3">NIVELES Y ESTADOS DE FLUIDOS Y FILTROS</span></td>
        <td class="col-2" style="text-align:left"><span class="font-size3">'.$check->fluids_filters.'</span></td>
       </tr>
      <tr>
        <td class="col-6" style="border-left: 1px solid #000; border-right: 1px solid #000; text-align:left"><span class="font-size3">SISTEMA DE DIRECCIÓN</span></td>
        <td class="col-2" style="text-align:left"><span class="font-size3">'.$check->direction.'</span></td>
       </tr>
      <tr>
        <td class="col-6" style="border-left: 1px solid #000; border-right: 1px solid #000; text-align:left"><span class="font-size3">SISTEMA DE SUSPENSIÓN</span></td>
        <td class="col-2" style="text-align:left"><span class="font-size3">'.$check->suspension.'</span></td>
       </tr>
      <tr>
        <td class="col-6" style="border-left: 1px solid #000; border-right: 1px solid #000; text-align:left"><span class="font-size3">SISTEMA DE TRANSMISIÓN (ESTADO Y FUGAS)</span></td>
        <td class="col-2" style="text-align:left"><span class="font-size3">'.$check->transmision.'</span></td>
       </tr>
      <tr>
        <td class="col-6" style="border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align:left"><span class="font-size3">FRENOS</span></td>
        <td class="col-2" style="border-bottom: 1px solid #000; text-align:left"><span class="font-size3">'.$check->brakes.'</span></td>
      </tr>
    </table>
    <table cellspacing="0" class="m2" style="width:100%">
      <tr>
        <td class="col-4" colspan="2" style="border: 1px solid #000; text-align:center"><span class="font-size3"><b>NIVELES LÍQUIDOS</b></span></td>
        <td class="col-4" colspan="2" style="border: 1px solid #000; text-align:center"><span class="font-size3"><b>LLANTAS</b></span></td>
        <td class="col-4" rowspan="6" style="text-align:center"><span class="font-size3">Los valores porcentuales se aprueban con valores superiores al 20%</span></td>
       </tr>
      <tr>
        <td class="col-3" colspan="2" style="border-left: 1px solid #000; border-right: 1px solid #000; text-align:left"><span class="font-size3"><b>'.$check->fluids_filters.'</b></span></td>
        <td class="col-3" colspan="2" style="border-left: 1px solid #000; border-right: 1px solid #000; text-align:left"><span class="font-size3"><b>'.$check->tires.'</b></span></td>
       </tr>';
       for ($i = 0; $i < 4; $i++) {
	       	$j= $i+4;
	       	$button1="";
	       	$button2="";
	       	if ((int)$porcentualItems[$i]->value<21) {
	       		$button1 = '<div class="btn btn-danger">'.$porcentualItems[$i]->value.' %</div>';
	       	}elseif ((int)$porcentualItems[$i]->value>79) {
	       		$button1 = '<div class="btn btn-success">'.$porcentualItems[$i]->value.' %</div>';
	       	}else{
	       		$button1 = '<div class="btn btn-warning">'.$porcentualItems[$i]->value.' %</div>';
	       	}
	       	if ((int)$porcentualItems[$j]->value<21) {
	       		$button2 = '<div class="btn btn-danger">'.$porcentualItems[$j]->value.' %</div>';
	       	}elseif ((int)$porcentualItems[$j]->value>79) {
	       		$button2 = '<div class="btn btn-success">'.$porcentualItems[$j]->value.' %</div>';
	       	}else{
	       		$button2 = '<div class="btn btn-warning">'.$porcentualItems[$j]->value.' %</div>';
	       	}
	       $html .= '<tr>
	        <td class="col-2" style="border-left: 1px solid #000; '; 
	        if ($i == 3) {
	        	$html .= 'border-bottom: 1px solid #000; ';
	        }
	        $html .= 'text-align:left"><span class="font-size3">'.$porcentualItems[$i]->description.'</span></td>
	        <td class="col-1" style="border-right: 1px solid #000; '; 
	        if ($i == 3) {
	        	$html .= 'border-bottom: 1px solid #000; ';
	        }
	        $html .= 'text-align:center"><span class="font-size3">'.$button1.'</span></td>
	        <td class="col-2" style="border-left: 1px solid #000; '; 
	        if ($i == 3) {
	        	$html .= 'border-bottom: 1px solid #000; ';
	        }
	        $html .= 'text-align:left"><span class="font-size3">'.$porcentualItems[$j]->description.'</span></td>
	        <td class="col-1" style="border-right: 1px solid #000; '; 
	        if ($i == 3) {
	        	$html .= 'border-bottom: 1px solid #000; ';
	        }
	        $html .= 'text-align:center"><span class="font-size3">'.$button2.'</span></td>
	       </tr>';
      }

      $html .= '</table>
    <table cellspacing="0" class="m2" style="width:100%">
      <tr>
        <td class="col-6" colspan="2" style="width: 340px;border: 1px solid #000; text-align:left"><span class="font-size5"><b>DIAGNOSTICO DE MANTENIMIENTO PREVENTIVO BIMENSUAL EN CUMPLIMIENTO DE LA RESOLUCION 315 DE 2013 ART 3°__Mantenimiento de vehiculos.</b> El mantenimiento preventivo se realizará a cada vehiculo en los periodos determinados por la empresa, para lo cual se garantizará como minimo el mantenimiento bimensual, llevando una ficha de mantenimiento donde consignará el registro de las intervenciones y reparaciones realizadas, indicando día, mes y año, centro especializado e ingenieromecánico que lo realizó y el detalle de las actividades adelantadas durante la labor. En la ficha de mantenimiento además, se relacionarán las intervenciones correctivas realizadas indicando dia, mes y año, centro especializado y técnico que realizó el mantenimiento, detalle de las actividades adelantadas durante la labor de mantenimiento correctivo y la aprobacion de la empresa.</span></td>
        <td class="col-6" colspan="2" style="border: 1px solid #000; text-align:left"><span class="font-size5"><b>TIPOS DE ESTADO: </b><br><br><b>Aprobado: </b> Vehículo en condiciones mecánicas de operar.<br><br><b>No aprobado: </b> El vehículo presenta fallas que pueden implicar accidentes o daños en la integridad fisica de las personas al interior y exterior de los vehículos. No se garantiza su seguridad.</span></td>
       </tr>
       <tr>
        <td class="col-3" style="border-left: 1px solid #000; border-bottom: 1px solid #000; text-align:center"><span class="font-size3"><u>'.mb_strtoupper($check->technician_name).'</u><br><b>TÉCNICO</b></span></td>
        <td class="col-3" style="border-bottom: 1px solid #000; text-align:center"><span class="font-size3"><u>'.mb_strtoupper($check->admin_name).'</u><br><b>APROBADO POR</b></span></td>
        <td class="col-3" style="border: 1px solid #000; text-align:center"><span class="font-size3"><b>'.mb_strtoupper($generalState).'</b></span></td>
        <td class="col-3" style="border: 1px solid #000; text-align:center"><span class="font-size3"><b>INGENIERO</b><br><img src="'.$sign.'" alt="Firma Ingeniero"></span></td>
       </tr>
  </table>
  <table cellspacing="0" style="width:100%">
  <tr>
	  <td class="col-3">
	  	<img src="'.$check->photo1.'" alt="Foto frontal">
	  	<img src="'.$check->photo2.'" alt="Foto trasera">
	  </td>
	  <td class="col-9">
	  &nbsp;
	  </td>
  </tr>
</table>
</body>
</html>';
$footer=
'<table cellspacing="0" style="width:100%">
  <tr>
	  <td class="col-3">
	  	<span class="font-size3"><b>'.$docType.': </b>'.$docNumber.'</span>
	  </td>
	  <td class="col-3">
	  	<span class="font-size3">'.$corpName.'</span>
	  </td>
	  <td class="col-3">
	  	<span class="font-size3">'.$address.'</span>
	  </td>
	  <td class="col-3">
	  	<span class="font-size3"><b>Tel: </b>'.$phone.'</span>
	  </td>
  </tr>
</table>';
        $mpdf = new \Mpdf\Mpdf([
            'default_font' => 'rubik',
            'mode' => 'utf-8', 
            'format' => 'Letter',]);;
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->SetProtection(array('print','print-highres'), '', '');
        $mpdf->defaultfooterline = 1;
        $mpdf->setFooter($footer);
        $mpdf->WriteHTML($html);
        $ruta = 'Views/documents/'.$preruta.'_'.$vehicle->plate.'.pdf';
        $mpdf->Output('Views/documents/'.$preruta.'_'.$vehicle->plate.'.pdf','F'); 
        return $ruta;
	}
}
