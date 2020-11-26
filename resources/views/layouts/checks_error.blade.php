@extends('base_layout')
@section('title')
	Error
@stop
@section('content')
<script>
	swal({
		type: "error",
		title: "¡El nombre del conductor no puede llevar simbolos o caracteres especiales y su documento solo debe estar compuesto de números!",
		showConfirmButton: true,
		confirmButtonText: "Cerrar",
		closeOnConfirm: false
		}).then((result)=>{
				if(result.value){
					window.location = "/revisiones";
			}
		});
</script>
@stop