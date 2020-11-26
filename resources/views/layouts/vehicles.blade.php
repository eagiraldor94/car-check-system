@extends('base_table')
	@section('title')
		Vehiculos
	@stop
@section('css')
  <link rel="stylesheet" href="/Views/plugins/datepicker/datepicker3.css">
@stop
@section('js')
  <!-- Personalizado -->
  <script src="Views/js/vehiculos.js"></script>
  <script src="Views/plugins/datepicker/bootstrap-datepicker.js"></script>
  <script src="Views/plugins/datepicker/locales/bootstrap-datepicker.es.js"></script>
  <script src="Views/js/datepicker.js"></script>
@stop
@section('h1')
	Lista de Vehiculos
@stop
@section('small')
	Vehiculos
@stop
@section('texto1')
	Vehiculos
@stop
@section('cardHeader')
    <button class="btn btn-secondary pull-left" data-toggle="modal" data-target="#modalAgregarVehiculo"> Agregar Vehiculo </button>
@stop
@section('nombreTabla') tablaVehiculos @stop
@section('thead')
	<thead>
      <tr>
        <th style="width:10px">#</th>
        <th>Empresa</th>
        <th>Placa</th>
        <th>Vto. SOAT</th>
        <th>Vto. tecno</th>
        <th>Propietario</th>
        <th>Documento</th>
        <th>Tipo</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Matricula</th>
        <th>Acciones</th>
      </tr>
    </thead>
@stop
@section('modalAgregar') "modalAgregarVehiculo" @stop
@section('textoAgregar')
    Vehiculo
@stop
@section('formAdd')
  <div class="row">
    <div class="form-group ml-3" style="width:93%">
      <div class="input-group mb-3">
          <div class="input-group-prepend d-md-inline-flex">
          <span class="input-group-text"><i class="fas fa-building"></i></span>
          </div>
        <select name="newCorporationId" id="nuevoIdEmpresa" class="form-control" required>
          <option value="">Seleccione la empresa</option>
          @foreach ($empresas as $key => $empresa)
          <option value="{{$empresa->id}}">{{$empresa->name}}</option>
          @endforeach
        </select>
        </div>
     </div>
  </div>
  <!--Placa, Modelo-->
  <div class="row">
     <div class="form-group ml-3" style="width:45%">
      <div class="input-group mb-3">
          <div class="input-group-prepend d-md-inline-flex">
          <span class="input-group-text"><i class="fas fa-fingerprint"></i></span>
          </div>
          <input type="text" class="form-control" name="newPlate" id="nuevoPlacaVehiculo" placeholder="Placa" required>
        </div>
     </div>
     <div class="form-group ml-3" style="width:45%">
      <div class="input-group mb-3">
          <div class="input-group-prepend d-md-inline-flex">
          <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
          </div>
          <input type="text" class="form-control" name="newModel" id="nuevoModeloVehiculo" placeholder="Modelo" required>
        </div>
     </div>
   </div>
   <div class="row">
                    <!-- Marca-->
     <div class="form-group ml-3" style="width:45%">
      <div class="input-group mb-3">
          <div class="input-group-prepend d-md-inline-flex">
          <span class="input-group-text"><i class="fas fa-car"></i></span>
          </div>
          <input type="text" class="form-control" name="newBrand" id="nuevoMarcaVehiculo" placeholder="Marca" required>
        </div>
     </div>
                    <!-- Clase-->
     <div class="form-group ml-3" style="width:45%">
      <div class="input-group mb-3">
          <div class="input-group-prepend d-md-inline-flex">
          <span class="input-group-text"><i class="fas fa-bus"></i></span>
          </div>
          <input type="text" class="form-control" name="newType" id="nuevoClaseVehiculo" placeholder="Clase" required>
        </div>
     </div>
  </div>
  <div class="row">
                  <!-- Matricula-->
   <div class="form-group ml-3" style="width:93%">
    <div class="input-group mb-3">
        <div class="input-group-prepend d-md-inline-flex">
        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
        </div>
        <input type="text" class="form-control" name="newInscription" id="nuevoMatricula" placeholder="Número Matrícula" required>
      </div>
   </div>
  </div>
   <div class="row">
                    <!-- Fecha de Vencimiento-->
    <div class="form-group ml-3" style="width: 45%">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
        </div>
        <input class="form-control datepicker2" type="text" name="newSOATExpiration" id="nuevoFechaVencimientoSOAT" placeholder="Vencimiento SOAT" data-inputmask="'alias':'dd/mm/yyyy'" data-mask required>
      </div>
      <small class="form-text text-left">Vencimiento SOAT</small>
    </div>
                    <!-- Fecha de Vencimiento-->
    <div class="form-group ml-3" style="width: 45%">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
        </div>
        <input class="form-control datepicker2" type="text" name="newTechnicianCheckExpiration" id="nuevoFechaVencimientoTecno" placeholder="Vencimiento Tecnicomecánica" data-inputmask="'alias':'dd/mm/yyyy'" data-mask required>
      </div>
      <small class="form-text text-left">Vencimiento Tecnicomecánica</small>
    </div>
  </div>
  <!-- nombre -->
  <div class="row">
    <div class="form-group ml-3" style="width:93%">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-building"></i></span>
        </div>
        <input class="form-control" type="text" id="nuevoNombre" name="newPropietary" placeholder="Ingresar nombre del propietario" required>
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
@stop
@section('nameNew') "newVehicle" @stop
@section('textoAgregar2')
    Vehiculo
