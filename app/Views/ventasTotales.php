<style>
.pagination .page-link {
    background-color: beige;
    color: white;
}
</style>

<br><br>

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
            <div class="col-md-3 d-flex align-items-end">
                <button id="descargarPdf" class="btn btn-danger w-100">
                    Descargar PDF
                </button>
            </div>
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
        </div>
    <?php else : ?>
        <div class="alert alert-info text-center">
            No se encontraron compras realizadas.
        </div>
    <?php endif; ?>
</div>

<!-- jQuery y DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- jsPDF y autoTable -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

<script>
    // Filtro personalizado por fechas
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        let min = $('#min').val();
        let max = $('#max').val();
        let fecha = data[1]; // Columna de fecha (índice 1)

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
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
            },
            pageLength: 10
        });

        // Redibujar tabla al cambiar fechas
        $('#min, #max').on('change', function () {
            tabla.draw();
        });

        // Descargar PDF
        document.getElementById("descargarPdf").addEventListener("click", function () {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            doc.setFontSize(16);
            doc.text("Historial de Compras", 14, 20);

            // Obtener todas las filas filtradas (sin importar paginación)
            const datosFiltrados = tabla.rows({ filter: 'applied' }).data().toArray();

            if (datosFiltrados.length === 0) {
                alert("No hay datos filtrados para exportar.");
                return;
            }

            const filas = datosFiltrados.map(row => [row[0], row[1], row[2]]);

            doc.autoTable({
                head: [['# Venta', 'Fecha', 'Total']],
                body: filas,
                startY: 30,
            });

            doc.save("historial_compras.pdf");
        });
    });
</script>


