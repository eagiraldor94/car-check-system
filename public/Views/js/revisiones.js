
/*================================================
=            CARGAR LA TABLA DINAMICA            =
================================================*/
$(function(){
  var $_GET = {};
  document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
      function decode(s) {
          return decodeURIComponent(s.split("+").join(" "));
      }

      $_GET[decode(arguments[1])] = decode(arguments[2]);
  });
  if (typeof $_GET['fechaInicio'] !== 'undefined') {
    if ($_GET['fechaInicio'] != "" && $_GET['fechaInicio'] != null) {
      var table = $('.tablaRevisiones').DataTable({
      "ajax":{
          "url": "ajax/datatable/revisiones",
          "type": "POST",
          "data" : {
              "fechaInicio": $_GET['fechaInicio'],
              "fechaFinal": $_GET['fechaFinal']
          }
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
    }
  }else {
    var table = $('.tablaRevisiones').DataTable({
    "ajax":{
        "url": "ajax/datatable/revisiones",
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
  }

if (localStorage.getItem('rango') != null) {
  $('span#reportrange').html(localStorage.getItem('rango'));
}else{
  $('span#reportrange').html('<i class="fa fa-calendar"></i> Rango de fecha');
}
});
/*==============================================
=            Rango de fechas         =
==============================================*/
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Hoy'       : [moment(), moment()],
          'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Últimos 7 dias' : [moment().subtract(6, 'days'), moment()],
          'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
          'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
          'El mes pasado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment(),
        endDate  : moment(),
        "locale": {
          closeText: 'Cerrar',
       prevText: '< Ant',
       nextText: 'Sig >',
       currentText: 'Hoy',
       monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
       monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
       dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
       dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
       dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        "daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
       weekHeader: 'Sm',
       dateFormat: 'dd/mm/yy',
       firstDay: 1,
       isRTL: false,
       showMonthAfterYear: false,
       yearSuffix: ''
        }
      },
      function (start, end) {
        $('span#reportrange').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
        var fechaInicio = start.format('YYYY-MM-DD');
        var fechaFinal = end.format('YYYY-MM-DD');
        var rango = $('span#reportrange').html();
        localStorage.setItem('rango', rango);
        window.location = "revisiones?fechaInicio="+fechaInicio+"&fechaFinal="+fechaFinal;
      }
    );
/*==============================================
=           Cancelar rango de fechas         =
==============================================*/
    $('.daterangepicker.opensleft .range_inputs .cancelBtn').on("click", function(){
      localStorage.removeItem('rango');
      localStorage.clear();
      window.location = "revisiones";
    });
/*==============================================
=           Capturar hoy         =
==============================================*/
$('.daterangepicker.opensleft .ranges li').on('click',function(){
  var hoy = $(this).html();
  if (hoy == 'Hoy') {
    var d = new Date();
    var dia = d.getDate();
    var mes = d.getMonth()+1;
    var año = d.getFullYear();
    if (mes <10) {
      var fechaInicio = año+"-0"+mes+"-"+dia;
      var fechaFinal = año+"-0"+mes+"-"+dia;
    }else if (dia < 10) {
      var fechaInicio = año+"-"+mes+"-0"+dia;
      var fechaFinal = año+"-"+mes+"-0"+dia;
    }else if (dia < 10 && mes<10 ) {
      var fechaInicio = año+"-0"+mes+"-0"+dia;
      var fechaFinal = año+"-0"+mes+"-0"+dia; 
    }else{
      var fechaInicio = año+"-"+mes+"-"+dia;
     var fechaFinal = año+"-"+mes+"-"+dia;
    }

    localStorage.setItem('rango', 'Hoy');
    window.location = "revisiones?fechaInicio="+fechaInicio+"&fechaFinal="+fechaFinal;
  }
});
/*==============================================
=            Imprimir informe          =
==============================================*/
$(function(){
  $(document).on( 'click', ".btnImprimirRevision" ,function(){
    var idRevision = $(this).attr("idRevision");
    window.open("resultado/"+idRevision,"_blank");
  });
});
/*==============================================
=            Crear Revision          =
==============================================*/
$(function(){
  $(document).on( 'click', ".btnAgregarRevision" ,function(){
    window.location = "revision/crear/";
  });
});
/*==============================================
=            Reingresar Vehiculo          =
==============================================*/
$(function(){
  $(document).on( 'click', ".btnReingresarRevision" ,function(){
    var idRevision = $(this).attr("idRevision");
    var datos = new FormData();
    datos.append("idRevision", idRevision);
    $.ajax({
      url:"/ajax/revisiones/recheck",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(answer){
        var soat = moment(answer.vehicle['SOAT_expiration']);
        var tecno = moment(answer.vehicle['technician_check_expiration']);
        if (moment().isAfter(soat)) {
          window.location = "revision/error/SOAT";
        }else if (moment().isAfter(tecno)) {
          window.location = "revision/error/tecno";
        }else{
          window.location = "revision/crear/"+idRevision;
        }
      }
    });
  });
});
/*==============================================
=            ELIMINAR REVISION          =
==============================================*/
$(function(){
  $(document).on( 'click', ".btnBorrarRevision" ,function(){
    var idRevision = $(this).attr("idRevision");
    swal({
      title: '¿Está seguro de borrar la revision?',
      text: "¡Si no lo está puede cancelar la acción!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Confirmar borrado de revision'
    }).then((result)=>{
      if(result.value){
      var datos = new FormData();
      datos.append("idRevision", idRevision);;
      $.ajax({
        url:"/ajax/revisiones/borrar",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(answer){
        }
      });
      window.location="revisiones";
      }
    });
  });
});