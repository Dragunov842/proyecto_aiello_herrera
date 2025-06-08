<div class="container pt-5 mt-5 mb-5">
    <div class="card-header text-justify">
        <div class="row d-flex justify-content-center">
            <div class="card col-lg-6">
                <h4 class="mt-3 text-center">Registrarse</h4>

                <?php $validation = \Config\Services::validation(); ?>

                <form method="post" action="<?= base_url('enviar-form') ?>">
                    <?= csrf_field(); ?>

                    <?php if (session()->getFlashdata('fail')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                    <?php endif; ?>

                    <div class="card-body">
                        <!-- Nombre -->
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input name="nombre" type="text" class="form-control" placeholder="Nombre" value="<?= old('nombre') ?>">
                            <?php if ($validation->getError('nombre')): ?>
                                <div class="alert alert-danger mt-2"><?= $validation->getError('nombre'); ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Apellido -->
                        <div class="mb-3">
                            <label class="form-label">Apellido</label>
                            <input type="text" name="apellido" class="form-control" placeholder="Apellido" value="<?= old('apellido') ?>">
                            <?php if ($validation->getError('apellido')): ?>
                                <div class="alert alert-danger mt-2"><?= $validation->getError('apellido'); ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Usuario -->
                        <div class="mb-3">
                            <label class="form-label">Nombre de Usuario</label>
                            <input type="text" name="usuario" class="form-control" placeholder="Usuario" value="<?= old('usuario') ?>">
                            <?php if ($validation->getError('usuario')): ?>
                                <div class="alert alert-danger mt-2"><?= $validation->getError('usuario'); ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Email" value="<?= old('email') ?>">
                            <?php if ($validation->getError('email')): ?>
                                <div class="alert alert-danger mt-2"><?= $validation->getError('email'); ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="contraseña" class="form-control" placeholder="Contraseña">
                            <?php if ($validation->getError('contraseña')): ?>
                                <div class="alert alert-danger mt-2"><?= $validation->getError('contraseña'); ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Perfil (oculto o visible según necesidad) -->
                        <input type="hidden" name="perfil_id" value="2">

                        <div class="text-center">
                            <input type="submit" value="Registrarse" class="btn btn-primary mt-2">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

