<div class="container mt-5">
    <h2>Tu carrito</h2>

    <?php if (empty($carrito)) : ?>
        <p>No hay productos en tu carrito.</p>
    <?php else : ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
            <?php $total = 0; ?>
            <?php foreach ($carrito as $index => $item): ?>
                <tr>
                    <td><?= esc($item['nombre']) ?></td>
                    <td>
                        <form action="<?= base_url('carrito/actualizarCantidad') ?>" method="post" class="d-flex">
                            <input type="hidden" name="index" value="<?= $index ?>">
                            <input type="number" name="cantidad" value="<?= $item['cantidad'] ?>" min="1" class="form-control form-control-sm w-50">
                            <button type="submit" class="btn btn-sm btn-info ms-2">Comprar</button>
                        </form>
                    </td>
                    <td>$<?= number_format($item['precio'], 2) ?></td>
                    <td>$<?= number_format($item['precio'] * $item['cantidad'], 2) ?></td>
                    <td>
                        <a href="<?= base_url('carrito/eliminar/' . $item['producto_id']) ?>" class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
                <?php $total += $item['precio'] * $item['cantidad']; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
        <h4>Total: $<?= number_format($total, 2) ?></h4>
        <a href="<?= base_url('carrito/vaciar') ?>" class="btn btn-warning">Vaciar Carrito</a>
    <?php endif; ?>
</div>
