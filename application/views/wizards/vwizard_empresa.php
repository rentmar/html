<div id="content-wrapper">
	<div class="container">

		<div class="row">
			<div class="col-12 text-center">
				<h3>DATOS DE LA EMPRESA</h3>
			</div>

            <?php  if(validation_errors()): ?>
                <div class="col-12 ">
                    <div class="alert alert-warning">
                        <?php echo validation_errors(); ?>
                    </div>
                </div>
            <?php  endif; ?>



			<div class="col-12">
				<?php echo form_open('wizards/empresaProcesar'); ?>
				<div id="smartwizard">
					<ul class="nav">
						<li>
							<a class="nav-link" href="#paso1">
								<strong>Datos Generales</strong> <br> <small>Ingresar</small>
							</a>
						</li>
						<li>
							<a class="nav-link" href="#paso2">
								<strong>Informacion de Contacto</strong> <br> <small>Ingresar</small>
							</a>
						</li>

					</ul>
					<div class="tab-content">
						<div id="paso1" class="tab-pane" role="tabpanel">
							<div class="form-step-0" role="form" data-toggle="validator">
								<div class="form-group">
									<label for="nombre">NIT:</label>
									<input type="text" class="form-control" id="nit" name="nit"
										   required placeholder="NIT">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="form-step-1" role="form" data-toggle="validator">
								<div class="form-group">
									<label for="nombre">Nombre de la Empresa:</label>
									<input type="text" class="form-control" id="nombreempresa" name="nombreempresa"
										   required placeholder="Escriba el nombre de la empresa">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="form-step-2" role="form" data-toggle="validator">
								<div class="form-group">
									<label for="nombre">Razon Social:</label>
									<input type="text" class="form-control" id="rsocial" name="rsocial"
										   required placeholder="Razon Social de la Empresa">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="form-step-2" role="form" data-toggle="validator">
								<div class="form-group">
									<label for="nombre">Actividad:</label>
									<input type="text" class="form-control" id="actividad" name="actividad"
										   required placeholder="Actividad de la Empresa">
									<div class="help-block with-errors"></div>
								</div>
							</div>
						</div>

						<div id="paso2" class="tab-pane" role="tabpanel">
							<div class="form-step-0" role="form" data-toggle="validator">
								<div class="form-group">
									<label for="direccion">Direccion:</label>
									<input type="text" class="form-control" id="direccion" name="direccion"
										   required>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="form-step-1" role="form" data-toggle="validator">
								<div class="form-group">
									<label for="telefono">Telefono:</label>
									<input type="text" class="form-control" id="telefono" name="telefono"
										   required >
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="form-step-2" role="form" data-toggle="validator">
								<div class="form-group">
									<label for="telefono">Telefono Movil:</label>
									<input type="text" class="form-control" id="telefonomov" name="telefonomov"
										   required >
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="form-step-3" role="form">
								<div class="form-group">
									<button type="submit" class="btn btn-success">
										Enviar
									</button>
								</div>
							</div>
						</div>




					</div>


				</div>
				<?php echo form_close(); ?>

			</div>
		</div>


	</div>

</div>
