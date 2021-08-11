<div id="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="box">

					<div class="box-header">
						<h3 class="box-title">
							<i class="fa fa-edit" aria-hidden="true"></i>
							Buscar/Editar Unidad
						</h3>
					</div>
					
					<div class="box-body">
						<div class="row">
							<div class="col-12 d-flex" >
								<div class="ml-auto">
									<a href="<?php echo site_url('MarcasLineasUnidades'); ?>" class="btn btn-secondary " role="button">
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
										<th>Unidad</th>
										<th>Accion</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($dts_unidad as $u):?>
									<tr>
										<?php for ($i=0;$i<=1;$i++) { ?>
										<td><?php 
											if ($i==0)
											{
												$idu=$u->idunidad;
												echo $idu;
											}
											if ($i==1)
											{
												echo $u->nombre;
											}
										?></td>
										<?php } ?>         
										<td align="center">
											<a href="<?php echo base_url().'index.php/unidades/editarUnidad/'.$idu;?>">
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




