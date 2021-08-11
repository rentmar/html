<div id="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">
							<i class="fa fa-people-carry" aria-hidden="true"></i>
							Movimientos Solicitados
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
						<div>
							<table  id="lista_confirmacion" class="table table-striped table-bordered ">
								<thead class="bg bg-blue">
									<tr>
										<th>Usuario</th>
										<th>Producto</th>
										<th>Fecha</th>
										<th>Cantidad Requerida</th>
										<th>Solicitud Origen</th>
										<th>Solicitud Destino</th>
										<th>Accion</th>
									</tr>
								</thead>
								<tbody style="font-size:1vw">
									<?php foreach ($lista as $m):?>
									<tr>
										<?php $idmov=$m->idmovimiento;?>
										<td><?php echo $m->username;?></td>
										<td><?php echo $m->item;?></td>		
										<td><?php echo $m->fecha_movimiento;?></td>
										<td><?php echo $m->cantidad_producto;?></td>
										<td><?php echo $m->origen;?></td>
										<td><?php echo $destino->nombre_almacen;?></td>    
										<td align="center">
											<a href="<?php echo site_url('Movimientos/confirmarMovimiento/'.$idmov);?>">
												<i class="fas fa-sign-out-alt"> confirmar</i>
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
