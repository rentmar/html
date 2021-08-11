<div id="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="box">

					<div class="box-header">
						<h3 class="box-title">
							<i class="fa fa-plus" aria-hidden="true"></i>
							Crear Nuevo Producto
						</h3>
					</div>
					<?php echo form_open_multipart('productos/registrarProducto');?>
					<!-- Marca y linea -->
					<div class="box-body">
						<h4 class="purchase-heading">
							<i class="fa fa-check-circle"></i>
							Marca y Linea
						</h4>

						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<label>Marca:</label>
									<select id="marca_producto" name="marca_producto" class="selectpicker form-control" data-width="100%" style="font-size: 16pt;">
										<?php foreach ($marcas as $m):?>
										<option value="<?php echo $m->fabricante; ?>"><?php echo $m->fabricante; ?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label>Linea:</label>
									<select id="linea_producto" name="linea_producto" class="selectpicker form-control" data-width="100%" style="font-size: 16pt;">
										<?php foreach ($lineas as $l):?>
										<option value="<?php echo $l->nombre; ?>"><?php echo $l->nombre; ?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
						</div>
					</div><!-- Fin Marca y categoria -->
					<!-- Seccion Informacion General -->
					<div class="box-body">
						<h4 class="purchase-heading">
							<i class="fa fa-check-circle"></i>
							Informacion del Producto
						</h4>
						<div class="row">
							<div class="col-4">
								<div>
									<label for="imagenes">Elegir Nombre de la Imagen:</label>
									<br>
									<select name="imagenes" id="imagenes">
									<?php foreach($imagenes as $img) {?>
										<option value="<?php echo $img->idimag;?>"><?php echo $img->nombre_imagen;?></option>
									<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label>Item:</label>
									<input type="text" id="item_producto" name="item_producto" value="" class="form-control input-lg" placeholder="" required=""  />
									<small>Descripcion del producto</small>
								</div>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label>Codigo</label>
									<input type="text" id ="codigo_producto" name="codigo_producto" value="" class="form-control input-lg" placeholder="" required=""  />
									<small>Codigo del producto </small>
								</div>
							</div>
						</div>
					</div><!-- Fin Seccion Informacion General -->

					<!-- Unidad y dimension -->
					<div class="body">
						<h4 class="purchase-heading">
							<i class="fa fa-check-circle"></i>
							Unidad, Dimension y Embalaje
						</h4>

						<div class="row">
							<div class="col-4">
								<div class="form-group">
									<label>Dimension:</label>
									<input type="text" id="dimension_producto" name="dimension_producto" value="" class="form-control input-lg" placeholder="" required=""  />
									<small>Dimension caracteristica del producto</small>
								</div>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label>Unidad:</label>
									<select id="unidad_producto" name="unidad_producto" class="selectpicker form-control" data-width="100%" style="font-size: 16pt;">
										<?php foreach ($unidades as $u):?>
										<option value="<?php echo $u->nombre; ?>"><?php echo $u->nombre; ?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label>Embalajes:</label>
									<input type="text" id ="embalaje_producto" name="embalaje_producto" value="" class="form-control input-lg" placeholder="" required=""  />
									<small>Embalaje del producto </small>
								</div>
							</div>
						</div>

					</div><!-- Fin Unidad y dimension -->
					<!--   -->
					<div class="box-body">
						<h4 class="purchase-heading">
							<i class="fa fa-check-circle"></i>
							Precio, Incremento y Descuento
						</h4>
						<div class="row">
							<div class="col-3">
								<label>Precio:</label>
								<input type="number" step="0.01" min="0" id="preciofabricaproducto"
									   id="precio_producto" name="precio_producto"  class="form-control" autocomplete="OFF" required />
								<small>Precio de lista</small>
							</div>
							<div class="col-3">
								<label>Incremento:</label>
								<input type="number" step="1" min="0" id="incremento"
									   name="incremento"  class="form-control" autocomplete="OFF" required />
								<small>Margen de ganancia</small>
							</div>
							<div class="col-3">
								<label>Descuento:</label>
								<input type="number" step="1" min="0" id="descuento_maximo"
									   name="descuento_maximo"  class="form-control" autocomplete="OFF" required />
								<small>Descuento maximo</small>
							</div>
						</div>
						<div class="row">
							<div class="col-12 d-flex justify-content-end ">
								<div class="form-group">
									<button type="submit" class="btn btn-primary">
										<i class="far fa-save"></i>
										Guardar y Continuar
									</button>
									<a href="<?php echo site_url('Productos');?>" class="btn btn-secondary " role="button">
										<i class='fas fa-sign-out-alt'></i>
										Salir
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script src="<?php echo base_url(); ?>assets/js/FileUploader.js" ></script>
<script type="text/javascript">
    new FileUploader('.uploader');
</script>
