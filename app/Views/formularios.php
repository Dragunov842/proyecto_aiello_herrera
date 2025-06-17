<div class="container pt-5 mt-5 mb-5">
        <div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="card col-lg-6 p-4">
        <h4 class="text-center mb-4">Editar Usuario</h4>
            <form action="<?php echo base_url('actualizarUsuario/'); ?>" method="POST" enctype="multipart/form-data">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>

                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" placeholder="Ingresa tu apellido" required>

                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" placeholder="Ingresa tu correo electrónico" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña">

                <div class="buttons">
                    <button type="submit" class="save-btn">Guardar</button>
                    <input type="reset" value="Limpiar" class="btn-reset">
                    <button type="button" class="cancel-btn"
                        onclick="window.location.href='<?php echo base_url('/'); ?>';">Cancelar
                    </button>
                </div>
            </form>
             </div>
        </div>
    </div>
</div>