@stop
@section('modalEditar') "modalEditarVehiculo" @stop
@section('actionEditar') "vehiculos/editar" @stop
@section('textoEditar')
    Vehiculo
@stop
@section('formEdit')
  <div class="row">
    <div class="form-group ml-3" style="width:93%">
      <div class="input-group mb-3">
          <div class="input-group-prepend d-md-inline-flex">
          <span class="input-group-text"><i class="fas fa-building"></i></span>
          </div>
        <select name="newCorporationId" id="editIdEmpresa" class="form-control" required>
          <option value="">Seleccione la empresa</option>
          @foreach ($empresas as $key => $empresa)
          <option value="{{$empresa->id}}">{{$empresa->name}}</option>
          @endforeach
        </select>
        <input type="hidden" name="editId" id="editId" required>
        </div>
     </div>
  </div>
  <!--Placa, Modelo-->
  <div class="row">
     <div class="form-group ml-3" style="width:45%">
      <div class="input-group mb-3">
          <div class="input-group-prepend d-md-inline-flex">
          <span class="input-group-text"><i class="fas fa-fingerprint"></i></span>
          </div>
          <input type="text" class="form-control" name="newPlate" id="editPlacaVehiculo" placeholder="Placa" required>
        </div>
     </div>
     <div class="form-group ml-3" style="width:45%">
      <div class="input-group mb-3">
          <div class="input-group-prepend d-md-inline-flex">
          <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
          </div>
          <input type="text" class="form-control" name="newModel" id="editModeloVehiculo" placeholder="Modelo" required>
        </div>
     </div>
   </div>
   <div class="row">
                    <!-- Marca-->
     <div class="form-group ml-3" style="width:45%">
      <div class="input-group mb-3">
          <div class="input-group-prepend d-md-inline-flex">
          <span class="input-group-text"><i class="fas fa-car"></i></span>
          </div>
          <input type="text" class="form-control" name="newBrand" id="editMarcaVehiculo" placeholder="Marca" required>
        </div>
     </div>
                    <!-- Clase-->
     <div class="form-group ml-3" style="width:45%">
      <div class="input-group mb-3">
          <div class="input-group-prepend d-md-inline-flex">
          <span class="input-group-text"><i class="fas fa-bus"></i></span>
          </div>
          <input type="text" class="form-control" name="newType" id="editClaseVehiculo" placeholder="Clase" required>
        </div>
     </div>
  </div>
  <div class="row">
                  <!-- Matricula-->
   <div class="form-group ml-3" style="width:93%">
    <div class="input-group mb-3">
        <div class="input-group-prepend d-md-inline-flex">
        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
        </div>
        <input type="text" class="form-control" name="newInscription" id="editMatricula" placeholder="Número Matrícula" required>
      </div>
   </div>
  </div>
   <div class="row">
                    <!-- Fecha de Vencimiento-->
    <div class="form-group ml-3" style="width: 45%">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
        </div>
        <input class="form-control datepicker2" type="text" name="newSOATExpiration" id="editFechaVencimientoSOAT" placeholder="Vencimiento SOAT" data-inputmask="'alias':'dd/mm/yyyy'" data-mask required>
      </div>
      <small class="form-text text-left">Vencimiento SOAT</small>
    </div>
                    <!-- Fecha de Vencimiento-->
    <div class="form-group ml-3" style="width: 45%">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
        </div>
        <input class="form-control datepicker2" type="text" name="newTechnicianCheckExpiration" id="editFechaVencimientoTecno" placeholder="Vencimiento Tecnicomecánica" data-inputmask="'alias':'dd/mm/yyyy'" data-mask required>
      </div>
      <small class="form-text text-left">Vencimiento Tecnicomecánica</small>
    </div>
  </div>
  <!-- nombre -->
  <div class="row">
    <div class="form-group ml-3" style="width:93%">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-building"></i></span>
        </div>
        <input class="form-control" type="text" id="editNombre" name="newPropietary" placeholder="Ingresar nombre del propietario" required>
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
@stop
@section('nameEdit') "editVehicle" @stop
@section('textoEditar2')
    Vehiculo
@stop