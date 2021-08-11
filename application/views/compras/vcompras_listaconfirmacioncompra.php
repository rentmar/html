<div id="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">
							<i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
							Confirmacion de Compras/<?php echo $almacen->nombre_almacen;?> 
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
									<th>Producto</th>
									<th>Codigo</th>
									<th>Fecha Compra</th>
									<th>Total[Bs]</th>
									<th>Cantidad Comprada</th>
									<th>Cantidad Recibida</th>
									<th>Saldo</th>
									<th>Nota recepcion</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($listaconfirmar as $l):?>
								<tr>
									<td><?php echo $idreg=$l->idregcompra;?></td>
									<td><?php echo $l->fabricante.' '.$l->nombre.' '.$l->item.' '.$l->dimension;?></td>
									<td><?php echo $l->codigo;?></td>
									<td><?php echo $l->fecha;?></td>
									<td><?php echo $l->total_producto;?></td>
									<td><?php echo $l->cantidad_producto;?></td>
									<td>
										<?php echo $l->cantidad_recibida;?>
										<a data-toggle="modal" href="<?php echo '#cantprod-'.$idreg;?>">
											<i class="fas fa-edit"> Cantidad</i>
										</a>
									</td>
									<td><?php echo $l->cantidad_producto-$l->cantidad_recibida;?></td>
									<td><?php echo $l->nota_recepcion;?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
				<?php foreach ($listaconfirmar as $l){?>
				<?php echo form_open('compras/cantidadRecibida/'.$l->idregcompra); ?>
					<div class="modal fade" id="<?php echo 'cantprod-'.$l->idregcompra;?>">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">
										Cantidad Comprada del Producto: <?php echo $l->cantidad_producto;?>
									</h4>
									<button type="button" class="close" data-dismiss="modal">×</button>
								</div>
								<div class="modal-body">
									<label>Cantidad Recibida:</label><br>
									<input type="number" id="cantrecibida" name="cantrecibida" value="0" class="form-control input-lg" placeholder="" required="llenar"  />
									<label>NOTA:La cantidad recibida no puedes ser mayor a la cantidad comprada </label><br>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i></button>
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


