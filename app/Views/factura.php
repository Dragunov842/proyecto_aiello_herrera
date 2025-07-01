<!DOCTYPE html>
<?php use App\Models\productos_model; $productoModel = new productos_model(); ?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura de Venta</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
    <h2>Factura de Venta</h2>
    <p><strong>Cliente:</strong> <?= esc($usuario['nombre']) . ' ' . esc($usuario['apellido']) ?></p>
    <p><strong>Fecha:</strong> <?= esc($venta['fecha']) ?></p>
    <p><strong>Venta N°:</strong> <?= esc($venta['id']) ?></p>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            <?php foreach ($detalles as $item): 
                $producto = $productoModel->find($item['producto_id']);
                $descripcion = $producto ? $producto['nombre_prod'] : 'Producto eliminado';
                $subtotal = $item['precio'] * $item['cantidad'];
                $total += $subtotal;
            ?>
            <tr>
                <td><?= esc($descripcion) ?></td>
                <td><?= $item['cantidad'] ?></td>
                <td>$<?= number_format($item['precio'], 2, ',', '.') ?></td>
                <td>$<?= number_format($subtotal, 2, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="total">
                <td colspan="3">Total</td>
                <td>$<?= number_format($total, 2, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
