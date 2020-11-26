
/*================================================
=            CARGAR LA TABLA DINAMICA            =
================================================*/
$(function(){
  var table = $('.tablaEmpresas').DataTable({

  "ajax":{
      "url": "ajax/datatable/empresas",
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
=            SUBIR LOGO            =
==============================================*/
$(function(){
  $(document).on('change','.logo',function(){
  var imagen = this.files[0];
  // validar imagen jpg o png
  if(imagen['type'] != "image/jpeg" && imagen['type'] != "image/png"){
    $('.logo').val("");
    swal({
          title: "Error al subir la imagen",
          text: "La imagen debe estar en formato JPG o PNG",
          type: "error",
          confirmButtonText: "¡Entendido!"
        });
  }else if(imagen['size'] > 2097152){
    $('.logo').val("");
    swal({
          title: "Error al subir la imagen",
          text: "La imagen debe pesar menos de 2MB",
          type: "error",
          confirmButtonText: "¡Entendido!"
        });  
  }else{
    var datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function(event){
      var rutaImagen = event.target.result;
      $(".previsualizar").attr("src",rutaImagen);
    })
  }
});
});
/*==============================================
=            EDITAR EMPRESA            =
==============================================*/
$(function(){
  $(document).on('click', '.btnEditarEmpresa' ,function(){
    var idEmpresa = $(this).attr("idEmpresa");
    var datos = new FormData();
    datos.append("idEmpresa", idEmpresa);
    $.ajax({
      url:"ajax/empresas/editar",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(answer){
        $('#editId').val(answer['id']);
        $('#editNombre').val(answer['name']);
        $('#editTipoDocumento').val(answer['id_type']);
        $('#editNumeroDocumento').val(answer['id_number']);
        $('#editTelefono').val(answer['phone']);
        $('#editEmail').val(answer['email']);
        $('#editCiudad').val(answer['city']);
        $('#editDireccion').val(answer['address']);
        $('#editNombreContacto').val(answer['contact_name']);
        $('#editUser').val(answer['username']);
        $('#password').val(answer['password']);

        $('#lastLogo').val(answer['photo']);
        
        if (answer['photo'] != "") {
          $('#logoEdit').attr("src",answer['photo']);
        }
        
      }
    })
  });
});
/*==============================================
=            ACTIVAR O DESACTIVAR USUARIO            =
==============================================*/
$(function(){
  $(document).on('click', '.btnActivarEmpresa' ,function(){
    var idEmpresa = $(this).attr("idEmpresa");
    var estadoEmpresa = $(this).attr("estadoEmpresa");
    var datos = new FormData();
    datos.append("activarEmpresa", idEmpresa);

    datos.append("estadoEmpresa", estadoEmpresa);
    $.ajax({
      url:"ajax/empresas/activar",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function(answer){
        window.location = "empresas";
      }
    })
  });
});
/*==============================================
=            VERIFICACION DE DOCUMENTO          =
==============================================*/
$(function(){
  $(document).on( 'change', '#nuevoNumeroDocumento' ,function(){
    $(".alert").remove();
    var numeroId = $(this).val();
    var tipoId = $('#nuevoTipoDocumento').val();
    var datos = new FormData();
    datos.append("numeroId", numeroId);
    datos.append("tipoId", tipoId);
    $.ajax({
      url:"ajax/empresas/check",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(answer){
        if (answer) {
            $("#nuevoNumeroDocumento").parent().after('<div class="alert alert-warning">Este documento ya se encuentra registrado</div>');
            $("#nuevoNumeroDocumento").val("");
        }
      }
    })
  });
});
/*==============================================
=            VERIFICACION DE DOCUMENTO          =
==============================================*/
$(function(){
  $(document).on( 'change', '#editNumeroDocumento' ,function(){
    $(".alert").remove();
    var numeroId = $(this).val();
    var tipoId = $('#editTipoDocumento').val();
    var datos = new FormData();
    datos.append("numeroId", numeroId);
    datos.append("tipoId", tipoId);
    $.ajax({
      url:"ajax/empresas/check",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(answer){
        if (answer) {
            $("#editNumeroDocumento").parent().after('<div class="alert alert-warning">Este documento ya se encuentra registrado</div>');
            $("#editNumeroDocumento").val("");
        }
      }
    })
  });
});
/*==============================================
=            ELIMINAR EMPRESA          =
==============================================*/
$(function(){
  $(document).on( 'click', ".btnBorrarEmpresa" ,function(){
    var idEmpresa = $(this).attr("idEmpresa");
    var fotoEmpresa = $(this).attr("fotoEmpresa");
    swal({
      title: '¿Está seguro de borrar la empresa?',
      text: "¡Si no lo está puede cancelar la acción!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Confirmar borrado de empresa'
    }).then((result)=>{
      if(result.value){
      var datos = new FormData();
      datos.append("idEmpresa", idEmpresa);
      datos.append("fotoEmpresa", fotoEmpresa);
      $.ajax({
        url:"ajax/empresas/borrar",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(answer){
        }
      });
      window.location="empresas";
      }
    });
  });
});