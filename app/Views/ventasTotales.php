<div class="container my-5">
    <div class="text-center mb-4">
        <br></br>
        <h2 class="title color:white fw-bold">Historial de Compras</h2>
        <h3 class="title color:white">Consulta tus compras realizadas</h3>
    </div>

    <!-- Mensajes Flash -->
    <?php if (session()->has('mensaje')) : ?>
        <div class="alert alert-warning text-center">
            <?= session('mensaje') ?>
        </div>
    <?php endif; ?>

    <!-- Tabla de Ventas -->
    <?php if (!empty($ventas) && is_array($ventas)) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col"># Venta</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Total</th>
                        <th scope="col">Detalle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ventas as $venta) : ?>
                        <tr>
                            <td><?= esc($venta['id']) ?></td>
                            <td><?= esc($venta['fecha']) ?></td>
                            <td>$<?= number_format($venta['total_venta'], 2, ',', '.') ?></td>
                            <td>
                                <a href="<?= site_url('verDetalle' . $venta['id']) ?>" class="btn btn-sm btn-outline-primary">
                                    Ver Detalle
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="alert alert-info text-center">
            No se encontraron compras realizadas.
        </div>
    <?php endif; ?>
</div>
