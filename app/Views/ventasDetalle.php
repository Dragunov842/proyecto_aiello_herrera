<div class="container my-5">
    <div class="text-center">
<br></br>
        <h3 class="title color:white">Detalle de la Venta #<?= esc($venta['id']) ?></h>
        <h3 class="title color:white">Consulta la información detallada de la compra</h3>
    </div>

    <!-- Información del Cliente -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Información del Cliente</h5>
                </div>
                <div class="card-body">
                    <p><strong>Nombre:</strong> <?= esc($usuario['nombre']) ?> <?= esc($usuario['apellido']) ?></p>
                    <p><strong>Fecha de Venta:</strong> <?= esc($venta['fecha']) ?></p>
                    <p><strong>Total:</strong> <span class="fw-bold text-success">$<?= number_format($venta['total_venta'], 2, ',', '.') ?></span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Productos Comprados -->
    <div class="row justify-content-center">
        <div class="col-12 col-md-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Productos Comprados</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0 table-hover table-striped align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detalles as $detalle): ?>
                                    <tr>
                                        <td><?= esc($detalle['producto_descripcion']) ?></td>
                                        <td><?= esc($detalle['cantidad']) ?></td>
                                        <td>$<?= number_format($detalle['precio'], 2, ',', '.') ?></td>
                                        <td class="fw-bold text-success">
                                            $<?= number_format($detalle['precio'] * $detalle['cantidad'], 2, ',', '.') ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón de volver -->
    <div class="text-center mt-4">
        <a href="<?= site_url('listarVentas') ?>" class="btn btn-outline-primary">
            ← Volver al Historial
        </a>
    </div>
</div>

