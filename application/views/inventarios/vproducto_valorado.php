<div id="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?php echo site_url('/');?>">
                            <i class="fas fa-home"></i>
                        </a>
					</li>
					<li class="breadcrumb-item active">
						<a>Valorizacion/<?php echo $almacen->nombre_almacen;?></a>
					</li>
				</ol>
			</div>
		</div>
	</div>

    <div class="container-fluid" >
        <div class="row">
            <div class="col-12 d-flex" >
                <div class="ml-auto">
                    <a href="<?php echo site_url('inventarios'); ?>" class="btn btn-secondary " role="button">
                        Cancelar
                    </a>
                </div>
            </div>
        </div>
    </div>

	<!-- Linea Divisora -->
	<div class="container-fluid">
		<hr style="height:3px;border:none;color:#333;background-color:#333;" >
	</div>
	<!-- Linea Despliegue -->
	<div class="container-fluid">
        <div class="box-body">
            <h4 class="purchase-heading">
                <i class="fa fa-check-circle"></i>
                Valorizacion Productos
            </h4>
            <div class="row">
                <div class="col-12">
                    <table id="" class="table table-striped table-bordered despliegue" >
                        <thead>
                        <tr>
							<th>Nro</th>
                            <th>PRODUCTO</th>
							<th>CODIGO</th>
							<th>EXISTENCIAS</th>
							<th>TIPO</th>
                            <th>VALORIZACION</th>
                        </tr>
                        </thead>
                        <tbody>
							<?php foreach ($productos as $p) { ?>
							<td><?php echo $p->idproducto; ?></td>
							<td><?php echo $p->fabricante.' '.$p->linea.' '.$p->item.' '.$p->dimension.' '.$p->unidad; ?></td>
							<td><?php echo $p->codigo; ?></td>
							<td><?php echo $p->existencias; ?></td>
							<td><?php echo 'A'; ?></td>
							<td>
								<i class="fas fa-eye"></i>
								<a href="<?php echo site_url('inventarios/valorizacionProducto/'.$p->idproducto); ?>">ver</a>
							</td>
							<?php } ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>