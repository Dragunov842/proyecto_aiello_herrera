<div class="container mt-5 mb-5" style="max-width: 600px;">
    <h3 class="title" style="color:white; margin-top:100px;">Editar productos</h3>

    <form action="<?= site_url('modifica' . $old['id']) ?>" method="post" enctype="multipart/form-data" class="border rounded p-4 shadow-sm bg-white">

        <div class="mb-3">
            <label class="form-label">Producto</label>
            <input type="text" name="nombre_prod" value="<?= esc($old['nombre_prod']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="categoria" class="form-select" required>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $old['categoria_id'] ? 'selected' : '' ?>>
                        <?= esc($cat['descripcion']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" name="precio" value="<?= esc($old['precio']) ?>" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio venta</label>
            <input type="number" name="precio_vta" value="<?= esc($old['precio_vta']) ?>" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" value="<?= esc($old['stock']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stock Min</label>
            <input type="number" name="stock_min" value="<?= esc($old['stock_min']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen actual:</label><br>
            <img src="<?= base_url('assets/img/catalogo/' . $old['imagen']) ?>" alt="imagen producto" class="img-thumbnail" width="100">
        </div>

        <div class="mb-4">
            <label class="form-label">Imagen del producto (formatos compatibles: .jpg, .png)</label>
            <input type="file" name="imagen" class="form-control">
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">Enviar</button>
            <a href="<?= site_url('crearProducto') ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
