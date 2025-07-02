<br></br>

<div class="container my-5">
    <div class="text-center mb-4">
        <h2 class="text-white fw-bold">Consultas Recibidas</h2>
    </div>

    <?php if (session()->getFlashdata('mensaje')) : ?>
        <div class="alert alert-success text-center">
            <?= session()->getFlashdata('mensaje') ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($consultas)) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Correo</th>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($consultas as $consulta): ?>
                        <tr>
                            <td><?= esc($consulta['id']) ?></td>
                            <td><?= esc($consulta['correo']) ?></td>
                            <td><?= esc($consulta['tipo']) ?></td>
                            <td><?= esc($consulta['descripcion']) ?></td>
                            <td><?= esc($consulta['fecha']) ?></td>
                            <td>
                                <?php if ($consulta['leido']): ?>
                                    <span class="badge bg-success">Leído</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">No leído</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!$consulta['leido']) : ?>
                                    <form action="<?= base_url('contactenosMarcarLeido' . $consulta['id']) ?>" method="post">
                                        <button type="submit" class="btn btn-sm btn-primary">Marcar como leído</button>
                                    </form>
                                <?php else: ?>
                                    <button class="btn btn-sm btn-secondary" disabled>Leído</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">No hay consultas registradas.</div>
    <?php endif; ?>
</div>
<br></br>
<br></br>