/*==============================================
=            Cambiando menu activo            =
==============================================*/
$(function(){
  $(document).on('click','.nav-link',function(){
    $('.nav-link').removeClass("active");
    $(this).addClass("active");
});
  var getRuta = window.location.pathname;

  switch(getRuta) {
    case '/':
        $('#inicio').addClass("active");
        $('#inicioTree').addClass("menu-open");
        break;
    case '/empresas':
        $('#empresas').addClass("active");
        break;
    case '/vehiculos':
        $('#vehiculos').addClass("active");
        break;
    case '/revisiones':
        $('#revisiones').addClass("active");
        break;
    case '/parametros':
        $('#parametros').addClass("active");
        break;
    case '/usuarios':
        $('#usuarios').addClass("active");
        break;
    default:
        break;
  }
});
/*==============================================
=            EDITAR USUARIO            =
==============================================*/
$(function(){
  $(document).on('click', '.btnEditarMain' ,function(){
    var idUsuario = $(this).attr("idUsuario");
    var datos = new FormData();
    datos.append("idUsuario", idUsuario);
    $.ajax({
      url:"ajax/usuarios/editarme",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(answer){
        $('#usernameEditMe').val(answer['username']);
        $('#passwordMe').val(answer['password']);
        $('#lastPhotoMe').val(answer['photo']);
        
        if (answer['photo'] != "") {
          $('#photoEditMe').attr("src",answer['photo']);
        }
        
      }
    })
  });
});