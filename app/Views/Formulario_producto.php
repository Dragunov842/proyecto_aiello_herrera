<div class="container mt-3 mb-4">
    <div class="card mx-auto shadow-sm" style="max-width: 720px;">
        <div class="card-header text-center">
            <h2 class="title text-danger mb-0">Alta de productos</h2>
        </div>

        <!-- Mensajes Flash -->
        <?php if (!empty(session()->getFlashData('fail'))): ?>
            <div class="alert alert-danger mx-3 mt-3"><?= session()->getFlashdata('fail'); ?></div>
        <?php endif; ?>
        <?php if (!empty(session()->getFlashdata('success'))): ?>
            <div class="alert alert-success mx-3 mt-3"><?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>

        <?php $validation = \Config\Services::validation(); ?>

        <!-- Formulario -->
        <form action="<?= base_url('guardarProd'); ?>" method="post" enctype="multipart/form-data">
            <div class="card-body">

                <!-- Producto -->
                <div class="mb-3">
                    <label for="nombre_prod" class="form-label">Producto</label>
                    <input class="form-control" type="text" name="nombre_prod" id="nombre_prod" value="<?= set_value('nombre_prod'); ?>" placeholder="Nombre del producto" autofocus>
                    <?php if ($validation->getError('nombre_prod')): ?>
                        <div class="alert alert-danger mt-2"><?= $validation->getError('nombre_prod'); ?></div>
                    <?php endif; ?>
                </div>

                <!-- Categoría -->
                <div class="mb-3">
                    <label for="categoria_id" class="form-label">Categoría</label>
                    <select class="form-select" name="categoria_id" id="categoria_id">
                        <option value="0">Seleccionar categoría</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= $categoria['id']; ?>">
                                <?= $categoria['id'] . '. ' . $categoria['descripcion']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if ($validation->getError('categoria_id')): ?>
                        <div class="alert alert-danger mt-2"><?= $validation->getError('categoria_id'); ?></div>
                    <?php endif; ?>
                </div>

                <!-- Precio costo -->
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio de costo</label>
                    <input class="form-control" type="text" name="precio" id="precio" value="<?= set_value('precio'); ?>">
                    <?php if ($validation->getError('precio')): ?>
                        <div class="alert alert-danger mt-2"><?= $validation->getError('precio'); ?></div>
                    <?php endif; ?>
                </div>

                <!-- Precio venta -->
                <div class="mb-3">
                    <label for="precio_vta" class="form-label">Precio de venta</label>
                    <input class="form-control" type="text" name="precio_vta" id="precio_vta" value="<?= set_value('precio_vta'); ?>">
                    <?php if ($validation->getError('precio_vta')): ?>
                        <div class="alert alert-danger mt-2"><?= $validation->getError('precio_vta'); ?></div>
                    <?php endif; ?>
                </div>

                <!-- Stock -->
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input class="form-control" type="text" name="stock" id="stock" value="<?= set_value('stock'); ?>">
                    <?php if ($validation->getError('stock')): ?>
                        <div class="alert alert-danger mt-2"><?= $validation->getError('stock'); ?></div>
                    <?php endif; ?>
                </div>

                <!-- Stock mínimo -->
                <div class="mb-3">
                    <label for="stock_min" class="form-label">Stock mínimo</label>
                    <input class="form-control" type="text" name="stock_min" id="stock_min" value="<?= set_value('stock_min'); ?>">
                    <?php if ($validation->getError('stock_min')): ?>
                        <div class="alert alert-danger mt-2"><?= $validation->getError('stock_min'); ?></div>
                    <?php endif; ?>
                </div>

                <!-- Imagen -->
                <div class="mb-4">
                    <label for="imagen" class="form-label">Imagen</label>
                    <input class="form-control" type="file" name="imagen" id="imagen" accept="image/png, image/jpg, image/jpeg" required>
                    <?php if ($validation->getError('imagen')): ?>
                        <div class="alert alert-danger mt-2"><?= $validation->getError('imagen'); ?></div>
                    <?php endif; ?>
                </div>

                <!-- Botones -->
                <div class="d-flex flex-column flex-sm-row justify-content-between gap-2">
                    <button type="submit" id="send_form" class="btn btn-success w-100 w-sm-auto">Enviar</button>
                    <button type="reset" class="btn btn-danger w-100 w-sm-auto">Cancelar</button>
                    <a href="<?= base_url('crearProducto'); ?>" class="btn btn-secondary w-100 w-sm-auto">Volver</a>
                </div>
            </div>
        </form>
    </div>
</div>
