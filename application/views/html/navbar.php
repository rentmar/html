<?php $usuario_activo = $this->ion_auth->user()->row(); ?>


<nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
	<!-- Logo -->
	<a class="navbar-brand" href="#">
		<?php
		$prop_img = array(
			'src' => 'assets/img/logo/logo-tigre1.png',
			'alt' => 'Logo',
			'style' => 'width: 150px;',
		);
		echo img($prop_img);
		?>
	</a>
	<!-- Fin logo -->
	<!--<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToogle" href="">
		<i class="fa fa-bars"></i>
	</button>-->

	<!-- Navbar -->
	<ul class="navbar-nav ml-auto">
        <!-- Menu Agregar -->
        <li class="nav-item dropdown mx-1 ">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-building"></i>
                <?php
                    $empresa = $this->session->sucursal;
                    echo $empresa->nombre_empresa;
                ?>
            </a>
            <!--<div class="dropdown-menu">
                <a class="dropdown-item">CAMBIAR</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-exchange-alt"></i>
                    <i class="far fa-building"></i>
                    Empresa 2
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-exchange-alt"></i>
                    <i class="far fa-building"></i>
                    Empresa 3
                </a>

            </div>-->
        </li><!-- Fin Menu Agregar -->
		<!-- Menu Agregar -->
		<!--<li class="nav-item dropdown mx-1 ">
			<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-plus fa-fw"></i>
			</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="#"><i class="fa fa-money-bill"></i> Nueva Venta</a>
				<a class="dropdown-item" href="<?php /*echo site_url('productos/add_producto'); */?>">
                    <i class="fa fa-tag"></i> Nuevo Producto
                </a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#">
                    <i class="fa fa-tags"></i> Nueva Familia
                </a>
				<a class="dropdown-item" href="#"><i class="fa fa-user"></i> Nuevo Cliente</a>
				<a class="dropdown-item" href="#"><i class="fa fa-industry"></i> Nuevo Proveedor</a>
			</div>
		</li>-->
        <!-- Fin Menu Agregar -->
		<!-- Menu Productos -->
		<!--<li class="nav-item dropdown mx-1 ">
			<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-box fa-fw"></i>
			</a>
			<div class="dropdown-menu">
				<a class="dropdown-item" href="#"><i class="fa fa-boxes"></i> Todos los Productos</a>
				<a class="dropdown-item" href="#"><i class="fa fa-tags"></i> Familias de Productos</a>
			</div>
		</li>-->
        <!-- Fin Menu Productos -->
		<!-- Menu Notificaciones -->
		<!--<li class="nav-item dropdown ml-3 ">
			<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="badge badge-warning">+9</span>
				<i class="fa fa-bell fa-fw"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
				<a class="dropdown-item" href="#"><i class="fa fa-info-circle"></i> Productos Bloqueados</a>
				<a class="dropdown-item" href="#"><i class="fa fa-info-circle"></i> Notificacion</a>
				<a class="dropdown-item" href="#"><i class="fa fa-info-circle"></i> Notificacion</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#">Ver mas notificaciones</a>
			</div>
		</li>-->
        <!-- Fin Menu Notificaciones -->
		<!-- Menu Usuarios -->
		<li class="nav-item dropdown no-arrow ml-3">
			<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-user-circle fa-fw"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
				<div class="dropdown-header">
                    <?php echo $usuario_activo->first_name." ".$usuario_activo->last_name?>
                </div>
				<a class="dropdown-item" href="#">
                    <i class="fa fa-user"></i>
                    <?php echo $usuario_activo->username; ?>
                </a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="<?php echo site_url('ajustes') ?>">
                    <i class="fa fa-cog"></i> Ajustes Generales
                </a>
				<!--<a class="dropdown-item" href="history.html">
                    <i class="fa fa-chart-line"></i>
                    Historial de Registro
                </a>-->
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="<?php echo site_url('login/logout'); ?>" >
                    <i class="fa fa-power-off"></i>
                    Salir
                </a>
			</div>
		</li><!-- Fin Menu Usuarios -->
	</ul>
</nav>
