<?php include 'session.php'; ?>
<link rel="stylesheet" href="assets/style.css">

<nav class="navbar">
  <div class="nav-brand">MiApp</div>
  <button class="menu-toggle" onclick="toggleMenu()">☰</button>

  <ul class="nav-links" id="navLinks">
    <li><a href="index.php">Inicio</a></li>
    <li><a href="acerca.php">Acerca</a></li>

    <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] === 'usuario'): ?>
      <li><a href="perfil.php">Perfil</a></li>
      <li><a href="pedidos.php">Mis Pedidos</a></li>
    <?php elseif (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] === 'admin'): ?>
      <li><a href="">Panel Admin</a></li>
      <li><a href="usuarios.php">Usuarios</a></li>
    <?php endif; ?>

    <?php if (isset($_SESSION['usuario'])): ?>
      <li><a href="logout.php">Cerrar sesión</a></li>
    <?php else: ?>
      <li><a href="login.php">Iniciar sesión</a></li>
    <?php endif; ?>
  </ul>
</nav>

<script>
function toggleMenu() {
  document.getElementById("navLinks").classList.toggle("show");
}
</script>
