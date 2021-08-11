<div id="content-wrapper">
	<div class="container">

		<div class="row">
			<div class="col-12 text-center">
				<h3>CREACION DE USUARIO</h3>
			</div>

            <?php  if(validation_errors()): ?>
            <div class="col-12 ">
                <div class="alert alert-warning">
                    <?php echo validation_errors(); ?>
                </div>
            </div>
            <?php  endif; ?>

			<div class="col-12">
				<?php echo form_open('wizards/usuarioProcesar/'.$idempresa); ?>
				<div id="smartwizard">
					<ul class="nav">
						<li>
							<a class="nav-link" href="#paso1">
								<strong>Informacion Personal</strong> <br> <small>Ingresar</small>
							</a>
						</li>
						<li>
							<a class="nav-link" href="#paso2">
								<strong>Contraseña</strong> <br> <small>Definir</small>
							</a>
						</li>
						<li>
							<a class="nav-link" href="#paso3">
								<strong>Informacion de Contacto</strong> <br> <small>Ingresar</small>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div id="paso1" class="tab-pane" role="tabpanel">
							<div class="form-step-0" role="form" data-toggle="validator">
                                <div class="form-group">
                                    <input type="hidden" id="idempresa"
                                           name="idempresa" value="<?php echo $idempresa ?>"  >
                                </div>
								<div class="form-group">
									<label for="nombre">Usuario:</label>
									<input type="text" class="form-control" id="usuario" name="usuario"
										   required placeholder="Usuario">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="form-step-1" role="form" data-toggle="validator">
								<div class="form-group">
									<label for="nombre">Nombre:</label>
									<input type="text" class="form-control" id="nombre" name="nombre"
										   required placeholder="Escriba su nombre">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="form-step-2" role="form" data-toggle="validator">
								<div class="form-group">
									<label for="nombre">Apellido:</label>
									<input type="text" class="form-control" id="apellido" name="apellido"
										   required placeholder="Escriba su Apellido">
									<div class="help-block with-errors"></div>
								</div>
							</div>
						</div>

						<div id="paso2" class="tab-pane" role="tabpanel">
							<div class="form-step-0" role="form" data-toggle="validator">
								<div class="form-group">
									<label for="passwd">Contraseña:</label>
									<input type="password" class="form-control" id="passwd" name="passwd"
										   required>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="form-step-1" role="form" data-toggle="validator">
								<div class="form-group">
									<label for="passwdc">Confirmar Contraseña:</label>
									<input type="password" class="form-control" id="passwdc" name="passwdc"
										   required >
									<div class="help-block with-errors"></div>
								</div>
							</div>
						</div>


						<div id="paso3" class="tab-pane" role="tabpanel">
							<div class="form-step-0" role="form" data-toggle="validator">
								<div class="form-group">
									<label for="telefono">Telefono:</label>
									<input type="text" class="form-control" id="telefono" name="telefono"
										   required>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="form-step-1" role="form" data-toggle="validator">
								<div class="form-group">
									<label for="email">EMail:</label>
									<input type="email" class="form-control" id="email" name="email"
										   required >
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="form-step-2" role="form">
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
