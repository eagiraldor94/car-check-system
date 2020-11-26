@extends('base_layout')
@section('title')
	Revision Bimensual
@stop
@section('css')
@stop
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"> Revision Bimensual</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">Nueva revision</li>
                <li class="breadcrumb-item active">Revision Bimensual</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <section class="content">
        <div class="container">
<!-- Default box -->
      <div class="card mb-5 text-center">
        <form role="form" id="nuevaRevision" method="post" action="/revisiones" enctype="multipart/form-data">
          @csrf
        <div class="card-header bg-primary d-flex justify-content-center">
          <h1 class="card-title my-auto">Datos de la revision</h1>
        </div>
        <div class="card-body">
            <div class="row">
                  <div class="alert alert-warning w-100">
                  <h2>PENDIENTES ANTERIORES</h2>
                    <div class="pendings-alert mt-4">
                      @if(isset($pendings))
                        @foreach ($pendings as $pending)
                            <p><b>{{$pending['description']}}: </b> {{ $pending['value'] }}<br/><b>Observaciones: </b>{{$pending['observations']}}</p>
                        @endforeach
                      @endif
                      @if(isset($check))
                        <p><b>Observaciones generales: </b>{{$check->general_observations}}</p>
                      @endif
                    </div>
                  </div>
            </div>
            <div class="row">  
              <div class="form-group col-12">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-toolbox"></i></span>
                  </div>
                  <input class="form-control" type="text" name="newTechnicianName" placeholder="Nombre del técnico" required>
                </div>
              </div>
            </div>
            <div class="row">
                  <div class="alert alert-secondary w-100">
                  <h2>INFORMACIÓN DEL VEHICULO</h2>
                  @if(isset($recheck))
                    <input type="hidden" name="newRecheck" value="{{$recheck}}">
                  @endif
                  </div>
            </div>
            <div class="row">
              <div class="form-group col-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-car"></i></span>
                    </div>
                  <select name="newVehicleId" id="nuevoIdVehiculo" class="form-control" required>
                    @if(!isset($check))
                      <option value="">Seleccione un vehiculo</option>
                    @endif
                    @foreach ($vehicles as $key => $vehicle)
                      <option value="{{$vehicle->id}}">{{mb_strtoupper($vehicle->plate)}}</option>
                    @endforeach
                  </select>
                  </div>
               </div>
            </div>
            <div class="row">  
              <div class="form-group col-12">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                  </div>
                  <input class="form-control" type="text" name="newDriver" placeholder="Nombre del conductor" required>
                </div>
              </div>
            </div>
            <!-- Documento -->
            <div class="row">
              <div class="form-group col-12 col-sm-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend d-md-inline-flex">
                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <select name="newIdType" class="form-control" required>
                      <option value="">Tipo de documento</option>
                      <option value="CC">Cedula de ciudadanía</option>
                      <option value="CE">Cedula de extranjería</option>
                    </select>
                  </div>
               </div>
               <div class="form-group col-12 col-sm-8">
                <div class="input-group mb-3">
                    <div class="input-group-prepend d-md-inline-flex">
                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                    </div>
                    <input type="text" class="form-control" name="newIdNumber" placeholder="Número del documento" required>
                  </div>
               </div>
             </div>
             <div class="row">
            <!-- Telefono -->
               <div class="form-group col-12">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-phone-square"></i></span>
                  </div>
                  <input class="form-control" type="text" name="newPhone" placeholder="Telefono del conductor" data-inputmask="'mask':'(999) 999-9999'" data-mask>
                </div>
               </div>
             </div>
            <div class="row">
                  <div class="alert alert-secondary w-100">
                  <h2>1. CABINA INTERIOR</h2>
                  <input type="hidden" id="interiorCabin" name="newInteriorCabin">
                  </div>
            </div>
          @foreach ($firstItems as $key => $item)
            <div class="row">  
              <div class="form-group col-12">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">{{$item}}</span>
                  </div>
                  <select class="form-control first-parameters individual-parameters" required>
                    <option value="">Resultado</option>
                    <option value="Aprobado">Aprobado</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="No aprobado">No aprobado</option>
                  </select>
                </div>
              </div>
            </div>
          @endforeach
            <div class="row">
                  <div class="alert alert-secondary w-100">
                  <h2>2. CABINA EXTERIOR</h2>
                  <input type="hidden" id="exteriorCabin" name="newExteriorCabin">
                  </div>
            </div>
          @foreach ($secondItems as $key => $item)
            <div class="row">  
              <div class="form-group col-12">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">{{$item}}</span>
                  </div>
                  <select class="form-control second-parameters individual-parameters" required>
                    <option value="">Resultado</option>
                    <option value="Aprobado">Aprobado</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="No aprobado">No aprobado</option>
                  </select>
                </div>
              </div>
            </div>
          @endforeach
            <div class="row">
                  <div class="alert alert-secondary w-100">
                  <h2>3. EQUIPO CARRETERA</h2>
                  <input type="hidden" id="roadEquipment" name="newRoadEquipment">
                  </div>
            </div>
          @foreach ($thirdItems as $key => $item)
            <div class="row">  
              <div class="form-group col-12">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">{{$item}}</span>
                  </div>
                  <select class="form-control third-parameters individual-parameters" required>
                    <option value="">Resultado</option>
                    <option value="Aprobado">Aprobado</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="No aprobado">No aprobado</option>
                  </select>
                </div>
              </div>
            </div>
          @endforeach
            <div class="row">
                  <div class="alert alert-secondary w-100">
                  <h2>4. NIVELES Y ESTADO DE FLUIDOS Y FILTROS</h2>
                  <input type="hidden" id="fluidsFilters" name="newFluidsFilters">
                  </div>
            </div>
          @foreach ($fourthItems as $key => $item)
            @if($item == 'Aceite motor' || $item == 'Líquido refrigerante' || $item == 'Aceite de dirección y/o hidráulico' || $item == 'Líquido de frenos')
              <div class="row">  
                <div class="form-group col-12">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">{{$item}}</span>
                    </div>
                    <input type="hidden" class="fourth-parameters individual-parameters" required>
                    <select class="form-control porcentual-parameters" required>
                      <option value="">Seleccione el estado</option>
                      <option value="20">20%</option>
                      <option value="40">40%</option>
                      <option value="60">60%</option>
                      <option value="80">80%</option>
                      <option value="100">100%</option>
                    </select>
                  </div>
                </div>
              </div>
            @else
              <div class="row">  
                <div class="form-group col-12">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">{{$item}}</span>
                    </div>
                    <select class="form-control fourth-parameters individual-parameters" required>
                      <option value="">Resultado</option>
                      <option value="Aprobado">Aprobado</option>
                      <option value="Pendiente">Pendiente</option>
                      <option value="No aprobado">No aprobado</option>
                    </select>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
            <div class="row">
                  <div class="alert alert-secondary w-100">
                  <h2>5. SISTEMA DE DIRECCION</h2>
                  <input type="hidden" id="direction" name="newDirection">
                  </div>
            </div>
          @foreach ($fifthItems as $key => $item)
            <div class="row">  
              <div class="form-group col-12">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">{{$item}}</span>
                  </div>
                  <select class="form-control fifth-parameters individual-parameters" required>
                    <option value="">Resultado</option>
                    <option value="Aprobado">Aprobado</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="No aprobado">No aprobado</option>
                  </select>
                </div>
              </div>
            </div>
          @endforeach
            <div class="row">
                  <div class="alert alert-secondary w-100">
                  <h2>6. SISTEMAS DE SUSPENSION</h2>
                  <input type="hidden" id="suspension" name="newSuspension">
                  </div>
            </div>
          @foreach ($sixthItems as $key => $item)
            <div class="row">  
              <div class="form-group col-12">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">{{$item}}</span>
                  </div>
                  <select class="form-control sixth-parameters individual-parameters" required>
                    <option value="">Resultado</option>
                    <option value="Aprobado">Aprobado</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="No aprobado">No aprobado</option>
                  </select>
                </div>
              </div>
            </div>
          @endforeach
            <div class="row">
                  <div class="alert alert-secondary w-100">
                  <h2>7. SISTEMAS DE TRANSMISION, ESTADO Y FUGAS</h2>
                  <input type="hidden" id="transmision" name="newTransmision">
                  </div>
            </div>
          @foreach ($seventhItems as $key => $item)
            <div class="row">  
              <div class="form-group col-12">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">{{$item}}</span>
                  </div>
                  <select class="form-control seventh-parameters individual-parameters" required>
                    <option value="">Resultado</option>
                    <option value="Aprobado">Aprobado</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="No aprobado">No aprobado</option>
                  </select>
                </div>
              </div>
            </div>
          @endforeach
            <div class="row">
                  <div class="alert alert-secondary w-100">
                  <h2>8. FRENOS</h2>
                  <input type="hidden" id="brakes" name="newBrakes">
                  </div>
            </div>
          @foreach ($eighthItems as $key => $item)
            <div class="row">  
              <div class="form-group col-12">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">{{$item}}</span>
                  </div>
                  <select class="form-control eighth-parameters individual-parameters" required>
                    <option value="">Resultado</option>
                    <option value="Aprobado">Aprobado</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="No aprobado">No aprobado</option>
                  </select>
                </div>
              </div>
            </div>
          @endforeach
            <div class="row">
                  <div class="alert alert-secondary w-100">
                  <h2>9. LLANTAS</h2>
                  <input type="hidden" id="tires" name="newTires">
                  </div>
            </div>
          @foreach ($ninethItems as $key => $item)
            <div class="row">  
              <div class="form-group col-12">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">{{$item}}</span>
                  </div>
                  <input type="hidden" class="nineth-parameters individual-parameters" required>
                  <select class="form-control porcentual-parameters" required>
                    <option value="">Seleccione el estado</option>
                    <option value="20">20%</option>
                    <option value="40">40%</option>
                    <option value="60">60%</option>
                    <option value="80">80%</option>
                    <option value="100">100%</option>
                  </select>
                </div>
              </div>
            </div>
          @endforeach
          <div class="row">
            <!-- foto -->
            <div class="form-group col-12 col-sm-6">
              <div class="panel">FOTOGRAFÍA FRONTAL</div>
              <input type="file" class="photo1" name="photo1" required>
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="/Views/img/usuarios/anonymous.png" class="img-thumbnail previsualizar1" width="100px">
            </div>
            <!-- foto -->
            <div class="form-group col-12 col-sm-6">
              <div class="panel">FOTOGRAFÍA TRASERA</div>
              <input type="file" class="photo2" name="photo2" required>
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="/Views/img/usuarios/anonymous.png" class="img-thumbnail previsualizar2" width="100px">
            </div>
          </div>  
          <div class="row">
            <!-- Descripcion -->
          <div class="form-group col-12">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-eye"></i></span>
              </div>
              <textarea class="form-control" name="newGeneralObservations" placeholder="Anote los detalles y observaciones generales de la revision." id="nuevoObservacionesGenerales" rows="5"></textarea>
              <input type="hidden" id="checkSummary" name="newCheckSummary" required>
              <input type="hidden" id="porcentualSummary" name="newPorcentualSummary" required>
              <input type="hidden" id="generalState" name="newGeneralState" required>
            </div>
          </div>
        </div>
        </div>
        <div class="card-footer">
          <div class="row w-100">
              <div class="input-group justify-content-center">
                <button type="submit" class="btn btn-success" name="newCheck">Generar Informe</button>
              </div>
          </div>
        </div>
        <!-- /.card-body -->

        </form>
      </div>
      <!-- /.card -->
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@stop
@section('js')
  <script src="/Views/js/revision-nueva.js"></script>
@stop