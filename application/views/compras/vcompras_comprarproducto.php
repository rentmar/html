<div id="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">
							<i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
							Compra de Producto
						</h3>
					</div>
					<?php echo form_open_multipart('compras/registrarCompra');?>
					<div class="box-body">
						<!-- Linea Divisora -->
						<div class="container-fluid">
							<hr style="height:3px;border:none;color:#333;background-color:#333;" >
						</div>
						<div>
							<input type="hidden" id="idproducto" name="idproducto" value="<?php echo $producto[0]->idproducto; ?>" class="form-control input-lg" placeholder="" required="llenar"  />
							<label>Marca:</label>
							<input type="text" id="marca" name="marca" value="<?php echo $producto[0]->fabricante; ?>" class="form-control input-lg" placeholder="" required="llenar"  />
							<label>Linea:</label>
							<input type="text" id="linea" name="linea" value="<?php echo $producto[0]->linea; ?>" class="form-control input-lg" placeholder="" required="llenar"  />
							<label>Item:</label>
							<input type="text" id="item" name="item" value="<?php echo $producto[0]->item; ?>" class="form-control input-lg" placeholder="" required="llenar"  />
							<label>Dimension:</label>
							<input type="text" id="dimension" name="dimension" value="<?php echo $producto[0]->dimension; ?>" class="form-control input-lg" placeholder="" required="llenar"  />
							<label>Codigo:</label>
							<input type="text" id="codigo" name="codigo" value="<?php echo $producto[0]->codigo; ?>" class="form-control input-lg" placeholder="" required="llenar"  />
							<label>Unidad:</label>
							<input type="text" id="unidad" name="unidad" value="<?php echo $producto[0]->unidad; ?>" class="form-control input-lg" placeholder="" required="llenar"  />
						</div>
						<!-- Linea Divisora -->
						<div class="container-fluid">
							<hr style="height:3px;border:none;color:#333;background-color:#333;" >
						</div>
						<div>
							<label>Fecha:</label>
							<div class="col-2 form-group row">
								<input type="date" id""fecha" name="fecha" value="<?php echo $fecha;?>" required="llenar">
							</div>
							<label>Codigo Pedido:</label>
							<input type="text" id="codigo_pedido" name="codigo_pedido" value="" class="form-control input-lg" placeholder="" required="llenar"  />
							<label>Numero Factura:</label>
							<input type="text" id="numero_factura" name="numero_factura" value="" class="form-control input-lg" placeholder="" required="llenar"  />
                            <label>Cantidad:</label>
							<input type="numeric" id="cantidad" name="cantidad" value="" class="form-control input-lg" placeholder="" required="llenar"  />
						</div>
					</div>
					<div class="row">
							<div class="col-12 d-flex justify-content-end ">
								<div class="form-group">
									<button type="submit" class="btn btn-primary">
										<i class="far fa-save"></i>
										Registrar Compra
									</button>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

