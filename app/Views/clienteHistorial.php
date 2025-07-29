<br></br>
<div class="container my-5">
    <h2 class="text-white mb-4">🧾 Historial de Compras</h2>

    <?php if (!empty($ventas)) : ?>
        <table class="table table-bordered table-striped bg-white text-center">
            <thead class="table-dark">
                <tr>
                    <th># Venta</th>
                    <th>Fecha</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventas as $venta): ?>
                    <tr>
                        <td><?= esc($venta['id']) ?></td>
                        <td><?= esc($venta['fecha']) ?></td>
                        <td>$<?= number_format($venta['total_venta'], 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Aún no has realizado compras.</div>
    <?php endif; ?>
</div>
<br></br>
<br></br>