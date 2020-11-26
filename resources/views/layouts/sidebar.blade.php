<header class="main-header">
	
	<!-- sidebar -->

  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->

    <a href="/inicio" class="brand-link">
      <img src="/Views/img/plantilla/AF_FAVICON-01.png" alt="Logotipo_CDI" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{session('comp')}}</span>
    </a>
    <div class="sidebar">

    	<!-- sidebar-menu -->

		<nav class="mt-2">
        	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    	<!-- User panel -->

    		<li class="nav-item has-treeview" id="inicioTree">
            	<a href="/inicio" class="nav-link" id="inicio">
                @if(session('photo') != "" && session('photo') != null)
                 <img src="{{session('photo')}}" class="nav-icon" alt="User Image">
                @else
                  <img src="/Views/img/usuarios/anonymous.png" class="nav-icon" alt="User Image">
                @endif		         	
		            <p>
		              {{session('name')}}
		              <i class="right fa fa-angle-left"></i>
		            </p>
            	</a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link btnEditarMain" idUsuario="{{session('id')}}" tipoUsuario="{{session('rank')}}" data-toggle="modal" data-target="#modalEditarMain">
                  <i class="fa fa-key nav-icon"></i>
                  <p>Editar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/salir" class="nav-link">
                  <i class="fa fa-times-circle nav-icon"></i>
                  <p>Salir</p>
                </a>
              </li>
            </ul>
          </li>
          @if(session('rank')=='Admin')
          <li class="nav-item">
            <a href="/parametros" class="nav-link" id="parametros">
              <i class="nav-icon fas fa-cogs"></i>
              <p>Parametros</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/usuarios" class="nav-link" id="usuarios">
              <i class="nav-icon fas fa-users"></i>
              <p>Usuarios</p>
            </a>
          </li>
          @endif
          @if(session('rank')=='Admin' || session('rank')=='Empleado')
          <li class="nav-item">
            <a href="/empresas" class="nav-link" id="empresas">
              <i class="nav-icon fas fa-building"></i>
              <p>Empresas</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/vehiculos" class="nav-link" id="vehiculos">
              <i class="nav-icon fas fa-car"></i>
              <p>Vehiculos</p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="/revisiones" class="nav-link" id="revisiones">
              <i class="nav-icon fas fa-toolbox"></i>
              <p>Revisiones</p>
            </a>
          </li>
        </ul>
      </nav>

    </div>

   
  </aside>
	
</header>