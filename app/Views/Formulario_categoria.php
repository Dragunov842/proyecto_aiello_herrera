<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
      <div class="card shadow-lg border-0 rounded-4 bg-light">
        <div class="card-body p-4">

          <h2 class="text-center mb-4 text-primary">Registrar nueva categoría</h2>

          <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <?= session()->getFlashdata('success') ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
          <?php endif; ?>

          <?php if(isset($validation)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?= $validation->listErrors() ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
          <?php endif; ?>

          <form method="post" action="<?= base_url('guardar-categoria') ?>">
            <?= csrf_field() ?>

            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre de la categoría</label>
              <input type="text" class="form-control rounded-3" id="nombre" name="nombre" placeholder="Ej: Frutas">
            </div>

            <div class="mb-3">
              <label for="descripcion" class="form-label">Descripción</label>
              <textarea class="form-control rounded-3" id="descripcion" name="descripcion" rows="3" placeholder="Descripción de la categoría..."></textarea>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-primary rounded-pill">Guardar Categoría</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

