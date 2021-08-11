<!-- Punto de Venta -->
<div class="container-fluid">
	<div class="row">
		<!-- Despliegue de productos -->
		<div class="col-6" style="">
<!--			Despliegue de productos-->

			<div class="product-wrapper" style="background-color: lightgray;">
				<div class="row">

                        <div class="col-12">
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Marca</th>
                                        <th>Linea</th>
                                        <th>Producto</th>
                                        <th>Dimension</th>
                                        <th>PU[Bs]</th>
                                        <th>Cantidad</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php if(isset($lista_productos)){ ?>
                                <?php foreach ($lista_productos as $producto):  ?>
                                    <tr>
                                        <td><?php echo $producto->fabricante; ?></td>
                                        <td><?php echo $producto->linea; ?></td>
                                        <td><?php echo $producto->item; ?></td>
                                        <td><?php echo $producto->dimension; ?></td>
                                        <td>
                                            <?php echo number_format($producto->precio, 2, ',',''); ?>

                                            <?php //echo $producto->precio; ?>
                                        </td>
                                        <td><?php echo $producto->existencias; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('puntoVenta/agregarProducto/'.$producto->idproducto);  ?>" class="btn btn-primary btn-sm float-right">
                                                <i class="fa fa-shopping-cart"></i> <!-- Agregar -->
                                            </a>

                                        </td>
                                        <td>
                                            <a data-toggle="modal" href="<?php echo '#imagen-'.$producto->idproducto;?>" >
                                                <i class="fas fa-image fa-2x"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php }?>

                                </tbody>

                            </table>
                        </div>




				</div>

			</div>


		</div><!-- Fin Despliegue de productos -->

		<!-- Detalle y Ventas -->
		<div class="col-6" style="" >
<!--			Detalle y ventas-->
			<div class="row">
                <div class="col-12">
                    <!--Mensaje de Error-->
                    <?php if(!empty($this->session->flashdata())): ?>
                        <div id="mensaje-error">
                            <div class="alert alert-<?php echo $this->session->flashdata('clase')?>">
                                <?php echo $this->session->flashdata('mensaje') ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
				<div class="col-12" style="">
<!--					<h4 class="text-center" >Datos del Cliente</h4>-->
                    <?php

                    foreach ($cliente as $key => $valor) {
                        $idcliente = $valor['idcliente'];
                        $nt = $valor['nit'];
                        $rs = $valor['razonSocial'];
                    }
                    ?>
					<div class="form-wrapper">
                        <?php echo form_open('puntoVenta/agregarCliente'); ?>
							<div class="form-group row">
								<label for="nit" class="col-3">
									NIT/CI:
								</label>
								<div class="col-7">
									<input id="nit" name="nit" type="text" class="form-control" required
                                           autocomplete="off" placeholder="Nit del cliente"
                                        <?php
                                        if(isset($nt))
                                        {
                                            echo 'value="'.$nt.'"';
                                        }
                                        ?>

                                        <?php if(!empty($this->session->flashdata('valorNit'))): ?>
                                            value="<?php echo $this->session->flashdata('valorNit'); ?>"
                                        <?php endif; ?>
                                    />
								</div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary btn-block ">
                                        <span>
											<i class="far fa-address-book"></i>
										</span>
                                    </button>
                                </div>
							</div>
							<div class="form-group row">
								<label for="nit" class="col-3">
									Razon Social:
								</label>
								<div class="col-7">
									<input id="rsocial" name="rsocial" type="text" class="form-control"
                                           placeholder="Nombre del cliente"
                                           value="<?php
                                           if(isset($rs)){echo $rs;}
                                           ?>"
                                    />
								</div>
                                <div class="col-2"></div>
							</div>

							<!--
							<div class="form-group row">
								<div class="col-10">
									<button type="submit" class="btn btn-primary btn-lg " >
										<span>
											<i class="far fa-address-book"></i>
										</span>
									</button>
								</div>
							</div>-->

							<div></div>



                        <?php echo form_close();?>

					</div>
				</div>
				<div class="col-12" style="" >
