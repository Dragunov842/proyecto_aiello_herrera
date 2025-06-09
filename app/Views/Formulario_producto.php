<?php helper('form'); ?>
<div class="container pt-5 mt-5 mb-5">
    <div class="card-header text-justify">
        <div class="row d-flex justify-content-center">
            <div class="card col-lg-6">
                <h4 class="mt-3 text-center">Registrar Producto</h4>

                <?php $validation = \Config\Services::validation(); ?>
                <?php helper('form'); ?>
                <?= form_open_multipart('producto/guardar') ?>
                <?= csrf_field(); ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                <?php endif; ?>

                <div class="card-body">

                    <!-- Nombre del producto -->
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input name="nombre_prod" type="text" class="form-control" value="<?= old('nombre_prod') ?>" placeholder="Nombre del producto">
                        <?php if ($validation->getError('nombre_prod')): ?>
                            <div class="alert alert-danger mt-2"><?= $validation->getError('nombre_prod'); ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Imagen -->
                    <div class="mb-3">
                        <label class="form-label">Imagen del producto</label>
                        <input name="imagen" type="file" class="form-control">
                        <?php if ($validation->getError('imagen')): ?>
                            <div class="alert alert-danger mt-2"><?= $validation->getError('imagen'); ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Categoría -->
                    <div class="mb-3">
                        <label class="form-label">Categoría ID</label>
                        <input name="categoria_id" type="number" class="form-control" value="<?= old('categoria_id') ?>" placeholder="ID de categoría">
                        <?php if ($validation->getError('categoria_id')): ?>
                            <div class="alert alert-danger mt-2"><?= $validation->getError('categoria_id'); ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Precio -->
                    <div class="mb-3">
                        <label class="form-label">Precio (Costo)</label>
                        <input name="precio" type="number" step="0.01" class="form-control" value="<?= old('precio') ?>">
                        <?php if ($validation->getError('precio')): ?>
                            <div class="alert alert-danger mt-2"><?= $validation->getError('precio'); ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Precio de venta -->
                    <div class="mb-3">
                        <label class="form-label">Precio de Venta</label>
                        <input name="precio_vta" type="number" step="0.01" class="form-control" value="<?= old('precio_vta') ?>">
                        <?php if ($validation->getError('precio_vta')): ?>
                            <div class="alert alert-danger mt-2"><?= $validation->getError('precio_vta'); ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Stock -->
                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input name="stock" type="number" class="form-control" value="<?= old('stock') ?>">
                        <?php if ($validation->getError('stock')): ?>
                            <div class="alert alert-danger mt-2"><?= $validation->getError('stock'); ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Stock mínimo -->
                    <div class="mb-3">
                        <label class="form-label">Stock Mínimo</label>
                        <input name="stock_min" type="number" class="form-control" value="<?= old('stock_min') ?>">
                        <?php if ($validation->getError('stock_min')): ?>
                            <div class="alert alert-danger mt-2"><?= $validation->getError('stock_min'); ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Eliminado -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="eliminado" value="1" <?= old('eliminado') ? 'checked' : '' ?>>
                        <label class="form-check-label">¿Producto eliminado?</label>
                    </div>

                    <!-- Botón -->
                    <div class="text-center">
                        <input type="submit" value="Guardar Producto" class="btn btn-primary mt-2">
                    </div>
                </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
