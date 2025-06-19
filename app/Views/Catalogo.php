<!-- app/Views/front/Catalogo/Catalogo_view.php -->
<div class="container mt-4">
    <h2 class="text-center mb-4"><?= esc($titulo) ?></h2>

    <!-- Filtro por categoría -->
    <form method="post" action="<?= base_url('listado-productosfiltrados') ?>">
        <div class="row mb-4">
            <div class="col-md-4 offset-md-4">
                <select name="categoria_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Todas las categorías</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= esc($categoria['id']) ?>">
                            <?= esc($categoria['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </form>

    <!-- Mostrar productos -->
    <div class="row">
        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <?php if ($producto['imagen']): ?>
                           <img src="data:image/jpeg;base64,<?= base64_encode($producto['imagen']) ?>" class="card-img-top" alt="<?= esc($producto['nombre_prod']) ?>">
                        <?php else: ?>
                            <img src="<?= base_url('assets/default.jpg') ?>" class="card-img-top" alt="Sin imagen">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($producto['nombre_prod']) ?></h5>
                            <p class="card-text">Precio: $<?= esc($producto['precio_vta']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p class="text-center">No hay productos disponibles.</p>
            </div>
        <?php endif; ?>
    </div>
</div>