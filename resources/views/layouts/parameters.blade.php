@extends('base_layout')
@section('title')
	Parámetros
@stop
@section('js')
  <!-- Personalizado -->
  <script src="Views/js/parametros.js"></script>
@stop
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
<!-- Default box -->
      <div class="card mb-5 pb-5 text-center">
        <div class="card-header bg-secondary mb-3 p-4">
          <h1 class="card-title">Parametros del sistema</h1>

        </div>
        <div class="card-body">
          @foreach($parameters as $key => $parameter)
          @if ($parameter->name == 'Firma Ingeniero')
          <form role="form" method="post" enctype="multipart/form-data">
            <div class="row mt-5">
              @csrf
              <!-- foto -->
              <div class="form-group col-12">
                <div class="panel pb-3"><b>SUBIR FIRMA</b></div>
                <input type="file" class="sign pb-3" name="sign" id="nuevoFirma">
                <p class="help-block">Suba la firma digital del ingeniero en formato JPG o PNG con un peso inferior a 2MB. Debe estar en una proporcion 4 a 3, por ejemplo 400px de ancho por 300px de alto.</p>
              </div>
            </div>
            <div class="row w-100 justify-content-center">
              <button type="submit" class="btn btn-success" name="newSign">Actualizar Firma</button>
            </div>
          </form>
          @elseif ($parameter->name == 'Logo Login')
          <form role="form" method="post" enctype="multipart/form-data">
            <div class="row mt-5">
              @csrf
              <!-- foto -->
              <div class="form-group col-12">
                <div class="panel pb-3"><b>SUBIR LOGO DE INGRESO</b></div>
                <input type="file" class="logo1 pb-3" name="logo1">
                <p class="help-block">Suba el logo para la pantalla de ingreso al sistema en formato JPG o PNG con un peso inferior a 2MB. Debe ser cuadrado, por ejemplo 1080px de ancho por 1080px de alto.</p>
              </div>
            </div>
            <div class="row w-100 justify-content-center">
              <button type="submit" class="btn btn-success" name="newLogo1">Actualizar Login</button>
            </div>
          </form>
          @elseif ($parameter->name == 'Logo Reporte')
          <form role="form" method="post" enctype="multipart/form-data">
            <div class="row mt-5">
              @csrf
              <!-- foto -->
              <div class="form-group col-12">
                <div class="panel pb-3"><b>SUBIR LOGO PARA REPORTE</b></div>
                <input type="file" class="logo2 pb-3" name="logo2">
                <p class="help-block">Suba el logo para la pantalla de ingreso al sistema en formato JPG o PNG con un peso inferior a 2MB. Debe estar en una proporcion 4 a 3, por ejemplo 400px de ancho por 300px de alto.</p>
              </div>
            </div>
            <div class="row w-100 justify-content-center">
              <button type="submit" class="btn btn-success" name="newLogo2">Actualizar Reporte</button>
            </div>
          </form>
          @elseif ($parameter->name == 'Logo Correo')
          <form role="form" method="post" enctype="multipart/form-data">
            <div class="row mt-5">
              @csrf
              <!-- foto -->
              <div class="form-group col-12">
                <div class="panel pb-3"><b>SUBIR LOGO PARA CORREO</b></div>
                <input type="file" class="logo3 pb-3" name="logo3">
                <p class="help-block">Suba el logo para la pantalla de ingreso al sistema en formato JPG o PNG con un peso inferior a 2MB. Debe estar en una proporcion 5 a 3, por ejemplo 1000px de ancho por 600px de alto.</p>
              </div>
            </div>
            <div class="row w-100 justify-content-center">
              <button type="submit" class="btn btn-success" name="newLogo3">Actualizar Correo</button>
            </div>
          </form>
          @else
            <div class="row">
              <div class="form-group col-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text">{{$parameter->name}}</span>
                    </div>
                    <input type="text" class="form-control" name="newValue" id="{{$parameter->id}}" placeholder="{{$parameter->name}}" value="{{$parameter->value}}" required>
                    <div class="input-group-append">
                    <button class="input-group-text btnUpdate btn btn-primary" idParametro="{{$parameter->id}}" idCampo="#{{$parameter->id}}">Actualizar</button>
                    </div>
                  </div>
              </div>
            </div>
          @endif
          @endforeach
        </div>
        <!-- /.card-body -->

      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@stop