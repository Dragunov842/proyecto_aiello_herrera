<br></br>
<div class="container my-5">
    <div class="text-center mb-4">
        <h2 class="title color:whitefw-bold">Detalle de tu Compra</h2>
        <p class="title color:white">Gracias por tu compra.</p>
    </div>

    <?php if (!empty($detalle)): ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $total = 0;
                        foreach ($detalle as $item): 
                            $subtotal = $item['cantidad'] * $item['precio'];
                            $total += $subtotal;
                    ?>
                        <tr>
                            <td><?= esc($item['descripcion']) ?></td>
                            <td><?= esc($item['cantidad']) ?></td>
                            <td>$<?= number_format($item['precio'], 2, ',', '.') ?></td>
                            <td>$<?= number_format($subtotal, 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="table-secondary fw-bold">
                        <td colspan="3">Total</td>
                        <td>$<?= number_format($total, 2, ',', '.') ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">
            No hay productos en esta compra.
        </div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="<?= base_url('listado-productos') ?>" class="btn btn-outline-primary">Seguir Comprando</a>
    </div>
</div>
