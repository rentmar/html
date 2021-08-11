<div id="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="box">

					<div class="box-header">
						<h3 class="box-title">
							<i class="fa fa-plus" aria-hidden="true"></i>
							Editar Linea
					</div>

					<?php echo form_open_multipart('lineas/modificarLinea');?>
					<!-- Despliga Linea -->
					<div class="box-body">
						<div class="row">
							<div class="col-12 d-flex" >
								<div class="ml-auto">
									<a href="<?php echo site_url('MarcasLineasUnidades'); ?>" class="btn btn-secondary " role="button">
										<i class="fas fa-ban"></i>
										Cancelar
									</a>				
								</div>
							</div>
						</div>
						<!-- Linea Divisora -->
						<div class="container-fluid">
							<hr style="height:3px;border:none;color:#333;background-color:#333;" >
						</div>
						<h4 class="purchase-heading">
							<i class="fa fa-check-circle"></i>
							Linea
						</h4>

						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<input type="hidden" id="edit_idlinea" name="edit_idlinea" value="<?php echo $dt_edit[0]->idlinea; ?>" class="form-control input-lg" placeholder="" required="Poner linea"  />
									<label>Linea:</label>
									<input type="text" id="edit_nombre_linea" name="edit_nombre_linea" value="<?php echo $dt_edit[0]->nombre; ?>" class="form-control input-lg" placeholder="" required="Poner linea"  />
									<small>Nombre de Linea </small>
								</div>
							</div>
						</div>
					</div><!-- Fin Linea -->
					
					<!-- boton  -->
					<div class="box-body">
						
						<div class="row">
							<div class="col-12 d-flex justify-content-end ">
								<div class="form-group">
									<button type="submit" class="btn btn-primary">
										<i class="far fa-save"></i>
										Modificar
									</button>
								</div>
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


