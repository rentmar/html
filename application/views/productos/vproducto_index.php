<div id="content-wrapper">

	<div class="container-fluid">
		<div class="row">
			<!-- Breadcrumb -->
			<div class="col-12">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?php echo site_url('/');?>">
                            <i class="fas fa-home"></i>
                        </a>
					</li>
					<li class="breadcrumb-item active">
						<a>Productos</a>
					</li>
				</ol>
			</div>
			<!-- End Breadcrumb -->
		</div>
	</div>
	<!-- Productos Despliegue -->
	<div class="container-fluid">
		<h1>
			PRODUCTOS
		</h1>
	</div>
	<div class="container-fluid" >
		<div class="row">
			<div class="col-12 d-flex" >
				<div class="ml-auto">
					<a href="<?php echo site_url('productos/elegirImagen'); ?>" class="btn btn-secondary " role="button">
						<i class="fas fa-file-image"></i>
						Subir Imagen
					</a>
					<a href="<?php echo base_url().'index.php/productos/crearProducto'; ?>" class="btn btn-secondary " role="button">
						<i class="far fa-plus-square"></i>
						Crear Producto
					</a>
					<a href="<?php echo site_url('productos/listaEditarProducto'); ?>" class="btn btn-secondary " role="button">
						<i class="fas fa-search"></i>
						Buscar/Editar Producto
					</a>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Linea Divisora -->
	<div class="container-fluid">
		<hr style="height:3px;border:none;color:#333;background-color:#333;" >
	</div>
	<!-- Modal busqueda para la editar producto -->
	<div class="modal fade" id="modaleditproducto">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Buscar producto para editar</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<?php
						echo form_open('productos/listaEditarProducto');
                    ?>
					<div>
						<label>Producto:</label>
						<input type="text" id="busca_producto_editar" name="busca_producto_editar" value="" class="form-control input-lg" placeholder="" required=""  />
						<small>Producto para editar</small>
					</div>
					<div>
						<button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i>Buscar Producto</button>
						<?php echo form_close(); //Cierre del formulario ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
