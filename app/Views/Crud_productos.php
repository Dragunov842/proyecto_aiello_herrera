<div class="container mt-4">
<br></br>
  <h2 class="title text-white mt-5 text-center text-md-start"><?= esc($titulo) ?></h2>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
      <?= session()->getFlashdata('success') ?>
    </div>
  <?php endif; ?>

  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
      <thead class="thead-dark">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Imagen</th>
          <th>Categoría</th>
          <th>Precio</th>
          <th>Precio Venta</th>
          <th>Stock</th>
          <th>Stock Mínimo</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($productos)): ?>
          <?php foreach ($productos as $prod): ?>
            <tr>
              <td><?= esc($prod['id']) ?></td>
              <td><?= esc($prod['nombre_prod']) ?></td>
              <td>
                <?php if (!empty($prod['imagen'])): ?>
                  <img src="<?= base_url('assets/img/catalogo/' . $prod['imagen']) ?>" width="60" alt="Imagen producto" class="img-fluid rounded">
                <?php else: ?>
                  <span class="text-muted">Sin imagen</span>
                <?php endif; ?>
              </td>
              <td><?= esc($prod['categoria_id']) ?></td>
              <td>$<?= esc($prod['precio']) ?></td>
              <td>$<?= esc($prod['precio_vta']) ?></td>
              <td><?= esc($prod['stock']) ?></td>
              <td><?= esc($prod['stock_min']) ?></td>
              <td>
                <?= esc($prod['eliminado'] === 'SI' ? 'Baja' : 'Activo') ?>
              </td>
              <td class="d-flex flex-column flex-md-row gap-2">
                <a href="<?= base_url('singleProducto' . $prod['id']) ?>" class="btn btn-warning btn-sm">Editar</a>

                <?php if ($prod['eliminado'] === 'SI'): ?>
                  <a href="<?= base_url('activarProducto' . $prod['id']) ?>" class="btn btn-success btn-sm">Activar</a>
                <?php else: ?>
                  <a href="<?= base_url('borrarProducto' . $prod['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="10" class="text-center">No hay productos registrados.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
