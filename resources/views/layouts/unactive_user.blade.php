@extends('base_layout')
@section('title')
	Usuario Inactivo
@stop
@section('content')
<script>
	swal({
		type: "error",
		title: "¡Este usuario se encuentra desactivado, por favor contacte al administrador!",
		showConfirmButton: true,
		confirmButtonText: "Cerrar",
		closeOnConfirm: false
		}).then((result)=>{
				if(result.value){
					window.location = "/";
			}
		});
</script>
@stop