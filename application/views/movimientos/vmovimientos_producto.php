<div id="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">
							<i class="fa fa-people-carry" aria-hidden="true"></i>
							Elegir Producto para Movimiento
						</h3>
					</div>
					<div class="box-body">
						<div class="container-fluid" >
							<div class="row">
								<div class="col-12 d-flex" >
									<div class="ml-auto">
										<a href="<?php echo site_url('Movimientos'); ?>" class="btn btn-secondary " role="button">
										<i class="fas fa-ban"></i>
										Cancelar
										</a>				
									</div>
								</div>
							</div>
						</div>
						<div class="container-fluid">
							<hr style="height:3px;border:none;color:#333;background-color:#333;" >
						</div>
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
											<a href="<?php echo site_url('Movimientos/solicitarMovimiento/'.$idprod);?>">
												<i class="fas fa-sign-out-alt"> mover producto</i>
											</a>
										</td>
									</tr>  
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
