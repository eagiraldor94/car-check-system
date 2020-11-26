
/*==============================================
=            AGREGAR PRODUCTOS A LA VENTA         =
==============================================*/
 $(function(){
  var description;
  var pendientes = [];
  var state = 1;
  var count = 0;
  var idVehiculo = $('#nuevoIdVehiculo').val();
  if (idVehiculo != "") {
    var datos = new FormData();
    datos.append("idVehiculo", idVehiculo);
    $.ajax({
      url:"/ajax/revisiones/check",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(answer){
        if (answer != null) {
          pendientes = JSON.parse(answer.check_summary);
        }
      }
    });
  }
/*==============================================
=            CARGAR REVISION            =
==============================================*/
  $(document).on('change', '#nuevoIdVehiculo' ,function(){
    var idVehiculo = $(this).val();
    var datos = new FormData();
    var nullCheck = 0;
    datos.append("idVehiculo", idVehiculo);
    $.ajax({
      url:"/ajax/revisiones/check",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(answer){
        $('.pendings-alert').empty();
        $(".alert.alert-danger").remove();
        if (answer != null) {
          var soat = moment(answer.vehicle['SOAT_expiration']);
          var tecno = moment(answer.vehicle['technician_check_expiration']);
          var now = moment();
          if (now.isAfter(soat)) {
              $("#nuevoIdVehiculo").parent().after('<div class="alert alert-danger">El SOAT se encuentra vencido, actualice para continuar</div>');
              $("#nuevoIdVehiculo").val("");
          }else if (now.isAfter(tecno)) {
              $("#nuevoIdVehiculo").parent().after('<div class="alert alert-danger">La revisión técnico mecánica se encuentra vencida, actualice para continuar</div>');
              $("#nuevoIdVehiculo").val("");
          }else{
            pendientes = JSON.parse(answer.check_summary);
            for (var i = 0; i < pendientes.length; i++) {
              $('.pendings-alert').append('<p><b>'+pendientes[i]['description']+': </b> '+pendientes[i]['value']+'<br/>'+
                '<b>Observaciones: </b>'+pendientes[i]['observations']+'</p>');
            }
            $('.pendings-alert').append('<p><b>Observaciones generales: </b>'+answer.general_observations+'</p>');
          }
        }else{
          $.ajax({
            url:"/ajax/vehiculos/editar",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(answer){
                var soat = moment(answer['SOAT_expiration']);
                var tecno = moment(answer['technician_check_expiration']);
                var now = moment();
                if (now.isAfter(soat)) {
                    $("#nuevoIdVehiculo").parent().after('<div class="alert alert-danger">El SOAT se encuentra vencido, actualice para continuar</div>');
                    $("#nuevoIdVehiculo").val("");
                }else if (now.isAfter(tecno)) {
                    $("#nuevoIdVehiculo").parent().after('<div class="alert alert-danger">La revisión técnico mecánica se encuentra vencida, actualice para continuar</div>');
                    $("#nuevoIdVehiculo").val("");
                }
              }
          });
        }
      }
      });
      if (nullCheck == 1) {
      }
    });
  $(document).on('change','select.individual-parameters', function(){
      $(this).parent().parent().children('.input-observations').remove();
    if ($(this).val() != 'Aprobado' && $(this).val() != '') {
      $(this).parent().parent().append(
        '<div class="input-group mb-3 input-observations">'+
          '<div class="input-group-prepend">'+
            '<span class="input-group-text"><i class="fas fa-eye"></i></span>'+
          '</div>'+
          '<textarea class="form-control individual-observations" placeholder="Escriba las observaciones respectivas del item." rows="2"></textarea>'+
        '</div>');
    }
  });
  $(document).on('change','select.porcentual-parameters', function(){
      $(this).parent().parent().children('.input-observations').remove();
    if (parseInt($(this).val()) < 21 && $(this).val() != '') {
      $(this).parent().parent().append(
        '<div class="input-group mb-3 input-observations">'+
          '<div class="input-group-prepend">'+
            '<span class="input-group-text"><i class="fas fa-eye"></i></span>'+
          '</div>'+
          '<textarea class="form-control individual-observations" placeholder="Escriba las observaciones respectivas del item." rows="2"></textarea>'+
        '</div>');
      $(this).parent().children('.individual-parameters').val('No aprobado');
    }else{
      $(this).parent().children('.individual-parameters').val('Aprobado');
    }
  });
  /*==============================================
=            SUBIR FOTO DEL USUARIO            =
==============================================*/
  $(document).on('change','.photo1',function(){
  var imagen = this.files[0];
  // validar imagen jpg o png
  if(imagen['type'] != "image/jpeg" && imagen['type'] != "image/png"){
    $('.photo1').val("");
    swal({
          title: "Error al subir la imagen",
          text: "La imagen debe estar en formato JPG o PNG",
          type: "error",
          confirmButtonText: "¡Entendido!"
        });
  }else if(imagen['size'] > 2097152){
    $('.photo1').val("");
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
      $(".previsualizar1").attr("src",rutaImagen);
    })
  }
});
  $(document).on('change','.photo2',function(){
  var imagen = this.files[0];
  // validar imagen jpg o png
  if(imagen['type'] != "image/jpeg" && imagen['type'] != "image/png"){
    $('.photo2').val("");
    swal({
          title: "Error al subir la imagen",
          text: "La imagen debe estar en formato JPG o PNG",
          type: "error",
          confirmButtonText: "¡Entendido!"
        });
  }else if(imagen['size'] > 2097152){
    $('.photo2').val("");
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
      $(".previsualizar2").attr("src",rutaImagen);
    })
  }
});
  $(document).on('submit','form#nuevaRevision',function(event){
    listarPorcentuales();
    var first = $('.first-parameters');
    var firstChange = $('input#interiorCabin');
    verificarCategoria(first,firstChange);
    var second = $('.second-parameters');
    var secondChange = $('input#exteriorCabin');
    verificarCategoria(second,secondChange);
    var third = $('.third-parameters');
    var thirdChange = $('input#roadEquipment');
    verificarCategoria(third,thirdChange);
    var fourth = $('.fourth-parameters');
    var fourthChange = $('input#fluidsFilters');
    verificarCategoria(fourth,fourthChange);
    var fifth = $('.fifth-parameters');
    var fifthChange = $('input#direction');
    verificarCategoria(fifth,fifthChange);
    var sixth = $('.sixth-parameters');
    var sixthChange = $('input#suspension');
    verificarCategoria(sixth,sixthChange);
    var seventh = $('.seventh-parameters');
    var seventhChange = $('input#transmision');
    verificarCategoria(seventh,seventhChange);
    var eighth = $('.eighth-parameters');
    var eighthChange = $('input#brakes');
    verificarCategoria(eighth,eighthChange);
    var nineth = $('.nineth-parameters');
    var ninethChange = $('input#tires');
    verificarCategoria(nineth,ninethChange);
    verificarGeneral(pendientes);
    listarObservaciones();
    if (isJsonString($('#checkSummary').val()) && isJsonString($('#porcentualSummary').val())) {
      
    }else{
      event.preventDefault();
    }
  });
   /*==============================================
=          FUNCIONES PARA ENVIO Y JSON         =
==============================================*/
function listarPorcentuales(){
    var listaPorcentuales = [];
    var lista = $('.porcentual-parameters');
    for (var i = 0; i < lista.length; i++) {
        description = $(lista[i]).parent().children('div.input-group-prepend').children().html();
        listaPorcentuales.push({"description":description,
                            "value":parseInt($(lista[i]).val())});
    }
    $('#porcentualSummary').val(JSON.stringify(listaPorcentuales));
}
function verificarGeneral(pendientes){
    var lista = $('.individual-parameters');
    var cambio = $('input#generalState');
    for (var i = 0; i < lista.length; i++) {
      description = $(lista[i]).parent().children('div.input-group-prepend').children().html();
      if ($(lista[i]).val()=='No aprobado') {
          state = 0;
      }else if ($(lista[i]).val()=='Pendiente') {
          count++;
          for (var j = 0; j < pendientes.length; j++) {
            if (description==pendientes[j]['description'] && pendientes[j]['value'] == "Pendiente") {
              state = 0;
            }
          }
          if (count>2) {
            state = 0;
          }
      }
    }
    if (state == 0) {
      $(cambio).val(0)
    }else{
      $(cambio).val(1)
    }
    state = 1;
    count = 0;
}
function verificarCategoria(lista,cambio){
    for (var i = 0; i < lista.length; i++) {
        if ($(lista[i]).val()=='No aprobado') {
            state = 0;
        }else if ($(lista[i]).val()=='Pendiente') {
            count++;
            if (count>2) {
              state = 0;
            }
        }
    }
    if (state == 0) {
      $(cambio).val('No aprobado')
    }else{
      $(cambio).val('Aprobado')
    }
    state = 1;
    count = 0;
}
function listarObservaciones(){
  var listaObservaciones = [];
  var observations = "";
  var items = $('.individual-parameters');
  for (var i = 0; i < items.length; i++) {
    if ($(items[i]).val() != "Aprobado") {
      description = $(items[i]).parent().children('div.input-group-prepend').children().html();
      observations = $(items[i]).parent().parent().children('.input-observations').children('textarea.individual-observations').val();
      listaObservaciones.push({"description":description,
                          "value":$(items[i]).val(),
                          "observations":observations})
    }
  }
  $('#checkSummary').val(JSON.stringify(listaObservaciones));
}
function isJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}
});
