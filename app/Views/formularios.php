<body>
<title>Editar Usuario</title>
<div class="form-container">
    <h2>Editar Usuario</h2>
    <form method="post" action="<?= site_url('actualizarUsuarios'. $usuario['id_usuario'])?>">
        <input type="hidden" name="id_usuario" value="<?= esc($usuario['id_usuario']) ?>">

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?= esc($usuario['nombre']) ?>" required>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" value="<?= esc($usuario['apellido']) ?>" required>

        <label for="email">Correo Electrónico:</label>
        <input type="text" name="correo" id="correo" value="<?= esc($usuario['email']) ?>" required>
        
        <label for="user">Usuario:</label>
        <input type="text" name="usuario" id="usuario" value="<?= esc($usuario['usuario']) ?>" required>

        <label for="id">Perfil_id:</label>
        <input type="text" name="perfil_id" id="perfil_id" value="<?= esc($usuario['perfil_id']) ?>" required>

        <button type="submit" class="btn">Guardar Cambios</button>
    </form>
</div>
</body>