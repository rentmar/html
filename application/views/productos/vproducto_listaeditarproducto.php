<div id="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="box">

					<div class="box-header">
						<h3 class="box-title">
							<i class="fa fa-edit" aria-hidden="true"></i>
							Editar Producto
						</h3>
					</div>
					
					<div class="box-body">
						<div class="row">
							<div class="col-12 d-flex" >
								<div class="ml-auto">
									<a href="<?php echo site_url('Productos'); ?>" class="btn btn-secondary " role="button">
										<i class="fas fa-ban"></i>
										Cancelar
									</a>				
								</div>
							</div>
						</div>
						<!-- Linea Divisora -->
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
										<th>Precio</th>
										<th>Incremento</th>
										<th>Descuento</th>
										<th>Accion</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($lista_prods as $p):?>
									<tr>
										<?php for ($i=0;$i<=9;$i++) { ?>
										<td><?php 
											if ($i==0)
											{
												$idp=$p->idproducto;
												echo $idp;
											}
											if ($i==1)
											{
												echo $p->fabricante;
											}
											if ($i==2)
											{
												echo $p->linea;
											}
											if ($i==3)
											{
												echo $p->item;
											}
											if ($i==4)
											{
												echo $p->dimension;
											}
											if ($i==5)
											{
												echo $p->codigo;
											}
											if ($i==6)
											{
												echo $p->unidad;
											}
											if ($i==7)
											{
												echo $p->precio;
											}
											if ($i==8)
											{
												echo $p->incremento;
											}
											if ($i==9)
											{
												echo $p->descuento;
											}
										?></td>
										<?php } ?>         
										<td align="center">
											<a href="<?php echo base_url().'index.php/productos/editarProducto/'.$idp;?>">
												<i class="fas fa-edit">editar</i>
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





