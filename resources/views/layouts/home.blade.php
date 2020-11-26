@extends('base_layout')
@if(session('rank')!= null && session('rank') != "")
	@section('title')
		Home
	@stop
@else
	@section('title')
		Login
	@stop
@endif
@section('js')
  <!-- Personalizado -->
  <script src="Views/js/home.js"></script>
@stop
@if(session('rank')!= null && session('rank') != "")
	@section('content')
		<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col 12 col-sm-6">
	            <h1>Bienvenido al sistema de Control de Extractos</h1>
	          </div>
	          <div class="col 12 col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
	              <li class="breadcrumb-item active">Tablero</li>
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
	    </section>

	    <!-- Main content -->
	    <section class="content">

	      <div class="row">
	        @if (session('rank')=='Admin' || session('rank')=='Empleado')
	          @include('layouts.dashboard.main-boxes')
	        @else
            <div class="row m-3 w-100">
                  <div class="alert alert-primary w-100 text-center">
                  <h2>NOTIFICACIONES</h2>
                  </div>
            </div>
	        @endif
	      </div>
	      <div class="row">
	        <div class="col-12">
	         @if (session('rank'))
	            @include('layouts.dashboard.revisiones')
	         @endif
	        </div>
	      </div>
	      <div class="row">
	        <div class="col-12 col-sm-6">
	         @if (session('rank'))
	            @include('layouts.dashboard.tecnos')
	         @endif
	        </div>
	        <div class="col-12 col-sm-6">
	         @if (session('rank'))
	            @include('layouts.dashboard.soats')
	         @endif
	        </div>
	      </div>

	    </section>
	    <!-- /.content -->
	  </div>
	  <!-- /.content-wrapper -->
	@stop
@else
	@section('content')
		@include('layouts.login')
	@stop
@endif