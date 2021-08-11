<div id="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">
							<i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
							Proveedor de Compra 
							<div class="col-12 d-flex" >
								<div class="ml-auto">
									<a href="<?php echo site_url('Clientes'); ?>" class="btn btn-secondary " role="button">
										<i class="far fa-plus-square"></i>
										Agregar Proveedor
									</a>
								</div>
							</div>
						</h3>
					</div>
					<div class="container-fluid">
						<hr style="height:3px;border:none;color:#333;background-color:#333;" >
					</div>
					<div class="col-12 d-flex">
						<div class="ml-auto">		
							<a href="<?php echo site_url('compras/cancelarCompra'); ?>" class="btn btn-secondary " role="button">
								<i class="fas fa-ban" aria-hidden="true"></i>
								Cancelar												
							</a>
						</div>
					</div>
					<div class="box-body">
						<table  id="" class="table table-striped table-bordered despliegue">
							<thead class="bg bg-blue">
								<tr>
									<th>Nro</th>
									<th>NIT</th>
									<th>Razon Social</th>
									<th>Accion</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($lista_proveedores as $p):?>
								<tr>
									<?php for ($i=0;$i<=2;$i++) { ?>
									<td><?php 
										if ($i==0)
										{
											$idp=$p->idclipro;
											echo $idp;
										}
										if ($i==1)
										{
											echo $p->nit;
										}
										if ($i==2)
										{
											echo $p->razon_social;
										}
									?></td>
									<?php } ?>         
									<td align="center">
										<a data-toggle="modal" href="<?php echo '#proveedor-'.$idp;?>">
											<i class="fas fa-address-book"> Elegir Proveedor</i>
										</a>
									</td>
								</tr>  
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
				<?php foreach ($lista_proveedores as $p) { ?>
				<?php echo form_open('compras/comprarProducto'); ?>
					<div class="modal fade" id="<?php echo 'proveedor-'.$p->idclipro;?>">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">
										Datos de la Compra:
									</h4>
									<button type="button" class="close" data-dismiss="modal">×</button>
								</div>
								<div class="modal-body">
									<label>Almacen: <?php echo $almacen->nombre_almacen; ?></label><br>
									<input type="hidden" id="idproveedor" name="idproveedor" value="<?php echo $p->idclipro; ?>" class="form-control input-lg" placeholder="" required="llenar"  />
									<label>NIT: <?php echo $p->nit; ?></label><br>
									<label>Razon_Social: <?php echo $p->razon_social; ?></label><br>
									<label>Fecha: </label>
									
									<!--<div class="col-2 form-group row">-->
									<div>
										<input type="date" id="fecha" name="fecha" value="<?php echo $fecha;?>" required="">
									</div>
									
									<label>Codigo Pedido de Compra:</label>
									<input type="text" id="codigo_pedido" name="codigo_pedido" value="" class="form-control input-lg" placeholder="" required="llenar"  />
									
									<label>Numero Factura de Compra:</label>
									<input type="text" id="numero_factura" name="numero_factura" value="" class="form-control input-lg" placeholder="" required="llenar"  />								
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary"><i class="fas fa-check"></i></button>
									<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-door-closed"></i></button>
									<?php echo form_close();?>
								</div>

							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>


