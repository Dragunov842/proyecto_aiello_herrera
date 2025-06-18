<div class="product-container">
    <h1>Detalle de Ventas</h1>

    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Fecha de Compra</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($compras)): ?>
                    <?php foreach ($compras as $compra): ?>
                        <tr>
                            <td><?= esc($compra['fecha']) ?></td>
                            <td>$<?= number_format($compra['total_venta'], 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">No se encontraron compras.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="<?= base_url('/') ?>" class="btn-Volver">Volver</a>
    </div>
</div>
