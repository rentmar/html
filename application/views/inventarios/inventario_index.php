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
						<a>Inventario/<?php echo $almacen->nombre_almacen;?></a>
					</li>
				</ol>
			</div>
		</div>
	</div>


    <div class="container-fluid" >
        <div class="row">
            <div class="col-12 d-flex" >
                <div class="ml-auto">
                    <a href="<?php echo site_url('Inventarios/iniciarProductos'); ?>" class="btn btn-secondary " role="button">
                        <i class="fas fa-pencil-alt"></i>
                        Iniciar Productos
                    </a>
					<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#buscarvalorizacion">
                        Valorizacion Productos
                    </button>
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#cuadrodialogo">
                        Iniciar Inventario
                    </button>

                    <a href="<?php echo site_url(''); ?>" class="btn btn-secondary " role="button">
                        Cancelar
                    </a>

                    <!-- <a href="#" class="btn btn-secondary " role="button">
                         Imprimir
                     </a> -->
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Cuadro de Dialogo Y/N para iniciar el Inventario -->
<div class="modal fade" id="cuadrodialogo">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Iniciar el proceso de inventario?</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Este proceso cerrara el periodo contable vigente e iniciara uno nuevo. Esta Seguro?
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="<?php echo site_url('Inventarios/valorizacion'); ?>" class="btn btn-primary" role="button"  >Si</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>

<?php echo form_open('inventarios/productoValorado'); { ?>
<div class="modal fade" id="buscarvalorizacion">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">
					Buscar Producto para Valorizacion
				</h4>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<div class="modal-body">
				<label>Producto: </label><br>
				<input type="text" id="producto_val" name="producto_val" value="" class="form-control input-lg" placeholder="" required="llenar"  />						
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Buscar <i class="fa fa-search"></i></button>
				<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-door-closed"></i></button>
				<?php echo form_close();?>
			</div>

		</div>
	</div>
</div>
<?php } ?>