<!--					<h4 class="text-center">Detalle de ventas</h4>-->
					<div class="table-wrapper table-striped">
						<table class="table table-sm table-hover table-striped">
							<thead class="thead-dark">
								<tr>
									<th>Producto</th>
									<th class="text-center">PU[Bs]</th>
                                    <th></th>
									<th class="text-center" >Unidad</th>
									<th class="text-center" >Cantidad</th>
									<th class="text-center" >Descuento[%]</th>
									<th class="text-center" >Total[Bs]</th>
									<th class="text-center" > </th>
								</tr>
							</thead>
							<tbody>

                                <?php foreach ($carrito as $indice=>$producto) {?>
								<tr>
									<td class="text-left">
                                        <?php //echo var_dump($producto); ?>
                                        <?php //"<br>" ?>
                                        <?php echo $producto->fabricante." ".$producto->linea." ".$producto->item." ".$producto->dimension; ?>
                                    </td>
									<td class="text-center" >
                                        <?php echo number_format($producto->precio_venta, 2, ',',''); ?>
                                        <!--Ajuste manual-->
                                    </td>
                                    <td>
                                        <a data-toggle="modal" href="<?php echo '#precioventa-'.$indice; ?>" >
                                            <i class="far fa-edit fa-sm"></i>
                                        </a>
                                    </td>
									<td class="text-center" > <?php echo $producto->unidad; ?> </td>
									<td class="text-center" >
										<?php echo $producto->cantidad; ?>
										<!-- Aumentar uno -->
										<a href="<?php echo site_url('puntoVenta/aumentarCantidad/'.$indice); ?>">
											<i class="fas fa-plus-circle fa-sm"></i>
										</a>
										<!-- Disminuir uno -->
										<a href="<?php echo site_url('puntoVenta/reducirCantidad/'.$indice); ?>">
											<i class="fas fa-minus-circle fa-sm"></i>
										</a>
										<!--Ajuste manual-->
										<a data-toggle="modal" href="<?php echo '#cantidad-'.$indice;?>" >
											<i class="far fa-edit fa-sm"></i>
										</a>
									</td>
									<td class="text-center" >
										<?php echo $producto->descuento_porcentaje; ?>
										<!-- Aumentar uno -->
										<a href="<?php echo site_url('puntoVenta/aumentarPorcentajeCarrito/'.$indice); ?>">
											<i class="fas fa-plus-circle fa-sm"></i>
										</a>
										<!-- Disminuir uno -->
										<a href="<?php echo site_url('puntoVenta/reducirPorcentajeCarrito/'.$indice); ?>">
											<i class="fas fa-minus-circle fa-sm"></i>
										</a>
										<!--Ajuste manual-->
										<a data-toggle="modal" href="<?php echo '#porcentaje-'.$indice; ?>" >
											<i class="far fa-edit fa-sm"></i>
										</a>
									</td>
									<td class="text-center"><?php echo number_format($producto->total, 2, ',',''); ?></td>
									<td class="text-center" >
										<a href="<?php echo site_url('puntoVenta/quitarProducto/'.$indice); ?>" >
											<i class="fa fa-trash fa-sm"></i>
										</a>
									</td>
								</tr>

                                <?php }?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-6" style="" >
<!--					Tipo de Venta-->
					<div class="venta-wrapper">
                        <?php echo form_open('puntoVenta/procesarVenta');?>
							<div>

								<div class="form-check">
									<input value=1 type="radio" class="form-check-input" name="tipo_venta" id="tipo_venta" checked >
									<label class="form-check-label" for="option1">Contado</label>
								</div>
								<div class="form-check">
									<input value=2 type="radio" class="form-check-input" name="tipo_venta" id="tipo_venta">
									<label class="form-check-label" for="option2">Credito</label>
								</div>
								<div class="form-check">
									<input value=3 type="radio" name="tipo_venta" id="tipo_venta" class="form-check-input">
									<label class="form-check-label" for="option3">Debito</label>
								</div>
								<div class="form-check">
									<input value=4 type="radio" name="tipo_venta" id="tipo_venta" class="form-check-input">
									<label class="form-check-label" for="option4">Cheque</label>
								</div>
								<!--<div class="form-check">
									<input value=5 type="radio" name="tipo_venta" id="tipo_venta" class="form-check-input">
									<label class="form-check-label" for="option4">Sin Factura</label>
								</div>
								<div class="form-check">
									<input value=6 type="radio" name="tipo_venta" id="tipo_venta" class="form-check-input">
									<label class="form-check-label" for="option4">Cotizacion</label>
								</div>-->



								<div class="form-group">
									<button class="btn btn-primary">
										Realizar Venta
									</button>
                                    <a href="<?php echo site_url('puntoVenta/cancelarVenta/'); ?>" class="btn btn-danger" role="button">
                                        Cancelar Venta
                                    </a>
								</div>



							</div>
						<?php //echo form_close(); ?>
					</div>
				</div>
				<div class="col-6" style="" >
	<!--					Calculos-->
                    <?php
                        $precio_total = 0;
                        $cantidad_total = 0;
                        $descuento_total = $this->session->descuento_total;
                        foreach ($carrito as $indice=>$producto){
                            $precio_total = $precio_total + $producto->total;
                            $cantidad_total = $cantidad_total + $producto->cantidad;
                        }
                    ?>
					<div class="calc-wrapper">
						<div class="form-group row">
							<label class="col-4" for="montototal">Monto Total:</label>
							<div class="col-8">
								<input type="number" class="form-control"
									   id="montototal" name="montototal" required min="1" readonly
									   value="<?php echo number_format($precio_total, 2, ',', ''); ?>"
								>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-4" for="descuentototal">Descuento [Bs]:</label>
							<div class="col-4">
								<input type="number" class="form-control" id="descuentototal" name="descuentototal"
                                       required min="1" readonly
                                       value="<?php
                                        $descuento_total_numerico = round((($descuento_total/100)*$precio_total), 0, PHP_ROUND_HALF_DOWN);
                                        echo number_format($descuento_total_numerico, 2, ',','');
                                       ?>">



							</div>

                            <div class="col-4" >
                                <span>
                                    <?php echo $descuento_total." "."%"; ?>
                                    <a href="<?php echo site_url('puntoVenta/masDescuentoTotal/'); ?>">
                                                    <i class="fas fa-plus-square fa-sm"></i>
                                                </a>
                                    <!-- Quitar uno -->
                                    <a href="<?php echo site_url('puntoVenta/menosDescuentoTotal/'); ?>">
                                        <i class="fas fa-minus-square fa-sm"></i>
                                    </a>
                                    <!-- Ajuste manual-->
                                    <a data-toggle="modal" href="<?php echo '#descuento-total';?>" >
                                       <i class="far fa-edit fa-sm"></i>
                                    </a>
                                </span>

                            </div>
						</div>

						<div class="form-group row alert-info">
							<label class="col-4" for="ventatotal">Total Venta:</label>
							<div class="col-8">
								<input type="number" class="form-control"
									   id="ventatotal" name="ventatotal" required min="0" readonly
									   value="<?php echo number_format($precio_total-$descuento_total_numerico, 2, ',', '');?>" >
							</div>
						</div>

					</div>
				</div>
			</div>
            <?php echo form_close(); ?>
		</div><!-- Fin Detalle y Ventas -->
	</div>
