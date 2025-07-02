<footer class="footer">
  <div class="container">
    <div class="row text-center text-md-start align-items-center">
      
      <!-- Iconos sociales -->
      <div class="col-12 col-md-4 mb-3 mb-md-0 d-flex justify-content-center justify-content-md-start">
        <div class="iconos d-flex gap-3">
          <a href="https://www.instagram.com/cafeleblanc_ve/">
            <img src="assets/img/Instagram.png" alt="icono instagram" class="icono-img" width="30">
          </a>
          <a href="https://web.whatsapp.com">
            <img src="assets/img/whatsapp.png" alt="icono whatsapp" class="icono-img" width="30">
          </a>
        </div>
      </div>

      <!-- Texto legal -->
      <div class="col-12 col-md-4 mb-3 mb-md-0 text-center">
        <p class="footer-text mb-0">
          | Leblanc™ todos los derechos registrados 2025 |
        </p>
      </div>

      <!-- Enlaces de navegación -->
      <div class="col-12 col-md-4 d-flex flex-column flex-md-row justify-content-center justify-content-md-end gap-2">
        <a href="<?= base_url('contactenos'); ?>" class="footer-nav">Contáctenos</a>
        <a href="<?= base_url('nosotros'); ?>" class="footer-nav">Sobre nosotros</a>
        <a href="<?= base_url('condiciones'); ?>" class="footer-nav">Términos y condiciones</a>
      </div>
    </div>

    <!-- Suscripción -->
<div class="row mt-4">
  <div class="col-12 text-center">
    <h5>Suscríbete Para Conocer Novedades</h5>
    <p>Mensualmente con Ofertas y Novedades Exclusivas</p>

    <!-- Formulario de Suscripción -->
    <form class="d-flex flex-column flex-sm-row justify-content-center gap-2 mt-2" id="formSuscripcion">
      <input id="emailInput" class="form-control w-auto" type="email" placeholder="Correo Electrónico">
      <button type="submit" class="btn btn-primary">Suscribirse</button>
    </form>

    <!-- Área de mensaje -->
    <div id="mensajeSuscripcion" class="mt-3"></div>
  </div>
</div>

<!-- Script de Validación -->
<script>
  document.getElementById('formSuscripcion').addEventListener('submit', function(e) {
    e.preventDefault(); // Evita que se recargue la página

    const emailInput = document.getElementById('emailInput');
    const mensaje = document.getElementById('mensajeSuscripcion');
    const email = emailInput.value.trim();

    if (email === '') {
      mensaje.innerHTML = '<div class="alert alert-warning" role="alert">⚠️ Por favor, ingresa un correo electrónico.</div>';
    } else {
      mensaje.innerHTML = '<div class="alert alert-success" role="alert">✅ ¡Gracias por tu suscripción!</div>';
      emailInput.value = ''; // Limpia el campo después de enviar
    }
  });
</script>


</footer>
</body>
</html>
