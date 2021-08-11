<div id="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">
							<i class="fa fa-people-carry" aria-hidden="true"></i>
							Solicitar Movimiento
						</h3>
					</div>
					<?php echo form_open_multipart('movimientos/registrarSolicitud');?>
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
						<h4 style="color:DodgerBlue;">
							Fecha:
						</h4>
						<div class="col-2 form-group row">
							<input type="date" id="fecha" name="fecha" value="<?php echo $fecha;?>" required="llenar">
							<input type="hidden" id="usuario" name="usuario" value="<?php echo $usuario;?>" required="llenar">
						</div>
						<table  id="" class="table table-striped table-bordered">
								<thead class="bg bg-blue">
									<tr>
										<th>Producto</th>
										<th>Almacen Origen</th>
										<th>Cantidad Origen</th>
										<th>Almacen Destino</th>
										<th>Cantidad Movimiento</th>
									</tr>
								</thead>
								<tbody style="font-size:1vw">
									<tr>
										<td><?php echo $producto;?></td>
										<td><?php echo $origen=$almacen_origen->nombre_almacen;?></td>		
										<td><?php echo $existencias; ?></td>
										<td>
											<select id="iddestino" name="iddestino" class="selectpicker form-control" data-width="100%" style="font-size: 16pt;">
												<?php foreach ($almacenes as $a):?>
												<?php if($origen!=$a->nombre_almacen){?>
												<option value="<?php echo $a->idalmacen; ?>"><?php echo $a->nombre_almacen; ?></option>
												<?php } ?>
												<?php endforeach;?>
											</select>	
										</td>
										<td>
											<input type="number" id="movimiento" name="movimiento" value="<?php echo $existencias; ?>" class="form-control input-lg" placeholder="" required="llenar"  />
										</td>      
									</tr>  
								</tbody>
							</table>
						<input type="hidden" id="idorigen" name="idorigen" value="<?php echo $almacen_origen->idalmacen;?>" required="llenar">
						<input type="hidden" id="idproducto" name="idproducto" value="<?php echo $idprod; ?>" class="form-control input-lg" placeholder="" required="llenar"  />
						<input type="hidden" id="existencias" name="existencias" value="<?php echo $existencias; ?>" class="form-control input-lg" placeholder="" required="llenar"  />	
					</div>
					<div class="row">
						<div class="col-12 d-flex justify-content-end ">
							<div class="form-group">
								<button type="submit" class="btn btn-primary">
									<i class="fas fa-sign-out-alt"></i>
									Enviar Solicitud
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
