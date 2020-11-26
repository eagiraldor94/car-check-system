@extends('base_layout')
@section('title')
	Error
@stop
@section('content')
<script>
	swal({
		type: "error",
		title: "¡El vehiculo tiene la revisión técnico mecánica vencida, por favor actualice para continuar!",
		showConfirmButton: true,
		confirmButtonText: "Cerrar",
		closeOnConfirm: false
		}).then((result)=>{
				if(result.value){
					window.location = "/vehiculos";
			}
		});
</script>
@stop