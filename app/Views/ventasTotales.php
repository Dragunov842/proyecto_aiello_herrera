<style>
.pagination .page-link {
    background-color:beige;
    color: white;
}
</style>
<br></br>
<div class="container my-5">
    <div class="text-center mb-4">
        <h2 class="title fw-bold text-white">Historial de Compras</h2>
        <h3 class="title text-white">Consulta tus compras realizadas</h3>
    </div>

    <!-- Mensajes Flash -->
    <?php if (session()->has('mensaje')) : ?>
        <div class="alert alert-warning text-center">
            <?= session('mensaje') ?>
        </div>
    <?php endif; ?>

    <!-- Tabla de Ventas -->
    <?php if (!empty($ventas) && is_array($ventas)) : ?>
        <div class="row mb-3">
    <div class="col-md-3">
        <label class="text-white">Desde:</label>
        <input type="date" id="min" class="form-control">
    </div>
    <div class="col-md-3">
        <label class="text-white">Hasta:</label>
        <input type="date" id="max" class="form-control">
    </div>
</div>

        <div class="table-responsive">
            <table id="tablaVentas" class="table table-bordered table-hover table-striped align-middle text-center">
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
            <script>
    // Extensión personalizada para filtrar por fechas
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        let min = $('#min').val();
        let max = $('#max').val();
        let fecha = data[1]; // Columna Fecha (índice 1)

        if (!fecha) return true;

        let fechaCompra = new Date(fecha);
        let desde = min ? new Date(min) : null;
        let hasta = max ? new Date(max) : null;

        if ((desde === null || fechaCompra >= desde) &&
            (hasta === null || fechaCompra <= hasta)) {
            return true;
        }
        return false;
    });

    $(document).ready(function () {
        let tabla = $('#tablaVentas').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
            },
            "pageLength": 10
        });

        $('#min, #max').on('change', function () {
            tabla.draw();
        });
    });
</script>
        </div>
    <?php else : ?>
        <div class="alert alert-info text-center">
            No se encontraron compras realizadas.
        </div>
    <?php endif; ?>
</div>

