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
					<?php echo form_open_multipart('productos/modificarProducto');?>
					<!-- Marca y linea -->
					<div class="box-body">
						<h4 class="purchase-heading">
							<i class="fa fa-check-circle"></i>
							Marca y Linea
						</h4>
						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<input type="hidden" id="eidproducto" name="eidproducto" value="<?php echo $dts_editar[0]->idproducto;?>" class="form-control input-lg" placeholder="" required=""  />
									<label>Marca:</label>
									<select id="emarca_producto" name="emarca_producto" class="selectpicker form-control" data-width="100%" style="font-size: 16pt;">
										<?php foreach ($marcas as $m):?>
										<?php if ($m->fabricante==$dts_editar[0]->fabricante) {?>
										<option value="<?php echo $m->fabricante; ?>" selected><?php echo $m->fabricante; ?></option>
										<?php } else { ?>
										<option value="<?php echo $m->fabricante; ?>" ><?php echo $m->fabricante; ?></option>
										<?php } ?>
										<?php endforeach;?>
									</select>
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label>Linea:</label>
									<select id="elinea_producto" name="elinea_producto" class="selectpicker form-control" data-width="100%" style="font-size: 16pt;">
										<?php foreach ($lineas as $l):?>
										<?php if ($l->nombre==$dts_editar[0]->linea) {?>
										<option value="<?php echo $l->nombre; ?>" selected><?php echo $l->nombre; ?></option>
										<?php } else {?>
										<option value="<?php echo $l->nombre; ?>"><?php echo $l->nombre; ?></option>
										<?php } ?>
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
						<?php //echo base_url().$dts_editar[0]->imagen; ?>
						<div class="row">
							<div class="col-4">
								<div>
									<label for="imagenes">Elegir Nombre de la Imagen:</label>
									<br>
									<select name="imagenes" id="imagenes">
									<?php foreach($imagenes as $img) {?>
										<?php if ($img->nombre_imagen==$imagene) {?>
										<option selected="true" value="<?php echo $img->idimag;?>"><?php echo $img->nombre_imagen;?></option>
										<?php } ?>
										<?php if ($img->nombre_imagen!=$imagene) {?>
										<option value="<?php echo $img->idimag;?>"><?php echo $img->nombre_imagen;?></option>
										<?php } ?>
									<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label>Item:</label>
									<input type="text" id="eitem_producto" name="eitem_producto" value="<?php echo $dts_editar[0]->item;?>" class="form-control input-lg" placeholder="" required=""  />
									<small>Descripcion del producto</small>
								</div>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label>Codigo</label>
									<input type="text" id ="ecodigo_producto" name="ecodigo_producto" value="<?php echo $dts_editar[0]->codigo;?>" class="form-control input-lg" placeholder="" required=""  />
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
									<input type="text" id="edimension_producto" name="edimension_producto" value="<?php echo $dts_editar[0]->dimension;?>" class="form-control input-lg" placeholder="" required=""  />
									<small>Dimension caracteristica del producto</small>
								</div>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label>Unidad:</label>
									<select id="eunidad_producto" name="eunidad_producto" value="<?php echo $dts_editar[0]->unidad;?>" class="selectpicker form-control" data-width="100%" style="font-size: 16pt;">
										<?php foreach ($unidades as $u):?>
										<?php if ($u->nombre==$dts_editar[0]->unidad) {?>
										<option value="<?php echo $u->nombre; ?>" selected><?php echo $u->nombre; ?></option>
										<?php } else {?>
										<option value="<?php echo $u->nombre; ?>"><?php echo $u->nombre; ?></option>
										<?php } ?>
										<?php endforeach;?>
									</select>
								</div>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label>Embalajes:</label>
									<input type="text" id ="eembalaje_producto" name="eembalaje_producto" value="1" class="form-control input-lg" placeholder="" required=""  />
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
								<input type="number" step="0.01" min="0" 
									   id="eprecio_producto" name="eprecio_producto"  value="<?php echo $dts_editar[0]->precio;?>" class="form-control" autocomplete="OFF" required />
								<small>Precio de lista</small>
							</div>
							<div class="col-3">
								<label>Incremento:</label>
								<input type="number" step="1" min="0" id="eincremento_producto"
									   name="eincremento_producto"  value="<?php echo $dts_editar[0]->incremento;?>" class="form-control" autocomplete="OFF" required />
								<small>Margen de ganancia</small>
							</div>
							<div class="col-3">
								<label>Descuento:</label>
								<input type="number" step="1" min="0" id="edescuento_maximo"
									   name="edescuento_maximo"  value="<?php echo $dts_editar[0]->descuento;?>" class="form-control" autocomplete="OFF" required />
								<small>Descuento maximo</small>
							</div>
						</div>
						<div class="row">
							<div class="col-12 d-flex justify-content-end ">
								<div class="form-group">
									<button type="submit" class="btn btn-primary">
										<i class="far fa-edit"></i>
										Modificar
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

