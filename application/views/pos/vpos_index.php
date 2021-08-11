<div id="content-wrapper">
	<div class="container">
		<div class="card-deck">
			<!--<a href="<?php //echo site_url('Facturacion');?>" class="btn btn-outline-info">Facturacion</a>-->
			<!-- Tarjeta del punto de Venta -->
			<div class="card" style="min-width: 20rem; max-width: 20rem;">
				<div class="card-header">Punto de Venta</div>
				<div class="card-body text-center">

					<p><!-- Icono de la tarjeta -->
						<span>
							<i class="fas fa-laptop-code fa-5x"></i>
						</span>
					</p><!-- Fin Icono de la tarjeta -->

					<!-- Indicador de venta pendiente -->
                    <?php if($this->session->carrito!=[] || $this->session->cliente!=[] ): ?>
                    <p class="bg-danger text-white ">
                            <span style="font-size: 1.25rem;">
                                Existe una venta pendiente
                            </span>
                    </p>
                    <?php endif; ?>
                    <?php if($datos_empresa->fecha_limite_emision != 0): ?>
                        <!-- Despliegue para fecha de emision valida -->
                        <p class="alert-info">
                            <?php if(isset($datos_empresa)): ?>
                                <?php echo 'Fecha limite de emision: '. mdate('%Y/%m/%d', $datos_empresa->fecha_limite_emision); ?>
                            <?php endif; ?>
                        </p>
                        <p class="alert-info">
                            <?php if(isset($datos_empresa)): ?>
                                <?php
                                $rango = $datos_empresa->fecha_limite_emision - now();
                                $dias_diferencia = floor(abs($rango / (60 * 60 * 24)));
                                ?>
                                <?php
                                if($dias_diferencia>0)
                                {
                                    echo 'Restan <span class="badge badge-warning">'.$dias_diferencia.' dias </span> para nueva dosificacion';
                                }
                                ?>
                            <?php endif; ?>
                        </p>
                        <!-- Fin Despliegue para fecha de emision valida -->
                    <?php else: ?>
                        <p class="alert-danger">
                            Actualice los datos de dosificacion
                        </p>
                    <?php endif; ?>
				</div>
				<div class="footer">
                    <?php if(isset($datos_empresa) && $datos_empresa->fecha_limite_emision!=0): ?>
                        <?php if($datos_empresa->fecha_limite_emision >= now() ): ?>
                            <a href="<?php echo site_url('puntoVenta');?>" class="btn btn-outline-info">Iniciar</a>
                        <?php endif; ?>
                    <?php endif; ?>
				</div>

			</div><!-- Fin Tarjeta del punto de Venta -->

		</div>
	</div>
</div>
