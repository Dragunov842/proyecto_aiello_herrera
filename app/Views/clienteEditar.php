<br></br>
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    <h3 class="card-title text-center mb-4">✏️ Editar Datos Personales</h3>

                    <?php if (session()->has('mensaje')): ?>
                        <div class="alert alert-success text-center">
                            <?= session('mensaje') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('clienteActualizar') ?>" method="post" novalidate>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="<?= esc($usuario['nombre']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" name="apellido" id="apellido" class="form-control" value="<?= esc($usuario['apellido']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?= esc($usuario['email']) ?>" required>
                        </div>

                        <hr class="my-4">

                        <div class="mb-3">
                            <label for="contraseña" class="form-label">Nueva Contraseña <small class="text-muted">(opcional)</small></label>
                            <input type="password" name="contraseña" id="contraseña" class="form-control" minlength="6">
                        </div>

                        <div class="mb-4">
                            <label for="contraseña_confirm" class="form-label">Confirmar Contraseña</label>
                            <input type="password" name="contraseña_confirm" id="contraseña_confirm" class="form-control" minlength="6">
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                            <button type="submit" class="btn btn-success px-4">💾 Guardar cambios</button>
                            <a href="<?= base_url() ?>" class="btn btn-outline-secondary px-4">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

