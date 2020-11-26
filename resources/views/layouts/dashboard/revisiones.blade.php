@php
  use Carbon\Carbon;
  setlocale(LC_TIME, 'es_ES');
  date_default_timezone_set('America/Bogota');
  $hoy = Carbon::today();
@endphp
<!-- PRODUCT LIST --> 
<div class="card">
  <div class="card-header">
    <span class="card-title">Revisiones bimensuales vencidas</span>
    <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
          </div>
  </div>

  <div class="card-body">
 <!-- /.card-header -->
      @if($vehiculos != "" && $vehiculos != null)
        @foreach ($vehiculos as $vehiculo)
          @if(is_object($vehiculo->checks->last()))
            @php
              $expira = Carbon::parse($vehiculo->checks->last()->expiration);
              $diff = $hoy->diffInDays($expira,false);
            @endphp
            @if ($diff<0) 
              <div class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
                <a href="revisiones">La <b>revisión bimensual</b> perteneciente al vehículo <b>{{$vehiculo->plate}}</b> se encuentra vencida</a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @elseif ($diff<=16)
              <div class="alert alert-warning alert-dismissible fade show mx-3" role="alert">
                <a href="revisiones">La <b>revisión bimensual</b> perteneciente al vehículo <b>{{$vehiculo->plate}}</b> vence en {{$diff}} dias</a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @else
              @break
            @endif
          @endif
        @endforeach
      @endif

</div>
</div>
<!-- /.card -->