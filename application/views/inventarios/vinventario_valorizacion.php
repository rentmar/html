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
						<a>Valorizacion/Item: <?php echo $producto[0]->idproducto;?></a>
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
                Valorizacion de <?php echo $producto[0]->fabricante.' '.$producto[0]->linea.' '.$producto[0]->item.' codigo: '.$producto[0]->codigo;?>
            </h4>
            <div class="row">
                <div class="col-12">
                    <h4>Inventario Mercaderia Inicial: <?php echo $IMI; ?></h4>
					<h4>Inventario Mercaderia Final: <?php echo $producto[0]->existencias; ?></h4>
					<h4>Ventas Netas: <?php echo $VN;?></h4>
					<h4>Compras Netas: <?php echo $CN;?></h4>
                </div>
            </div>
        </div>
    </div>
</div>