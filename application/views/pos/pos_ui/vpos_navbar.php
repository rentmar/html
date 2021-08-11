<?php $empresa = $this->session->sucursal; ?>
<?php $usuario_actual = $this->ion_auth->user()->row(); ?>
<!-- Barra de navegacion del POS -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
	<!--Logo -->
	<a class="navbar-brand" href="#">
		<i class="fas fa-laptop-code"></i>
        <?php echo $empresa->nombre_empresa;?>
	</a> <!-- Fin Logo -->
    <ul class="navbar-nav">
        <li class="nav-item text-white">
            <small>
            <?php
                echo $usuario_actual->first_name." ".$usuario_actual->last_name;
            ?>
            </small>
        </li>
    </ul>
	<ul class="navbar-nav ml-auto">

		<li class="nav-item">
			<form action="<?php echo site_url('PuntoVenta/buscarProducto');?>" class="form-inline mt-2 mt-md-0" method="post" accept-charset="utf-8">
				<!-- Patron de busqueda de producto -->
				<input class="form-control mr-sm-2" name="producto" type="text" placeholder="Buscar" aria-label="Buscar">
				<!-- Boton de busqueda -->
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">
					<span>
						<i class="fas fa-search"></i>
					</span>
				</button>
			</form>
		</li>
		<li class="nav-item">
			<a href="<?php echo site_url('pos/'); ?>" role="button" class="btn btn-outline-success my-2 my-sm-0">
				<span>
					<i class="fas fa-times"></i>
				</span>
			</a>
		</li>
	</ul>
</nav><!-- Fin Barra de navegacion del POS -->

    
