<?php
$session = session();
$nombre = $session->get('nombre');
$perfil = $session->get('perfil_id');?>
<nav class="navbar">
        <?php if($perfil == 0):?>

        <a href="<?php echo base_url('login');?>" class="nav-link">Productos</a>
        <a href="<?php echo base_url('comercializacion');?>" class="nav-link">Comercializacion</a>
        <a href="<?php echo base_url('registrar')?>" class="nav-link"> Registrarse</a>
        <a href="<?php echo base_url('login')?>" class="nav-link"> iniciar sesion</a>

        <?php elseif($perfil == 1):?>
            <div class="nav-link">
                <a href="">Usuario: <?php echo session('nombre'); ?></a>
                
        </div>
            <a href="<?php echo base_url('Crud_usuarios');?>" class="nav-link">Crud usuarios</a>
            <a href="<?php echo base_url('listado-productos');?>" class="nav-link">Productos</a>
            <a href="<?php echo base_url('comercializacion');?>" class="nav-link">Comercializacion</a>
            <a href="<?php echo base_url('cerrarSesion')?>" class="nav-link"> Cerrar Sesion </a>

        <?php elseif($perfil == 2):?>
            <div class="nav-link">
                <a href="">Cliente: <?php echo session('nombre'); ?> </a>
        </div>
        
        <a href="<?php echo base_url('listado-productos');?>" class="nav-link">Productos</a>
        <a href="<?php echo base_url('comercializacion');?>" class="nav-link">Comercializacion</a>
        <a href="<?php echo base_url('cerrarSesion')?>" class="nav-link"> Cerrar Sesion </a>
        <?php endif; ?>
    </nav>
</header>
</head>
<body>
<script src="assets/js/bootstrap.bundle.min.js"></script>