@extends('emails.mail')
@section('body')
<div class="row">
	<p>Buen día señor@ {{$name}}</p>

	<div class="row" style="width: 100%; text-align: center;">
	<h3 class="align-self-center" style="color:#000; text-decoration: none; font-size: 18px">La plataforma <span style="color:#000; text-decoration: none;">{{$param_name}}</span> le informa que el resultado de la revisión bimensual para el vehículo de placa {{$plate}} fue: <b>{{mb_strtoupper($result)}}.</b></h3>
	</div>

	<h5><b>Fecha: </b>{{$date}}</h5>
	
	<div class="row" style="width: 100%; text-align: justify;">
	<span style="font-size: 15px"><p>Si desea revisar el reporte completo por favor haga click en el siguiente enlace.</p></span></div><br><br><br>
	<div class="row" style="width: 100%; text-align: center;">
	<b><a style="color:#fff; text-decoration: none; font-size: 20px; background-color: #2b3a8c; border-radius: 5px; padding: 8px 20px" href="https://revisiones.cdi-sas.com/resultado/{{$id}}" class="btn btn-primary">Ver informe de resultado</a></b></div>
</div>
@stop