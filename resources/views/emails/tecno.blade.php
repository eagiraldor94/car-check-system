@extends('emails.mail')
@section('body')
<div class="row">
	<p>Buen día señor@ {{$name}}</p>

	<div class="row" style="width: 100%; text-align: center;">
	<h3 class="align-self-center" style="color:#000; text-decoration: none; font-size: 18px">La plataforma <span style="color:#000; text-decoration: none;">{{$param_name}}</span> le informa que <b>la revisión técnico-mecánica para el vehículo de placa {{$plate}} se encuentra proxima a vencer.</b></h3>
	</div>

	<h5><b>Fecha de vencimiento: </b>{{$expiration_date}}</h5>
	
	<div class="row" style="width: 100%; text-align: justify;">
	<span style="font-size: 15px"><p>Este es un servicio gratuito que prestamos a nuestros clientes con el fin de evitarles inconvenientes.</p></span></div>
</div>
@stop