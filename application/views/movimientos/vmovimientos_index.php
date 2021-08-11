<div id="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">
							<i class="fa fa-people-carry" aria-hidden="true"></i>
							Movimiento de Mercaderia			
						</h3>
					</div>
					<div class="box-body">
						 <div>
							<div class="card" style="min-width: 20rem; max-width: 20rem;">
								<div class="card-header">Solicitud de Movimiento</div>
									<div class="card-body text-center">
										<p>
											<span>
												<i class="fas fa-cart-arrow-down fa-5x"></i>
											</span>
										</p>
										<?php if($movs!=0): ?>
										<p class="bg-danger text-white ">
											<span style="font-size: 1.25rem;">
												Existe Solicitud de Movimiento pendiente
											</span>
										</p>         
										<div class="footer">               
											<a href="<?php echo site_url('Movimientos/confirmacionMovimiento');?>" class="btn btn-outline-info">Confirmacion Movimiento</a>
										</div>      
										<?php endif; ?>     										
									</div>
									<div class="footer">               
										<a href="<?php echo site_url('Movimientos/movimientoProducto');?>" class="btn btn-outline-info">Solicitar Movimiento</a>
									</div>
							</div><!-- Fin Tarjeta compra-->
						</div>						
					</div><!-- fin body -->
				</div>
			</div>
		</div>
	</div>
</div>

