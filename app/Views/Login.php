<body>
  <div class="container pt-5 mt-5 mb-5">
    <div class="card-header text-justify">
      <div class="row d-flex justify-content-center">
        <div class="card col-lg-6">
  <h2>Iniciar Sesión</h2>
  <form method="post" action="<?= base_url('iniciarSesion') ?>">
    
    <!-- Mostrar errores generales -->
    <?php if (isset($errores)) : ?>
      <div class="alert alert-danger"><?= $errores ?></div>
    <?php endif; ?>

    <!-- Usuario -->
    <div class="mb-3">
      <label for="usuario" class="form-label">Usuario</label>
      <input type="text" class="form-control" name="usuario" id="usuario" value="<?= set_value('usuario') ?>" placeholder="Ingrese su usuario">
      <?php if (isset($validation['usuario'])) : ?>
        <div class="text-danger small"><?= $validation['usuario'] ?></div>
      <?php endif; ?>
    </div>

    <!-- Contraseña -->
    <div class="mb-3">
      <label for="contraseña" class="form-label">Contraseña</label>
      <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Ingrese su contraseña">
      <?php if (isset($validation['contraseña'])) : ?>
        <div class="text-danger small"><?= $validation['contraseña'] ?></div>
      <?php endif; ?>
    </div>

    <!-- Recordarme -->
    <div class="form-check mb-3">
      <input class="form-check-input" type="checkbox" id="recordarme">
      <label class="form-check-label" for="recordarme">Recordarme</label>
    </div>

    <!-- Botón -->
    <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>

    <!-- Link de registro -->
    <div class="mt-3 text-center">
      <small>¿No tienes una cuenta? <a href="<?= base_url('registrar') ?>">Registrarse</a></small>
    </div>
  </form>
      </div>
    </div>
  </div>
</div>
