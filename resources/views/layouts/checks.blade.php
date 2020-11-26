@extends('base_table')
	@section('title')
		Revisiones
	@stop
@section('css')
@stop
@section('js')
  <!-- Personalizado -->
  <script src="Views/js/revisiones.js"></script>
@stop
@section('h1')
	Lista de Revisiones
@stop
@section('small')
	Revisiones
@stop
@section('texto1')
	Revisiones
@stop
@section('cardHeader')
  @if(session('rank')=='Admin' || session('rank')=='Empleado')
    <button class="btn btn-secondary btnAgregarRevision pull-left"> Ingresar Revision </button>
  @endif
    <button type="button" class="btn btn-default pull-right" id="daterange-btn">
      <span id="reportrange"><i class="fa fa-calendar"></i> Rango de fecha</span>
      <i class="fa fa-caret-down"></i>
    </button>
@stop
@section('nombreTabla') tablaRevisiones @stop
@section('thead')
	<thead>
      <tr>
        <th>Revision</th>
        <th>Empresa</th>
        <th>Vehiculo</th>
        <th>Estado</th>
        <th>Vigencia</th>
        <th>Conductor</th>
        <th>Documento</th>
        <th>Telefono</th>
        <th>Reingreso</th>
        <th>Acciones</th>
      </tr>
    </thead>
@stop
@section('modalAgregar') @stop
@section('textoAgregar')
@stop
@section('formAdd')
@stop
@section('nameNew') @stop
@section('textoAgregar2')
@stop
@section('modalEditar') @stop
@section('actionEditar') @stop
@section('textoEditar')
@stop
@section('formEdit')
@stop
@section('nameEdit') @stop
@section('textoEditar2')
@stop
@section('moreForms')
@stop