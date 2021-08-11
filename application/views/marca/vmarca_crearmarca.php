<div id="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="box">

					<div class="box-header">
						<h3 class="box-title">
							<i class="fa fa-plus" aria-hidden="true"></i>
							Crear Nueva Marca
						</h3>
					</div>

					<?php echo form_open_multipart('marcas/registrarMarca');?>
					<!-- Marca y categoria -->
					<div class="box-body">
						<h4 class="purchase-heading">
							<i class="fa fa-check-circle"></i>
							Fabricante
						</h4>

						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<label>Marca:</label>
									<input type="text" id = "marca" name="marca" value="" class="form-control input-lg" placeholder="" required=""  />
									<small>Marca del fabricante </small>
								</div>
							</div>
						</div>
					</div><!-- Fin Marca-->
					
					<!-- Boton guardar -->
					<div class="row">
							<div class="col-12 d-flex justify-content-end ">
								<div class="form-group">
									<button type="submit" class="btn btn-primary">
										<i class="far fa-save"></i>
										Guardar y Continuar
									</button>
									<a href="<?php echo base_url().'index.php/MarcasLineasUnidades';?>" class="btn btn-secondary " role="button">
										<i class='fas fa-sign-out-alt'></i>
										Salir
									</a>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


