<div class="container mt-5">
    <h2 class="text-center mb-4" style="color:white;">Selecciona tu método de pago</h2>

    <form method="post" action="<?= base_url('finalizarCompra') ?>">
        <?= csrf_field() ?>

        <div class="row justify-content-center">

            <!-- Tarjeta de crédito -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-primary">
                    <div class="card-body text-center">
                        <i class="fas fa-credit-card fa-2x text-primary mb-3"></i>
                        <h5 class="card-title">Tarjeta de Crédito</h5>
                        <p class="card-text">Visa, MasterCard, American Express</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metodo_pago" value="tarjeta" required>
                            <label class="form-check-label">Seleccionar</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transferencia -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-success">
                    <div class="card-body text-center">
                        <i class="fas fa-university fa-2x text-success mb-3"></i>
                        <h5 class="card-title">Transferencia Bancaria</h5>
                        <p class="card-text">Realiza una transferencia directa desde tu banco.</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metodo_pago" value="transferencia" required>
                            <label class="form-check-label">Seleccionar</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pago contra entrega -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-warning">
                    <div class="card-body text-center">
                        <i class="fas fa-truck fa-2x text-warning mb-3"></i>
                        <h5 class="card-title">Pago Contra Entrega</h5>
                        <p class="card-text">Paga cuando recibas el producto.</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metodo_pago" value="contra_entrega" required>
                            <label class="form-check-label">Seleccionar</label>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg">Pagar</button>
        </div>
    </form>
</div>
