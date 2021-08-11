<div id="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">
							<i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
							Compra							
						</h3>
					</div>
					<div class="box-body">
						<div>
							<div class="card" style="min-width: 20rem; max-width: 20rem;">
								<div class="card-header">Punto de Compra</div>
								<div class="card-body text-center">
									<p>
										<span>
											<i class="fas fa-cart-arrow-down fa-5x"></i>
										</span>
									</p>
									<?php if($this->session->carrito_compra!=[]): ?>
									<p class="bg-danger text-white ">
										<span style="font-size: 1.25rem;">
											Existe una compra pendiente
										</span>
									</p>         
									<p class="alert-danger">
										Compra sin cerrar
									</p>       
									<?php endif; ?>  
									<?php if($noconfirmada!=0):?>
									<p class="bg-danger text-white ">
										<span style="font-size: 1.25rem;">
											Existe compras para confirmar
										</span>
									</p> 
									<?php endif;?>
								</div>
								<div class="footer"> 
									<?php if($this->session->carrito_compra!=[]){ ?>
										<a href="<?php echo site_url('compras/comprarProducto');?>" class="btn btn-outline-info">Continuar</a>
									<?php } else {  ?>
										<a href="<?php echo site_url('compras/proveedorCompra');?>" class="btn btn-outline-info">Iniciar</a>
									<?php } ?>
									<?php if($noconfirmada!=0){ ?>
										<a href="<?php echo site_url('compras/confirmacionCompra');?>" class="btn btn-outline-info">Confirmar</a>
									<?php } ?>
								</div>
							</div><!-- Fin Tarjeta compra-->
						</div>
					</div><!-- fin body -->
				</div>
			</div>
		</div>
	</div>
</div>

