<!-- productos/editar.php -->

<h2>Editar Producto</h2>

<?php if(session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach(session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= site_url('actualizarProducto' . $producto['producto_id']) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?= set_value('nombre', $producto['nombre']) ?>" required minlength="3" />
    </div>

    <div>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" maxlength="250" required><?= set_value('descripcion', $producto['descripcion']) ?></textarea>
    </div>

    <div>
        <label for="precio">Precio:</label>
        <input type="number" step="0.01" name="precio" id="precio" value="<?= set_value('precio', $producto['precio']) ?>" required />
    </div>

    <div>
        <label for="descuento">Descuento (%):</label>
        <input type="number" step="0.01" name="descuento" id="descuento" value="<?= set_value('descuento', $producto['descuento']) ?>" required />
    </div>

    <div>
        <label for="id_categoria">Categoría:</label>
        <select name="id_categoria" id="id_categoria" required>
            <option value="">-- Seleccione categoría --</option>
            <?php 
            // Suponiendo que tienes un array $categorias con id y nombre
            foreach ($categorias as $categoria): 
                $selected = (set_value('id_categoria', $producto['id_categoria']) == $categoria['id']) ? 'selected' : '';
            ?>
                <option value="<?= esc($categoria['id']) ?>" <?= $selected ?>><?= esc($categoria['ct_nombre']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" value="<?= set_value('cantidad', $producto['cantidad']) ?>" required min="0" />
    </div>

    <div>
        <label for="img">Imagen actual:</label><br>
        <?php if (!empty($producto['img'])): ?>
            <img src="<?= base_url('writable/uploads/' . $producto['img']) ?>" alt="Imagen producto" style="max-width: 150px; max-height: 150px;">
        <?php else: ?>
            <p>No hay imagen cargada</p>
        <?php endif; ?>
    </div>

    <div>
        <label for="img">Cambiar imagen (jpg/png, max 4MB):</label>
        <input type="file" name="img" id="img" accept="image/jpeg, image/png" />
    </div>

    <div>
        <button type="submit">Actualizar Producto</button>
        <a href="<?= site_url('Catalogo') ?>">Cancelar</a>
    </div>
</form>
