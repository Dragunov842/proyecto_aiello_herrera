<div class="container pt-5 mt-5 mb-5">
    <?php if (session('validation')): ?>
  <div class="alert alert-danger">
      <ul>
        <?php foreach (session('validation') as $error): ?>
          <li><?= $error ?></li>
        <?php endforeach; ?>
      </ul>
  </div>
<?php endif; ?>

    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="card col-lg-6 p-4">
                <h4 class="text-center mb-4">Editar Usuario</h4>

                <form action="<?= base_url('actualizarUsuario') ?>" method="POST">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="<?= esc($usuario['nombre']) ?>" required>

                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" name="apellido" value="<?= esc($usuario['apellido']) ?>" required>

                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" value="<?= esc($usuario['email']) ?>" required>

                    <label for="contraseña">Contraseña</label>
                    <input type="password" id="contraseña" name="contraseña" placeholder="Nueva contraseña (opcional)">

                    <div class="buttons mt-3">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <input type="reset" value="Limpiar" class="btn btn-secondary">
                        <button type="button" class="btn btn-danger"
                            onclick="window.location.href='<?= base_url('/') ?>';">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