</div>



<!-- Porcentaje Modal -->
<?php foreach ($carrito as $indice => $producto) { ?>
    <div class="modal fade" id="<?php echo 'porcentaje-'.$indice;?>">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">
                        Ajuste del porcentaje de descuento:
                        <?php echo $producto->fabricante." ".$producto->linea." ".$producto->item." ".$producto->dimension;  ?>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?php
                    $atmform = [
                        'class' => 'form-inline',
                    ];
                    echo form_open('puntoVenta/editarPorcentaje/'.$indice);
                    ?>
                    <label for="porcentajeman">
                        Porcentaje descuento:
                    </label>
                    <input autofocus onkeypress="return soloNumeros(event)" value="<?php echo $producto->descuento_porcentaje;  ?>" min="0" max="100" type="number" id="porcentajeman" name="porcentajeman" class="form-control" required>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i></button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-door-closed"></i></button>
                    <?php echo form_close();?>
                </div>

            </div>
        </div>
    </div>
<?php } ?>

<?php foreach ($carrito as $indice => $producto) { ?>
    <!-- Cantidad Modal -->
    <div class="modal fade" id="<?php echo 'cantidad-'.$indice;?>">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">
                        Ajuste de la cantidad:
                        <?php echo $producto->fabricante." ".$producto->linea." ".$producto->item." ".$producto->dimension;  ?>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?php
                    $atmform = [
                        'class' => 'form-inline',
                    ];
                    echo form_open('puntoVenta/editarCantidad/'.$indice);
                    ?>
                    <label for="cantidadman">
                        Cantidad:
                    </label>
                    <input autofocus onkeypress="return soloNumeros(event)" value="<?php echo $producto->cantidad;  ?>" min="1"  type="number" id="cantidadman" name="cantidadman" class="form-control" required>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i></button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-door-closed"></i></button>
                    <?php echo form_close();?>
                </div>

            </div>
        </div>
    </div>
<?php } ?>

<!-- DEs -->
<div class="modal fade" id="descuento-total">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Descuento Total</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <?php
                echo form_open('puntoVenta/manualDescuentoTotal/');
                ?>


                <div class="form-group row">
                    <label class="col-4" for="descuento">Descuento:</label>
                    <div class="col-8">
                        <input type="number" class="form-control"
                               id="descuento" name="descuento" required min="0" max="100"
                               onkeypress="return soloNumeros(event)"
                               value="<?php echo $descuento_total; ?>"
                        >
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Procesar</button>
                    </div>
                </div>
                <?php echo form_close(); ?>




            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<?php if(isset($lista_productos)){ ?>
    <?php foreach ($lista_productos as $producto):  ?>
        <div class="modal fade" id="<?php echo 'imagen-'.$producto->idproducto;?>">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">



                    <!-- Modal body -->
                    <div class="modal-body">
                        <img src="<?php echo base_url($producto->imagen); ?>" class="rounded" alt="Cinque Terre">
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>


    <?php endforeach; ?>
<?php }?>


<!-- Porcentaje Modal -->
<?php foreach ($carrito as $indice => $producto) { ?>
    <div class="modal fade" id="<?php echo 'precioventa-'.$indice;?>">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">
                        Ajuste del precio de venta:
                        <?php echo $producto->fabricante." ".$producto->linea." ".$producto->item." ".$producto->dimension;  ?>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?php
                    $atmform = [
                        'class' => 'form-inline',
                    ];
                    echo form_open('puntoVenta/editarPrecio/'.$indice);
                    ?>
                    <label for="porcentajeman">
                        Ajuste del precio:
                    </label>
                    <input autofocus onkeypress="return soloNumerosFlotantes(event)"
                           value="<?php echo $producto->precio_venta;  ?>"
                           min="0" max="100000000" type="number" id="precioman" name="precioman" step="0.1"
                           class="form-control" required>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i></button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-door-closed"></i></button>
                    <?php echo form_close();?>
                </div>

            </div>
        </div>
    </div>
<?php } ?>
