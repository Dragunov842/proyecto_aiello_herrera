<div class="container mt-5">
  <h2 class="title text-white text-center">Listado de usuarios</h2>

  <div class="d-flex justify-content-center justify-content-md-start my-3">
    <a href="<?= site_url('usuariosEliminados') ?>" class="btn btn-success btn-sm">
      Usuarios Eliminados
    </a>
  </div>

  <?php if (!empty($usuarios) && is_array($usuarios)) : ?>
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Usuario</th>
            <th scope="col">Email</th>
            <th scope="col">Perfil</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($usuarios as $usuario) : ?>
            <tr>
              <td><?= esc($usuario['id_usuario']) ?></td>
              <td><?= esc($usuario['nombre']) ?></td>
              <td><?= esc($usuario['apellido']) ?></td>
              <td><?= esc($usuario['usuario']) ?></td>
              <td><?= esc($usuario['email']) ?></td>
              <td><?= esc($usuario['perfil_id']) ?></td>
              <td class="d-flex flex-column flex-md-row gap-2">
                <a href="<?= site_url('editarUsuario' . $usuario['id_usuario']) ?>" class="btn btn-warning btn-sm">
                  Editar
                </a>
                <a href="<?= site_url('eliminarUsuario' . $usuario['id_usuario']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                  Eliminar
                </a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  <?php else : ?>
    <div class="alert alert-info">No hay usuarios registrados.</div>
  <?php endif ?>
</div>

