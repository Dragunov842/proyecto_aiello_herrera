<div class="container mt-5">
    <h2 class="mb-4">Productos Eliminados</h2>

    <?php if (!empty($producto) && is_array($producto)) : ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Precio Venta</th>
                    <th>Stock</th>
                    <th>Stock Mínimo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($producto as $prod) : ?>
                    <tr>
                        <td><?= esc($prod['id']) ?></td>
                        <td><?= esc($prod['nombre_prod']) ?></td>
                        <td><?= esc($prod['categoria_id']) ?></td>
                        <td>$<?= esc($prod['precio']) ?></td>
                        <td>$<?= esc($prod['precio_vta']) ?></td>
                        <td><?= esc($prod['stock']) ?></td>
                        <td><?= esc($prod['stock_min']) ?></td>
                        <td>
                            <a href="<?= site_url('activarproducto/' . $prod['id']) ?>" class="btn btn-success btn-sm">
                                Restaurar
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="alert alert-info">No hay productos eliminados.</div>
    <?php endif ?>
</div>
