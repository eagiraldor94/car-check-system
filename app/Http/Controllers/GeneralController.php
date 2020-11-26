<?php

namespace cdi\Http\Controllers;
use cdi;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function homeView(Request $request){
      if (session('rank')!= null && session('rank') != "") {
      	if (session('rank')=='Admin' || session('rank')=='Empleado') {
      		$usuarios = cdi\User::all();
      		$empresas = cdi\Corporation::all();
      		$vehiculos = cdi\Vehicle::all();
      		$revisiones = cdi\Check::all();
          return view('layouts.home',['usuarios'=>$usuarios,'empresas'=>$empresas,'vehiculos'=>$vehiculos,'revisiones'=>$revisiones]);
      	}else{
      		$empresas = cdi\Corporation::where('id',session('id'))->get();
      		$vehiculos = cdi\Vehicle::where('corporation_id',session('id'))->get();
          $revisiones = $empresas[0]->checks;
          return view('layouts.home',['empresas'=>$empresas,'vehiculos'=>$vehiculos,'revisiones'=>$revisiones]);
      	}
      }else{
      	  $logo = cdi\Parameter::where('name','Logo Login')->first();
          return view('layouts.home',['logo'=>$logo->value]);
      }
  }
    public function usersView(Request $request){
      if ($request->session()->get('rank')=="Admin") {
          return view('layouts.users');
      }else{
          return view('layouts.404');
      }
  }
    public function corporationsView(Request $request){
      if (session('rank')=='Admin' || session('rank')=='Empleado') {
          return view('layouts.corporations');
      }else{
          return view('layouts.404');
      }
  }
    public function vehiclesView(Request $request){
      if (session('rank')=='Admin' || session('rank')=='Empleado') {
			$empresas = cdi\Corporation::all();
        	return view('layouts.vehicles',['empresas'=>$empresas]);
      }else{
      		return view('layouts.404');
      }
  }
    public function checksView(Request $request){
      if (session('rank')) {
        return view('layouts.checks');
      }else{
          return view('layouts.404');
      }
  }
    public function parametersView(Request $request){
		if ($request->session()->get('rank')=='Admin') {
	    	$parameters = cdi\Parameter::all();
	    	return view('layouts.parameters',['parameters'=>$parameters]);
		}else{
		    return redirect('/');
		}
	}

    public function resultView($id){

        $check = cdi\Check::find($id);
        return redirect($check->pdf);
    }

    public function newCheckView($last=null){
      if (session('rank')=="Admin" || session('rank')=="Empleado") {
      	$firstItems=['Mando direccional derecha','Mando direccional izquierda','Mando de luz baja','Mando de luz media','Mando de luz alta', 'Mando limpiavidrios','Espejo retrovisor cabina','Cinturon de seguridad pasajero','Cinturon de seguridad conductor','Cinturones de seguridad traseros','Manija int puerta delantera derecha','Manija int puerta delantera izquierda','Manija int puerta trasera derecha','Manija int puerta trasera izquierda','Elevavidrios'];
      	$secondItems=['Luces bajas','Luces altas','Luces traseras','Luces de freno','Luz de cruce delantera','Luz de cruce trasera','Luz intermitente delantera','Luz intermitente trasera','Luz de reversa','Espejo retrovisor derecho','Espejo retrovisor izquierdo','Plumillas','Manija ext puerta delantera derecha','Manija ext puerta delantera izquierda','Manija ext puerta trasera derecha','Manija ext puerta trasera izquierda'];
      	$thirdItems=['Gato hidráulico','Llanta de repuesto','Llave de pernos','Banderillas','Botiquín','Cuñas','Extintor de seguridad'];
      	$fourthItems=['Aceite motor','Líquido refrigerante','Aceite de transmisión','Aceite de dirección y/o hidráulico','Líquido de frenos','Estado de batería','Agua parabrisas','Filtro aire','Filtro combustible','Presión de llantas'];
      	$fifthItems=['Dirección','Mangueras y conexiones','Tuberías','Brazo de dirección','Terminales de dirección'];
      	$sixthItems=['Suspensión delantera','Suspensión trasera','Muelles rueda trasera izquierdo','Muelles rueda trasera derecha','Barra tensora','Bieleta'];
      	$seventhItems=['Diferencial','Caja de velocidades','Cardan','Cruceta cardan'];
      	$eighthItems=['Disco delantero izquierdo','Disco delantero derecho','Pasta de freno izquierdo','Pasta de freno derecho','Caliper y/ mordaza delantero izquierdo','Caliper y/ mordaza delantero derecho', 'Campana trasera izquierda','Campana trasera derecha','Banda de freno trasera izquierda','Banda de freno trasera derecha','Cilindro trasero izquierdo','Cilindro trasero derecho','Freno de emergencia'];
      	$ninethItems=['Llanta delantera derecha','Llanta delantera izquierda','Llanta trasera derecha','Llanta trasera izquierda'];
      	  if ($last != null) {
      	  	$check = cdi\Check::find($last);
      	  	$vehicles = cdi\Vehicle::where('id',$check->vehicle_id)->get();
      	  	$recheck = 'R-'.$check->id;
      	  	$pendings = json_decode($check->check_summary,true);
      	  	return view('layouts.new_check',['vehicles'=>$vehicles,'check'=>$check,'recheck'=>$recheck,'pendings'=>$pendings,'firstItems'=>$firstItems,'secondItems'=>$secondItems,'thirdItems'=>$thirdItems,'fourthItems'=>$fourthItems,'fifthItems'=>$fifthItems,'sixthItems'=>$sixthItems,'seventhItems'=>$seventhItems,'eighthItems'=>$eighthItems,'ninethItems'=>$ninethItems]);
      	  }else{
      	  	$vehicles = cdi\Vehicle::all();
      	  	return view('layouts.new_check',['vehicles'=>$vehicles,'firstItems'=>$firstItems,'secondItems'=>$secondItems,'thirdItems'=>$thirdItems,'fourthItems'=>$fourthItems,'fifthItems'=>$fifthItems,'sixthItems'=>$sixthItems,'seventhItems'=>$seventhItems,'eighthItems'=>$eighthItems,'ninethItems'=>$ninethItems]);
      	  }
          return view('layouts.404');
      }else{
          return view('layouts.404');
      }
  }
    public function SOATError(){
      return view('layouts.SOAT_error');
  }
    public function technicianError(){
      return view('layouts.technician_error');
  }
}
