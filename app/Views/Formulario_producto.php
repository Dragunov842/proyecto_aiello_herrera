<?php helper('form'); ?>
<div class="container pt-5 mt-5 mb-5">
    <div class="card-header text-justify">
        <div class="row d-flex justify-content-center">
            <div class="card col-lg-6">
                <h4 class="mt-3 text-center">Registrar Producto</h4>

                <?php $validation = \Config\Services::validation(); ?>
                <?= form_open_multipart('producto/guardar') ?>
                <?= csrf_field(); ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                <?php endif; ?>

                <div class="card-body">

                    <!-- Nombre del producto -->
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input name="nombre_prod" type="text" class="form-control" placeholder="Nombre del producto" value="<?= set_value('nombre_prod') ?>">
                        <?php if ($validation->getError('nombre_prod')): ?>
                            <div class="alert alert-danger mt-2"><?= $validation->getError('nombre_prod'); ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Descripción -->
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" placeholder="Descripción del producto"><?= set_value('descripcion') ?></textarea>
                        <?php if ($validation->getError('descripcion')): ?>
                            <div class="alert alert-danger mt-2"><?= $validation->getError('descripcion'); ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Imagen -->
                    <div class="mb-3">
                        <label class="form-label">Imagen del producto</label>
                        <input name="imagen" type="file" class="form-control" accept="image/*">
                        <?php if ($validation->getError('imagen')): ?>
                            <div class="alert alert-danger mt-2"><?= $validation->getError('imagen'); ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Categoría -->
                    <div class="mb-3">
                        <label class="form-label">Categoría</label>
                        <select name="categoria_id" class="form-select">
                            <option value="">Seleccione una categoría</option>
                            <?php foreach ($categorias as $cat): ?>
                                <option value="<?= esc($cat['id']) ?>" <?= set_select('categoria_id', $cat['id']) ?>>
                                    <?= esc($cat['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if ($validation->getError('categoria_id')): ?>
                            <div class="alert alert-danger mt-2"><?= $validation->getError('categoria_id'); ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Precio -->
                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input name="precio" type="number" step="0.01" class="form-control" placeholder="Precio del producto" value="<?= set_value('precio') ?>">
                        <?php if ($validation->getError('precio')): ?>
                            <div class="alert alert-danger mt-2"><?= $validation->getError('precio'); ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Precio de venta (opcional) -->
                    <div class="mb-3">
                        <label class="form-label">Precio de Venta (si difiere del precio)</label>
                        <input name="precio_vta" type="number" step="0.01" class="form-control" placeholder="Precio de venta (opcional)" value="<?= set_value('precio_vta') ?>">
                        <?php if ($validation->getError('precio_vta')): ?>
                            <div class="alert alert-danger mt-2"><?= $validation->getError('precio_vta'); ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Stock -->
                    <div class="mb-3">
                        <label class="form-label">Stock inicial</label>
                        <input name="stock" type="number" class="form-control" placeholder="Stock inicial" value="<?= set_value('stock') ?>">
                        <?php if ($validation->getError('stock')): ?>
                            <div class="alert alert-danger mt-2"><?= $validation->getError('stock'); ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Stock mínimo -->
                    <div class="mb-3">
                        <label class="form-label">Stock mínimo</label>
                        <input name="stock_min" type="number" class="form-control" value="<?= set_value('stock_min', 1) ?>">
                        <?php if ($validation->getError('stock_min')): ?>
                            <div class="alert alert-danger mt-2"><?= $validation->getError('stock_min'); ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Eliminado (oculto por defecto) -->
                    <input type="hidden" name="eliminado" value="0">

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
