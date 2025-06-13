<div class="container mt-5">
    <h2 class="title" style="color:white; margin-top:100px;">Listado de usuarios</h2>
    <a href="<?= site_url('usuariosEliminados') ?>" class="btn btn-success btn-sm">
    Usuarios Eliminados </a>

    <?php if (!empty($usuarios) && is_array($usuarios)) : ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Perfil</th>
                    <th>Acciones</th>
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
                        <td>
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
    <?php else : ?>
        <div class="alert alert-info">No hay usuarios registrados.</div>
    <?php endif ?>
</div>
