@extends('base_table')
	@section('title')
		Usuarios
	@stop
@section('css')
@stop
@section('js')
  <!-- Personalizado -->
  <script src="Views/js/tabla-usuarios.js"></script>
@stop
@section('h1')
	Lista de Usuarios
@stop
@section('small')
	Usuarios
@stop
@section('texto1')
	Usuarios
@stop
@section('cardHeader')
    <button class="btn btn-secondary" data-toggle="modal" data-target="#modalAgregarUsuario"> Agregar Usuario </button>
@stop
@section('nombreTabla') tablaUsuarios @stop
@section('thead')
	<thead>
      <tr>
        <th style="width:10px">#</th>
        <th>Nombre</th>
        <th>Usuario</th>
        <th>Foto</th>
        <th>Rol</th>
        <th>Estado</th>
        <th>Último login</th>
        <th>Acciones</th>
      </tr>
    </thead>
@stop
@section('modalAgregar') "modalAgregarUsuario" @stop
@section('textoAgregar')
    Usuario
@stop
@section('formAdd')
  <!-- nombre -->
  <div class="form-group">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-user"></i></span>
      </div>
      
      <input class="form-control" type="text" name="newName" placeholder="Ingresar nombre" required>
    </div>
    
  </div>
  <!-- username -->
  <div class="form-group">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-key"></i></span>
      </div>
      
      <input class="form-control" type="text" name="newUsername" placeholder="Ingresar nombre de usuario" id="newUser" required>
    </div>
    
  </div>
  <!-- contraseña -->
  <div class="form-group">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-lock"></i></span>
      </div>
      
      <input class="form-control" type="password" name="newPassword" placeholder="Ingresar contraseña" required>
    </div>
    
  </div>
  <div class="form-group">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-users"></i></span>
      </div>
      <select class="form-control" name="rol">
        <option value="">Seleccione un rango</option>
        <option value="Admin">Administrador</option>
        <option value="Empleado">Empleado</option>
      </select>
    </div>
    
  </div>
  <!-- foto -->
  <div class="form-group">
    <div class="panel">SUBIR FOTO</div>
    <input type="file" class="photo" name="photo">
    <p class="help-block">Peso máximo de la foto 2MB</p>
    <img src="Views/img/usuarios/anonymous.png" class="img-thumbnail previsualizar" width="100px">
  </div>
@stop
@section('nameNew') "newUser" @stop
@section('textoAgregar2')
    Usuario
@stop
@section('modalEditar') "modalEditarUsuario" @stop
@section('actionEditar') "usuarios/editar" @stop
@section('textoEditar')
    Usuario
@stop
@section('formEdit')
  <!-- nombre -->
  <div class="form-group">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-user"></i></span>
      </div>
      
      <input class="form-control" type="text" name="newName" value="Editar nombre" placeholder="Editar nombre" id="nameEdit" required>
    </div>
    
  </div>
  <!-- username -->
  <div class="form-group">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-key"></i></span>
      </div>
      
      <input class="form-control" type="text" name="newUsername" value="Editar nombre de usuario" placeholder="Editar nombre de usuario" id="usernameEdit" readonly>
    </div>
    
  </div>
  <!-- contraseña -->
  <div class="form-group">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-lock"></i></span>
      </div>
      
      <input class="form-control" type="password" name="newPassword" placeholder="Escriba la nueva contraseña (opcional)">
      <input type="hidden" name="password" id="password">
    </div>
    
  </div>
  <!-- rol -->
  <div class="form-group">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-users"></i></span>
      </div>
      <select class="form-control" name="rol">
        <option value="" id="rolEdit">Seleccione un rango</option>
        <option value="Admin">Administrador</option>
        <option value="Empleado">Empleado</option>
      </select>
    </div>
    
  </div>
  <!-- foto -->
  <div class="form-group">
    <div class="panel">ACTUALIZAR FOTO</div>
    <input type="file" class="photo" name="photo">
    <p class="help-block">Peso máximo de la foto 2MB</p>
    <img src="Views/img/usuarios/anonymous.png" class="img-thumbnail previsualizar" width="100px" id="photoEdit">
    <input type="hidden" name="lastPhoto" id="lastPhoto">
    
  </div>
@stop
@section('nameEdit') "editUser" @stop
@section('textoEditar2')
    Usuario
@stop
@section('moreForms')
@stop