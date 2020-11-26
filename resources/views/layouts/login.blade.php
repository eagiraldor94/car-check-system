<div class="login-box">
  <div class="login-logo">
    <a href=""><img src="{{$logo}}" alt="Logotipo_CDI" class="img-fluid"
           style="margin: -25% 0px -20% 0px; border-radius: 5px"></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Ingresar al sistema de revisiones</p>

      <form method="post">
        @csrf
        <div class="form-group has-feedback">

                  <select class="form-control custom-select" name="rol">
                    <option value="">Seleccionar perfil</option>
                    <option value="Empleado">Empleado</option>
                    <option value="Empresa">Empresa</option>
                  </select>

          <span class="fas fa-user-cog form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">

          <input type="text" class="form-control" placeholder="Usuario" name="user" required>

          <span class="fa fa-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Contraseña" name="pass" required>
          <span class="fa fa-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-secondary btn-block btn-flat">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>