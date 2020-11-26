
/*================================================
=            CARGAR LA TABLA DINAMICA            =
================================================*/
$(function(){
  var table = $('.tablaVehiculos').DataTable({

  "ajax":{
      "url": "ajax/datatable/vehiculos",
      "type": "POST"
    },
  "deferRender": true,
  "retrieve": true,
  "processing": true,
  "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
    "sFirst":    "Primero",
    "sLast":     "Último",
    "sNext":     "Siguiente",
    "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

  }


 });
});
/*==============================================
=            EDITAR USUARIO            =
==============================================*/
$(function(){
  $(document).on('click', '.btnEditarVehiculo' ,function(){
    var idVehiculo = $(this).attr("idVehiculo");
    var datos = new FormData();
    datos.append("idVehiculo", idVehiculo);
    $.ajax({
      url:"ajax/vehiculos/editar",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(answer){
        $('#editId').val(answer['id']);
        $('#editIdEmpresa').val(answer['corporation']['id']);
        $('#editPlacaVehiculo').val(answer['plate']);
        $('#editModeloVehiculo').val(answer['model']);
        $('#editMarcaVehiculo').val(answer['brand']);
        $('#editClaseVehiculo').val(answer['type']);
        $('#editFechaVencimientoSOAT').val(moment(answer['SOAT_expiration']).format("DD/MM/YYYY"));
        $('#editFechaVencimientoTecno').val(moment(answer['technician_check_expiration']).format("DD/MM/YYYY"));
        $('#editMatricula').val(answer['inscription']);
        $('#editNombre').val(answer['propietary']);
        $('#editTipoDocumento').val(answer['id_type']);
        $('#editNumeroDocumento').val(answer['id_number']);
      }
    })
  });
});
/*==============================================
=            VERIFICACION DE  PLACA          =
==============================================*/
$(function(){
  $(document).on( 'change', '#nuevoPlacaVehiculo' ,function(){
    $(".alert").remove();
    var placa = $(this).val();
    var datos = new FormData();
    datos.append("placa", placa);
    $.ajax({
      url:"ajax/vehiculos/check",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(answer){
        if (answer) {
            $("#nuevoPlacaVehiculo").parent().after('<div class="alert alert-warning">Este vehículo ya se encuentra registrado</div>');
            $("#nuevoPlacaVehiculo").val("");
        }
      }
    })
  });
});
/*==============================================
=            VERIFICACION DE  PLACA          =
==============================================*/
$(function(){
  $(document).on( 'change', '#editPlacaVehiculo' ,function(){
    $(".alert").remove();
    var placa = $(this).val();
    var datos = new FormData();
    datos.append("placa", placa);
    $.ajax({
      url:"ajax/vehiculos/check",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(answer){
        if (answer) {
            $("#editPlacaVehiculo").parent().after('<div class="alert alert-warning">Este vehículo ya se encuentra registrado</div>');
            $("#editPlacaVehiculo").val("");
        }
      }
    })
  });
});
/*==============================================
=            ELIMINAR UNIDAD          =
==============================================*/
$(function(){
  $(document).on( 'click', ".btnBorrarVehiculo" ,function(){
    var idVehiculo = $(this).attr("idVehiculo");
    swal({
      title: '¿Está seguro de borrar el vehiculo?',
      text: "¡Si no lo está puede cancelar la acción!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Confirmar borrado de vehiculo'
    }).then((result)=>{
      if(result.value){
      var datos = new FormData();
      datos.append("idVehiculo", idVehiculo);
      $.ajax({
        url:"ajax/vehiculos/borrar",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(answer){
        }
      });
      window.location="vehiculos";
      }
    });
  });
});