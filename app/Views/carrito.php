<div class="container mt-5">
<br></br>
<br></br>
    <h2 class="title color:white text-center mb-4">Tu carrito</h2>
    <?php if (session()->has('mensaje')) : ?>
    <div class="alert alert-warning text-center">
        <?= session('mensaje') ?>
    </div>
<?php endif; ?>


    <?php if (empty($carrito)) : ?>
        <div class="alert alert-info text-center">No hay productos en tu carrito.</div>
    <?php else : ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
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
                                <form action="<?= base_url('carritoActualizarCantidad') ?>" method="post" class="d-flex flex-column flex-md-row align-items-center justify-content-center gap-2">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <input type="number" name="cantidad" value="<?= isset($item['cantidad']) ? $item['cantidad'] : 1 ?>" min="1" class="form-control form-control-sm w-100 w-md-50">
                                    <button type="submit" class="btn btn-sm btn-info">Actualizar</button>
                                </form>
                            </td>
                            <td>$<?= number_format($item['precio'], 2) ?></td>
                            <td>$<?= number_format($item['precio'] * (isset($item['cantidad']) ? $item['cantidad'] : 1), 2) ?></td>
                            <td>
                                <a href="<?= base_url('carritoEliminar' . $item['id']) ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                        <?php $total += $item['precio'] * (isset($item['cantidad']) ? $item['cantidad'] : 1); ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="text-center">
            <h4 style="color:white">Total: $<?= number_format($total, 2) ?></h4>
            <a href="<?= base_url('carritoVaciar') ?>" class="btn btn-warning mt-2">Vaciar Carrito</a>
            <a href="<?= base_url('finalizarCompra') ?>" class="btn btn-success mt-2">Finalizar Compra</a>
        </div>
    <?php endif; ?>
</div>
<br></br>
<br></br>
