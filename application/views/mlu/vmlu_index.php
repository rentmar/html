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
						<a>Marcas,Lineas y Unidades</a>
					</li>
				</ol>
			</div>
			<!-- End Breadcrumb -->
		</div>
	</div>
	<!-- Marca Despliegue -->
	<div class="container-fluid">
		MARCAS
	</div>
	
	<div class="container-fluid" >
		<div class="row">
			<div class="col-12 d-flex" >
				<div class="ml-auto">
					<a href="<?php echo site_url('Marcas/crearMarca'); ?>" class="btn btn-secondary " role="button">
						<i class="far fa-plus-square"></i>
						Agregar Marca
					</a>
					<a href="<?php echo site_url('Marcas/listaMarcas'); ?>" class="btn btn-secondary " role="button">
						<i class="fas fa-search"></i>
						Buscar/Editar Marca
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- Linea Divisora -->
	<div class="container-fluid">
		<hr style="height:3px;border:none;color:#333;background-color:#333;" >
	</div>
	<!-- Linea Despliegue -->
	<div class="container-fluid">
		LINEAS
	</div>
	
	<div class="container-fluid" >
		<div class="row">
			<div class="col-12 d-flex" >
				<div class="ml-auto">
					<a href="<?php echo site_url('Lineas/crearLinea'); ?>" class="btn btn-secondary " role="button">
						<i class="far fa-plus-square"></i>
						Crear Linea
					</a>
					<a href="<?php echo site_url('lineas/listaEditarLinea'); ?>" class="btn btn-secondary " role="button">
						<i class="fas fa-search"></i>
						Buscar/Editar Linea
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- Linea Divisora -->
	<div class="container-fluid">
		<hr style="height:3px;border:none;color:#333;background-color:#333;" >
	</div>
	<!-- Unidad Despliegue -->
	<div class="container-fluid">
		UNIDADES
	</div>
	
	<div class="container-fluid" >
		<div class="row">
			<div class="col-12 d-flex" >
				<div class="ml-auto">
					<a href="<?php echo site_url('Unidades/crearUnidad'); ?>" class="btn btn-secondary " role="button">
						<i class="far fa-plus-square"></i>
						Agregar Unidad
					</a>
					<a href="<?php echo site_url('unidades/listaEditarUnidad'); ?>" class="btn btn-secondary " role="button">
						<i class="fas fa-search"></i>
						Buscar/Editar Unidad
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- Linea Divisora -->
	<div class="container-fluid">
		<hr style="height:3px;border:none;color:#333;background-color:#333;" >
	</div>
	
	<!-- Modal buscar para editar marca -->
	<div class="modal fade" id="modaleditmarca">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Buscar marca para editar</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<?php
						echo form_open('marcas/listaEditarMarca');
                    ?>
					<div>
						<label>Marca:</label>
						<input type="text" id="busca_marca_editar" name="busca_marca_editar" value="" class="form-control input-lg" placeholder="" required=""  />
						<small>Marca para editar</small>
					</div>
					<div>
						<button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i>Buscar Marca</button>
						<?php echo form_close(); //Cierre del formulario ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal buscar para editar linea -->
	<div class="modal fade" id="modaleditlinea">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Buscar linea para editar</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<?php
						echo form_open('lineas/listaEditarLinea');
                    ?>
					<div>
						<label>Linea:</label>
						<input type="text" id="busca_linea_editar" name="busca_linea_editar" value="" class="form-control input-lg" placeholder="" required=""  />
						<small>Linea para editar</small>
					</div>
					<div>
						<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>Buscar Linea</button>
						<?php echo form_close(); //Cierre del formulario ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal buscar para editar unidad -->
	<div class="modal fade" id="modaleditunidad">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Buscar unidad para editar</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<?php
						echo form_open('unidades/listaEditarUnidad');
                    ?>
					<div>
						<label>Unidad:</label>
						<input type="text" id="busca_unidad_editar" name="busca_unidad_editar" value="" class="form-control input-lg" placeholder="" required=""  />
						<small>unidad para editar</small>
					</div>
					<div>
						<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>Buscar Unidad</button>
						<?php echo form_close(); //Cierre del formulario ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>