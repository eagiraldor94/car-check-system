@extends('base_table')
	@section('title')
		Empresas
	@stop
@section('css')
@stop
@section('js')
  <!-- Personalizado -->
  <script src="Views/js/empresas.js"></script>
@stop
@section('h1')
	Lista de Empresas
@stop
@section('small')
	Empresas
@stop
@section('texto1')
	Empresas
@stop
@section('cardHeader')
    <button class="btn btn-secondary" data-toggle="modal" data-target="#modalAgregarEmpresa"> Agregar Empresa </button>
@stop
@section('nombreTabla') tablaEmpresas @stop
@section('thead')
	<thead>
      <tr>
        <th style="width:10px">#</th>
        <th>Logo</th>
        <th>Nombre</th>
        <th>Documento</th>
        <th>Estado</th>
        <th>Correo</th>
        <th>Teléfono</th>
        <th>Dirección</th>
        <th>Ciudad</th>
        <th>Contacto</th>
        <th>Usuario</th>
        <th>Último login</th>
        <th>Acciones</th>
      </tr>
    </thead>
@stop
@section('modalAgregar') "modalAgregarEmpresa" @stop
@section('textoAgregar')
    Empresa
@stop
@section('formAdd')
  <!-- nombre -->
  <div class="row">
    <div class="form-group ml-3" style="width:93%">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-building"></i></span>
        </div>
        
        <input class="form-control" type="text" id="nuevoNombre" name="newName" placeholder="Ingresar nombre de la empresa" required>
      </div>
      
    </div>
  </div>
  <!-- Documento -->
  <div class="row">
    <div class="form-group ml-3" style="width:30%">
      <div class="input-group mb-3">
          <div class="input-group-prepend d-md-inline-flex">
          <span class="input-group-text"><i class="fas fa-id-card"></i></span>
          </div>
          <select id="nuevoTipoDocumento" name="newIdType" class="form-control" required>
            <option value="">Tipo de documento</option>
            <option value="CC">Cedula de ciudadanía</option>
            <option value="CE">Cedula de extrajería</option>
            <option value="NIT">NIT</option>
          </select>
        </div>
     </div>
     <div class="form-group ml-3" style="width:60%">
      <div class="input-group mb-3">
          <div class="input-group-prepend d-md-inline-flex">
          <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
          </div>
          <input type="text" class="form-control" name="newIdNumber" id="nuevoNumeroDocumento" placeholder="Número del documento" required>
        </div>
     </div>
   </div>
    <!-- Telefono 1 -->
    <div class="row">
      <div class="form-group ml-3" style="width:45%">
        <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-phone-square"></i></span>
        </div>
        <input class="form-control" type="text" name="newPhone" id="nuevoTelefono" placeholder="Teléfono (opcional)" data-inputmask="'mask':'(999) 999-9999'" data-mask>
        </div>
     </div>            
       <!-- email -->
    <div class="form-group ml-3" style="width:45%">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-envelope"></i></span>
        </div>
        
        <input class="form-control" type="email" name="newEmail" id="nuevoEmail" placeholder="Email" required>
      </div>
      
    </div>
   </div>
   <div class="row">
  <!-- Municipio -->
     <div class="form-group ml-3" style="width:45%">
      <div class="input-group mb-3">
          <div class="input-group-prepend d-md-inline-flex">
          <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
          </div>
          <input type="text" class="form-control" name="newCity" id="nuevoCiudad" placeholder="Ciudad (opcional)">
        </div>
     </div>
  <!-- Direccion -->
     <div class="form-group ml-3" style="width:45%">
      <div class="input-group mb-3">
          <div class="input-group-prepend d-md-inline-flex">
          <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
          </div>
          <input type="text" class="form-control" name="newAddress" id="nuevoDireccion" placeholder="Ingrese dirección (opcional)">
        </div>
     </div>
   </div>
  <!-- nombre contacto -->
  <div class="row">
    <div class="form-group ml-3" style="width:93%">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-user"></i></span>
        </div>
        <input class="form-control" type="text" name="newContactName" placeholder="Ingresar nombre del contacto" required>
      </div>
    </div>
  </div>
  <!-- username -->
  <div class="row">
    <div class="form-group ml-3" style="width:93%">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-key"></i></span>
        </div>
        <input class="form-control" type="text" name="newUsername" placeholder="Ingresar nombre de usuario" id="newUser" required>
      </div>
    </div>
  </div>
  <!-- contraseña -->
  <div class="row">
    <div class="form-group ml-3" style="width:93%">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-lock"></i></span>
        </div>
        <input class="form-control" type="password" name="newPassword" placeholder="Ingresar contraseña" required>
      </div>
    </div>
  </div>
   <div class="row">
    <!-- foto -->
    <div class="form-group ml-3" style="width:93%">
      <div class="panel">SUBIR LOGO</div>
      <input type="file" class="logo" name="photo">
      <p class="help-block">Peso máximo del logo 2MB</p>
      <img src="Views/img/usuarios/anonymous.png" class="img-thumbnail previsualizar" width="100px">
    </div>
  </div>
