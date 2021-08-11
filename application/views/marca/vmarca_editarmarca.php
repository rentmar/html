<div id="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="box">

					<div class="box-header">
						<h3 class="box-title">
							<i class="fa fa-edit" aria-hidden="true"></i>
							Editar Marca
						</h3>
					</div>
					<?php echo form_open_multipart('marcas/modificarMarca');?>
					<!-- Marca y categoria -->
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
							Fabricante
						</h4>

						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<input type="hidden" id = "editar_idmarca" name="editar_idmarca" value="<?php echo $dt_edit[0]->idmarca; ?>" class="form-control input-lg"  />
									<label>Marca:</label>
									<input type="text" id = "editar_marca" name="editar_marca" value="<?php echo $dt_edit[0]->fabricante; ?>" class="form-control input-lg" placeholder="" required=""  />
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
										Modificar
									</button>
								</div>
							</div>
					</div>
					
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


