<div class="container mt-5">
    <h2>Registrar nueva categoría</h2>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if(isset($validation)): ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('guardar-categoria') ?>">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la categoría</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Frutas">
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Descripción de la categoría..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Categoría</button>
    </form>
</div>