@stop
@section('nameNew') "newCorporation" @stop
@section('textoAgregar2')
    Empresa
@stop
@section('modalEditar') "modalEditarEmpresa" @stop
@section('actionEditar') "empresas/editar" @stop
@section('textoEditar')
    Empresa
@stop
@section('formEdit')

  <!-- nombre -->
  <div class="row">
    <div class="form-group ml-3" style="width:93%">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-building"></i></span>
        </div>
        <input class="form-control" type="text" id="editNombre" name="newName" placeholder="Ingresar nombre de la empresa" required>
        <input type="hidden" name="editId" id="editId" required>
      </div>
    </div>
  </div>
  <!-- Documento -->
  <div class="row">
    <div class="form-group ml-3" style="width:30%">
      <div class="input-group mb-3">
          <div class="input-group-prepend d-md-inline-flex">
          <span class="input-group-text"><i class="fas fa-id-card"></i></span>
          </div>
          <select id="editTipoDocumento" name="newIdType" class="form-control" required>
            <option value="">Tipo de documento</option>
            <option value="CC">Cedula de ciudadanía</option>
            <option value="CE">Cedula de extrajería</option>
            <option value="NIT">NIT</option>
          </select>
        </div>
     </div>
     <div class="form-group ml-3" style="width:60%">
      <div class="input-group mb-3">
          <div class="input-group-prepend d-md-inline-flex">
          <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
          </div>
          <input type="text" class="form-control" name="newIdNumber" id="editNumeroDocumento" placeholder="Número del documento" required>
        </div>
     </div>
   </div>
    <!-- Telefono 1 -->
    <div class="row">
      <div class="form-group ml-3" style="width:45%">
        <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-phone-square"></i></span>
        </div>
        <input class="form-control" type="text" name="newPhone" id="editTelefono" placeholder="Teléfono (opcional)" data-inputmask="'mask':'(999) 999-9999'" data-mask>
        </div>
     </div>            
       <!-- email -->
    <div class="form-group ml-3" style="width:45%">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-envelope"></i></span>
        </div>
        
        <input class="form-control" type="email" name="newEmail" id="editEmail" placeholder="Email" required>
      </div>
      
    </div>
   </div>
   <div class="row">
  <!-- Municipio -->
     <div class="form-group ml-3" style="width:45%">
      <div class="input-group mb-3">
          <div class="input-group-prepend d-md-inline-flex">
          <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
          </div>
          <input type="text" class="form-control" name="newCity" id="editCiudad" placeholder="Ciudad (opcional)">
        </div>
     </div>
  <!-- Direccion -->
     <div class="form-group ml-3" style="width:45%">
      <div class="input-group mb-3">
          <div class="input-group-prepend d-md-inline-flex">
          <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
          </div>
          <input type="text" class="form-control" name="newAddress" id="editDireccion" placeholder="Ingrese dirección (opcional)">
        </div>
     </div>
   </div>
  <!-- nombre contacto -->
  <div class="row">
    <div class="form-group ml-3" style="width:93%">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-user"></i></span>
        </div>
        <input class="form-control" type="text" id="editNombreContacto" name="newContactName" placeholder="Ingresar nombre del contacto" required>
      </div>
    </div>
  </div>
  <!-- username -->
  <div class="row">
    <div class="form-group ml-3" style="width:93%">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-key"></i></span>
        </div>
        <input class="form-control" type="text" name="newUsername" placeholder="Ingresar nombre de usuario" id="editUser" readonly>
      </div>
    </div>
  </div>
  <!-- contraseña -->
  <div class="row">
    <div class="form-group ml-3" style="width:93%">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-lock"></i></span>
      </div>
      
      <input class="form-control" type="password" name="newPassword" placeholder="Escriba la nueva contraseña (opcional)">
      <input type="hidden" name="password" id="password">
    </div>
    </div>
  </div>
   <div class="row">
    <!-- foto -->
    <div class="form-group ml-3" style="width:93%">
      <div class="panel">SUBIR LOGO</div>
      <input type="file" class="logo" name="photo">
      <p class="help-block">Peso máximo del logo 2MB</p>
      <img src="Views/img/usuarios/anonymous.png" class="img-thumbnail previsualizar" width="100px" id="logoEdit">
      <input type="hidden" name="lastphoto" id="lastLogo">
    </div>
  </div>
@stop
@section('nameEdit') "editCorporation" @stop
@section('textoEditar2')
    Empresa
@stop
@section('moreForms')
@stop