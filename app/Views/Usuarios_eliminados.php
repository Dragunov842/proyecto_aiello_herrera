<div class="container mt-5">
    <h2 class="title" style="color:white; margin-top:100px;">Usuarios Eliminados</h2>

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
                            <a href="<?= site_url('activarusuario/'.$usuario['id_usuario']) ?>" class="btn btn-success btn-sm">
                                Restaurar
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="alert alert-info">No hay usuarios eliminados.</div>
    <?php endif ?>
</div>
