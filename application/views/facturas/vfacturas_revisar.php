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
						<a>Revisar Facturas</a>
					</li>
				</ol>
			</div>
			<!-- End Breadcrumb -->
		</div>
	</div>
	<!-- Marca Despliegue -->
	<div class="container-fluid">
		<h3>Facturas Emitidas</h3>
	</div>
	
	<div class="container-fluid" >
		<div class="row">
			<div class="col-12 d-flex" >
				<div class="ml-auto">
					<a href="<?php echo site_url('Facturas/facturasEmitidas'); ?>" class="btn btn-secondary " role="button">
						<i class="fa fa-eye"></i>
						Ver Facturas Emitidas Mes
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
		<h3>Facturas Blanco</h3>
	</div>
	
	<div class="container-fluid" >
		<div class="row">
			<div class="col-12 d-flex" >
				<div class="ml-auto">
					<a href="<?php echo site_url('Facturas/listaFacturasBlanco'); ?>" class="btn btn-secondary " role="button">
						<i class="fa fa-eye"></i>
						Ver Facturas Blanco
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
		<h3>Faturas Cliente</h3>
	</div>
	
	<div class="container-fluid" >
		<div class="row">
			<div class="col-12 d-flex" >
				<div class="ml-auto">
					<a data-toggle="modal" href="<?php echo '#modalfacturacliente';?>" class="btn btn-secondary " role="button">
						<i class="fas fa-search"></i>
						Buscar Facturas Cliente
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- Linea Divisora -->
	<div class="container-fluid">
		<hr style="height:3px;border:none;color:#333;background-color:#333;" >
	</div>
	
	<!-- Modal buscar factura cliente -->
	<div class="modal fade" id="modalfacturacliente">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Buscar Facturas del Cliente</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<?php
						echo form_open('Facturas/listaFacturasCliente');
                    ?>
					<div>
						<label>NIT:</label>
						<input type="text" id="nit" name="nit" value="" class="form-control input-lg" placeholder="" required=""  />
						<small>NIT del cliente</small>
					</div>
					<div>
						<button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i>Buscar Facturas</button>
						<?php echo form_close(); //Cierre del formulario ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>