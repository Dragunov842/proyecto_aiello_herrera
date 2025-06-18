<!-- Datos del Cliente -->
<h5 class="text-center">Datos del cliente</h5>
<p><strong>Apellido:</strong> <?= esc($usuario['apellido']) ?></p>
<p><strong>Nombre:</strong> <?= esc($usuario['nombre']) ?></p>
<p><strong>Correo electrónico:</strong> <?= esc($usuario['email']) ?></p>

<hr>

<!-- Productos -->
<h5 class="text-center">Productos</h5>
<ul class="list-group">
    <?php 
    $total = 0;
    foreach ($detalle as $item): 
        $subtotal = $item['cantidad'] * $item['precio'];
        $total += $subtotal;
    ?>
    <li class="list-group-item bg-transparent text-white border-white d-flex justify-content-between align-items-center">
        <span><?= esc($item['descripcion']) ?></span> 
        <span><?= $item['cantidad'] ?> x $<?= number_format($item['precio'], 2, ',', '.') ?></span>
        <span>= $<?= number_format($subtotal, 2, ',', '.') ?></span>
    </li>
    <?php endforeach; ?>
</ul>

<hr>

<!-- Total -->
<h5 class="text-center">Total de la compra</h5>
<p class="text-center fw-bold fs-5">$<?= number_format($total, 2, ',', '.') ?></p>
