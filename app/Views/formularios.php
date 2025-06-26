
<h2 class="title text-center text-white mt-5">Editar Usuario</h2>

<div class="container mt-4 mb-5">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-8 col-lg-6">
      <div class="card">
        <div class="card-header text-center">
          <h4>Modificación Usuarios</h4>
        </div>

        <form method="post" id="update_user" name="update_user" action="<?= site_url('actualizarUsuarios' . $usuario['id_usuario']); ?>">
          <input type="hidden" name="id_usuario" id="id_usuario" value="<?= $usuario['id_usuario']; ?>">

          <div class="form-group mt-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= $usuario['nombre']; ?>" required>
          </div>

          <div class="form-group mt-3">
            <label>Apellido</label>
            <input type="text" name="apellido" class="form-control" value="<?= $usuario['apellido']; ?>" required>
          </div>

          <div class="form-group mt-3">
            <label>Usuario</label>
            <input type="text" name="usuario" class="form-control" value="<?= $usuario['usuario']; ?>" required>
          </div>

          <div class="form-group mt-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= $usuario['email']; ?>" required>
          </div>

          <div class="form-group mt-3">
            <label>Perfil ID</label>
            <input type="text" name="perfil" class="form-control" value="<?= $usuario['perfil_id']; ?>" required autofocus>
          </div>

          <div class="form-group mt-4 mb-3 d-flex justify-content-between flex-wrap gap-2">
            <input type="submit" value="Guardar" class="btn btn-success">
            <input type="reset" value="Cancelar" class="btn btn-danger">
            <a href="<?= base_url('Crud_usuarios'); ?>" class="btn btn-secondary">Volver</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Validación JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
