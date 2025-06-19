<div class="container mt-4">
    <h2><?= esc($titulo) ?></h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Precio Venta</th>
                <th>Stock</th>
                <th>Stock Mínimo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $prod): ?>
                <tr>
                    <td><?= esc($prod['producto_id']) ?></td>
                    <td><?= esc($prod['nombre_prod']) ?></td>
                    <td>
                        <?php if (!empty($prod['imagen'])): ?>
                            <img src="<?= base_url('uploads/productos/' . $prod['imagen']) ?>" width="60" alt="Imagen producto">
                        <?php else: ?>
                            Sin imagen
                        <?php endif; ?>
                    </td>
                    <td><?= esc($prod['categoria_id']) ?></td>
                    <td>$<?= esc($prod['precio']) ?></td>
                    <td>$<?= esc($prod['precio_vta']) ?></td>
                    <td><?= esc($prod['stock']) ?></td>
                    <td><?= esc($prod['stock_min']) ?></td>
                    <td><?= esc($prod['eliminado'] === 'SI' ? 'baja' : 'Activo') ?></td>
                    <td>
                        <a href="<?= base_url('producto/singleproducto/' . $prod['producto_id']) ?>" class="btn btn-warning btn-sm">Editar</a>

                        <?php if ($prod['eliminado'] === 'SI'): ?>
                            <a href="<?= base_url('producto/activarproducto/' . $prod['producto_id']) ?>" class="btn btn-success btn-sm">Activar</a>
                        <?php else: ?>
                            <a href="<?= base_url('producto/deleteproducto/' . $prod['producto_id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="10" class="text-center">No hay productos registrados.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
