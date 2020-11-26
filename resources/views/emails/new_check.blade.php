@extends('emails.mail')
@section('body')
<div class="row">
	<p>Buen día señor@ {{$name}}</p>

	<div class="row" style="width: 100%; text-align: center;">
	<h3 class="align-self-center" style="color:#000; text-decoration: none; font-size: 18px">La plataforma <span style="color:#000; text-decoration: none;">{{$param_name}}</span> le informa que <b>el vehículo de placa {{$plate}} tiene pendiente su proxima revisión bimensual para el día:</b></h3>
	</div>

	<h5><b>{{$expiration_date}}</b></h5>
	
	<div class="row" style="width: 100%; text-align: justify;">
	<span style="font-size: 15px"><p>Ante cualquier duda puede comunicarse con nosotros al teléfono {{$phone}} o visitarnos en la dirección {{$address}} y será un placer atender sus solicitudes.</p></span></div>
</div>
@stop