<div id="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">
							<i class="fa fa-edit" aria-hidden="true"></i>
							Iniciar Cantidad de Producto
						</h3>
					</div>
					<div class="col-12 d-flex" >
						<div class="ml-auto">
							<a href="<?php echo site_url('Inventarios'); ?>" class="btn btn-secondary " role="button">
								<i class="fas fa-ban"></i>
								Cancelar
							</a>
						</div>
					</div>
					<div class="container-fluid">
						<hr style="height:3px;border:none;color:#333;background-color:#333;" >
					</div>
					<div class="box-body">
					<div>
						<h3>
							Almacen : <?php echo $almacen->nombre_almacen;?>
						</h3>
					</div>
						<table  id="" class="table table-striped table-bordered despliegue">
								<thead class="bg bg-blue">
									<tr>
										<th>Nro</th>
										<th>Marca</th>
										<th>Linea</th>
										<th>Item</th>
										<th>Dimension</th>
										<th>Unidad</th>
										<th>Existencias</th>
										<!--<th>Incremento</th>
										<th>Descuento</th>-->
										<th>Accion</th>
									</tr>
								</thead>
								<tbody style="font-size:1vw">
									<?php foreach ($productos_almacen as $p):?>
									<tr>
										<td><?php $idprod=$p->idproducto; echo $idprod;?></td>
										<td><?php echo $p->fabricante;?></td>		
										<td><?php echo $p->linea;?></td>
										<td><?php echo $p->item;?></td>
										<td><?php echo $p->dimension;?></td>
										<td><?php echo $p->unidad;?></td> 
										<td><?php echo $p->existencias;?></td>										
										<td align="center">
											<a data-toggle="modal" href="<?php echo '#cantprod-'.$idprod;?>">
												<i class="fas fa-edit"> Cantidad</i>
											</a>
										</td>
									</tr>  
									<?php endforeach; ?>
								</tbody>
						</table>
					</div>
				</div>
				<?php foreach ($productos_almacen as $p){?>
				<?php echo form_open('inventarios/cantidadInicio/'.$p->idproducto); ?>
					<div class="modal fade" id="<?php echo 'cantprod-'.$p->idproducto;?>">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">
										Cantidad Inicial del Producto:
									</h4>
									<button type="button" class="close" data-dismiss="modal">×</button>
								</div>
								<div class="modal-body">
									<label>Cantidad Inicial:</label><br>
									<input type="number" id="cantinicial" name="cantinicial" value="<?php echo $p->existencias;?>" class="form-control input-lg" placeholder="" required="llenar"  />
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

