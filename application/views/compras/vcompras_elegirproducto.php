<div id="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">
							<i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
							Punto de Compra Almacen:<?php echo $almacen->nombre_almacen; ?>											
						</h3>
					</div>
					<?php $prov=$this->session->proveedor; ?>
					<?php $dts_compra=$this->session->datos_compra; ?>
					<div class="box-body">
						<h3 class="box-title">
							<i class="fa fa-landmark" aria-hidden="true"></i>
							Proveedor y Datos de Compra:													
						</h3>
						<div>
							<table  id="" class="table table-striped table-bordered">
								<thead class="bg bg-blue">
									<tr>
										<th>NIT</th>
										<th>Razon_Social</th>
										<th>Fecha</th>
										<th>Codigo Pedido</th>
										<th>Numero Factura</th>
									</tr>
								</thead>
								<tbody style="font-size:1vw">
									<tr>
										<td><?php echo $prov->nit; ?></td>
										<td><?php echo $prov->razon_social; ?></td>
										<td><?php echo $dts_compra['fecha'];?></td>
										<td><?php echo $dts_compra['codigo_pedido'];?></td>
										<td><?php echo $dts_compra['numero_factura'];?></td>
									</tr>  
								</tbody>
							</table>
						</div>
						<div class="container-fluid">
							<hr style="height:3px;border:none;color:#333;background-color:#333;" >
						</div>
						<div class="col-12 d-flex">
							<div class="ml-auto">
								<a href="<?php echo site_url('Compras/registrarCompra'); ?>" class="btn btn-secondary " role="button">
									<i class="fa fa-upload" aria-hidden="true"></i>
									Realizar Compra												
								</a>	
								<a href="<?php echo site_url('compras/cancelarCompra'); ?>" class="btn btn-secondary " role="button">
									<i class="fas fa-ban" aria-hidden="true"></i>
									Cancelar												
								</a>
							</div>
						</div>
						<div>
							<table  id="tabla_carrito" class="table table-striped table-bordered">
								<thead class="bg bg-blue">
									<tr>
										<th>Nro</th>
										<th>Producto</th>
										<th>Codigo</th>
										<th>Cantidad</th>
										<th>Precio[Bs]</th>
										<th>Accion</th>
									</tr>
								</thead>
								<tbody style="font-size:1vw">
									<?php $carrito=$this->session->carrito_compra; ?>
									<?php foreach ($carrito as $prod):?>
									<tr>
										<td><?php $idp=$prod['idp']; echo $idp; ?></td>
										<td><?php echo $prod['producto'];?></td>
										<td><?php echo $prod['codigo'];?></td>
										<td>
											<?php echo $prod['cantidad'];?>
											<a data-toggle="modal" href="<?php echo '#cantprod-'.$prod['idp'];?>">
												<i class="fas fa-edit"></i>
											</a>
										</td>
										<td>
											<?php echo $prod['precio'];?>
											<a data-toggle="modal" href="<?php echo '#precioprod-'.$prod['idp'];?>">
												<i class="fas fa-edit"></i>
											</a>
										</td>
										<td align="center">
											<a href="<?php echo site_url('compras/quitarProducto/'.$idp);?>">
												<i class="fas fa-eraser"> quitar</i>
											</a>
										</td>
									</tr>
									<?php endforeach;?>
								</tbody>
							</table>
						</div>
						<!-- Linea Divisora -->
						<div class="container-fluid">
							<hr style="height:3px;border:none;color:#333;background-color:#333;" >
						</div>
						<h3 class="box-title">
							<i class="fas fa-cart-plus" aria-hidden="true"></i>
							Elegir Producto							
						</h3>
						<br>
						<div>
							<table  id="" class="table table-striped table-bordered despliegue">
								<thead class="bg bg-blue">
									<tr>
										<th>Nro</th>
										<th>Marca</th>
										<th>Linea</th>
										<th>Item</th>
										<th>Dimension</th>
										<th>Codigo</th>
										<th>Unidad</th>
										<!--<th>Precio</th>
										<th>Incremento</th>
										<th>Descuento</th>-->
										<th>Accion</th>
									</tr>
								</thead>
								<tbody style="font-size:1vw">
									<?php foreach ($lista_productos as $p):?>
									<tr>
										<td><?php $idprod=$p->idproducto; echo $idprod;?></td>
										<td><?php echo $p->fabricante;?></td>		
										<td><?php echo $p->linea;?></td>
										<td><?php echo $p->item;?></td>
										<td><?php echo $p->dimension;?></td>
										<td><?php echo $p->codigo;?></td>
										<td><?php echo $p->unidad;?></td>       
										<td align="center">
											<a href="<?php echo site_url('compras/carritoCompra/'.$idprod);?>">
												<i class="fas fa-cart-arrow-down"> comprar</i>
											</a>
										</td>
									</tr>  
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<?php foreach ($carrito as $p) { ?>
				<?php echo form_open('compras/cantidadProducto/'.$p['idp']); ?>
					<div class="modal fade" id="<?php echo 'cantprod-'.$p['idp'];?>">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">
										Cantidad de la Compra:
									</h4>
									<button type="button" class="close" data-dismiss="modal">×</button>
								</div>
								<div class="modal-body">
									<label>Cantidad:</label><br>
									<input type="number" id="cantidad" name="cantidad" value="<?php echo $p['cantidad']; ?>" class="form-control input-lg" placeholder="" required="llenar"  />
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
				<?php foreach ($carrito as $p) { ?>
				<?php echo form_open('compras/precioProducto/'.$p['idp']); ?>
					<div class="modal fade" id="<?php echo 'precioprod-'.$p['idp'];?>">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">
										Precio de la Compra:
									</h4>
									<button type="button" class="close" data-dismiss="modal">×</button>
								</div>
								<div class="modal-body">
									<label>Precio:</label><br>
									<input type="number" id="precio" name="precio" value="<?php echo $p['precio']; ?>" class="form-control input-lg" placeholder="" required="llenar"  />
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

