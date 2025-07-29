<?php
$session = session();
$nombre = $session->get('nombre');
$perfil = $session->get('perfil_id');?>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" 
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenido colapsable -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if ($perfil == 0): ?>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('productosEstatico'); ?>">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('comercializacion'); ?>">Comercialización</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('registrar'); ?>">Registrarse</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('login'); ?>">Iniciar sesión</a></li>

                <?php elseif ($perfil == 1): ?>
    <li class="nav-item">
        <a class="nav-link disabled">Usuario: <?= esc($nombre); ?></a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="agregarMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Agregar
        </a>
        <ul class="dropdown-menu" aria-labelledby="agregarMenu">
            <li><a class="dropdown-item" href="<?= base_url('nueva-categoria'); ?>">Categorías</a></li>
            <li><a class="dropdown-item" href="<?= base_url('registrar'); ?>">Usuarios</a></li>
            <li><a class="dropdown-item" href="<?= base_url('crearProducto'); ?>">Producto</a></li>
        </ul>
    </li>

    <li class="nav-item"><a class="nav-link" href="<?= base_url('Crud_productos'); ?>">CRUD Productos</a></li>
    <li class="nav-item"><a class="nav-link" href="<?= base_url('Crud_usuarios'); ?>">CRUD Usuarios</a></li>
    <li class="nav-item"><a class="nav-link" href="<?= base_url('contactenosListar'); ?>">Consultas</a></li>
    </li>
    <li class="nav-item"><a class="nav-link" href="<?= base_url('listarVentas'); ?>">Historial de ventas</a></li>
    <li class="nav-item"><a class="nav-link text-danger" href="<?= base_url('cerrarSesion'); ?>">Cerrar sesión</a></li>

                <?php elseif ($perfil == 2): ?>
                    <li class="nav-item"><a class="nav-link disabled">Usuario: <?= esc($nombre); ?></a>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('listado-productos'); ?>">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('comercializacion'); ?>">Comercialización</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('ver-carrito') ?>" class="btn btn-outline-light"> 🛒 Carrito (<?= count(session()->get('carrito') ?? []) ?>)</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('historial-compras') ?>">🧾 Historial de Compras</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="<?= base_url('cerrarSesion'); ?>">Cerrar sesión</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
</header>
</head>
<body>
<script src="assets/js/bootstrap.bundle.min.js"></script>