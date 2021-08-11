<div id="content-wrapper">
    <div class="container-fluid">
        <div class="row">

            <!-- Breadcrumb -->
            <div class="col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo site_url('/');?>">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?php echo site_url('puntoVenta/');?>">
                            Punto de Venta
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a>Venta sin Factura</a>
                    </li>
                </ol>
            </div>
            <!-- End Breadcrumb -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    Nueva Venta sin Factura
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-body">
                    <h4 class="purchase-heading">
                        <i class="fa fa-check-circle"></i>
                        Venta sin Factura
                    </h4>
                </div>

                <div class="box-body"><!-- Inicio body -->
                    <?php echo form_open('puntoVenta/registrarVenta/'); ?>
                    <div class="form-group row">
                        <label class="col-3" for="fecha">Fecha:</label>
                        <div class="col-9 input-group date" >
                            <input type="date" class="form-control" required
                                   id="fecha" name="fecha"
                            >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3" for="numerofactura">Numero de Factura:</label>
                        <div class="col-3">
                            <input type="number" class="form-control" required
                                   onkeydown="return noContenido(event);"
                                   id="numerofactura" name="numerofactura"
                                   min="1"
                                   value="<?php echo $datos_facturacion->numero_actual_factura; ?>">
                        </div>
                        <label class="col-3 " for="ultimonumerofactura">Ultimo Numero Emitido:</label>
                        <div class="col-3">
                            <?php if($datos_facturacion->numero_ultimo_factura != 0): ?>
                                <input type="number" class="form-control " required readonly
                                       onkeydown="return noContenido(event);"
                                       id="ultimonumerofactura" name="ultimonumerofactura"
                                       value="<?php echo $datos_facturacion->numero_ultimo_factura; ?>">
                            <?php else: ?>
                                <input type="text" class="form-control " required readonly
                                       onkeydown="return noContenido(event);"
                                       value="Sin Facturacion">
                            <?php endif; ?>
                        </div>
                    </div>



                    <!-- Seccion nit del Cliente-->
                    <div class="form-group row">
                        <div class="col-12">
                            <input type="hidden" id="factura" name="factura" value="0" >
                        </div>
                        <div class="col-12">
                            <input type="hidden" id="tipoventa" name="tipoventa"
                                   value="<?php echo $venta_actual['tipo_venta']; ?>"  >
                        </div>
                        <div class="col-12">
                            <input type="hidden" id="idcliente" name="idcliente" required class="form-control"
                                   value="<?php echo base64_encode($cliente_actual[0]['idcliente']); ?>" >
                        </div>
                        <label class="col-3" for="nit" >
                            NIT:
                        </label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="nit" name="nit" required readonly
                                   value="<?php echo $cliente_actual[0]['nit']; ?>" >
                        </div>

                    </div><!-- Fin Seccion nit del Cliente-->

                    <!-- Razon Social -->
                    <div class="form-group row">
                        <label class="col-3" for="razonsocial">Razon Social:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="razonsocial" name="razonsocial" required readonly
                                   value="<?php echo $cliente_actual[0]['razonSocial'];
                                   ?>"
                            >
                        </div>
                    </div><!-- Fin Razon Social -->

                    <div class="form-group row"><!-- Linea divisora -->
                        <div class="col-12">
                            <hr style="height:3px;border:none;color:#333;background-color:#333;" >
                        </div>
                    </div><!-- Fin Linea divisora -->

                    <div class="form-group row"><!-- Detalle -->
                        <div class="col-12">
                            <table class="table table-sm table-hover table-striped">
                                <thead class="thead-dark">
                                <tr>
                                    <th>Producto</th>
                                    <th class="text-center">PU[Bs]</th>
                                    <th class="text-center" >Unidad</th>
                                    <th class="text-center" >Cantidad</th>
                                    <th class="text-center" >Parcial[Bs]</th>
                                    <th class="text-center" >Descuento[Bs]</th>
                                    <th class="text-center" >Total[Bs]</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($carrito as $indice=>$producto):?>
                                    <tr>
                                        <td class="">
                                            <?php echo $producto->fabricante." ".$producto->linea." ".$producto->item." ".$producto->dimension; ?>
                                        </td>
                                        <td class="text-right" >
                                            <?php
                                            $precio_venta = number_format($producto->precio_venta, 2, '.','');
                                            echo $precio_venta;
                                            ?>

                                        </td>
                                        <td class="text-center" >
                                            <?php echo $producto->unidad; ?>
                                        </td>
                                        <td class="text-center" >
                                            <?php echo $producto->cantidad; ?>
                                        </td>
                                        <td class="text-right">
                                            <?php
                                            $parcial = number_format($producto->cantidad*$producto->precio_venta, 2, '.','');
                                            echo $parcial;
                                            ?>
                                        </td>
                                        <td class="text-right" >
                                            <?php
                                            $descuento = ($producto->precio_venta*$producto->cantidad) -  $producto->total;

                                            echo $descuento;



                                            //echo number_format($parcial-$producto->total, 2, ',','');


                                            ?>
                                        </td>
                                        <td class="text-right">
                                            <?php echo number_format($producto->total, 2, '.',''); ?>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>


                        </div>
                    </div><!-- Fin Detalle -->

                    <div class="form-group row">
                        <div class="col-8"></div>
                        <label class="col-2 text-right" for="total">SubTotal[Bs]:</label>
                        <div class="col-2">
                            <input type="text" class="form-control text-right" id="total" name="total" required readonly
                                   value="<?php
                                   echo number_format($venta_actual['venta_parcial'], 2, '.','');
                                   ?>"
                            >
                        </div>

                    </div>


                    <div class="form-group row">
                        <div class="col-12">
                            <input type="hidden" class="form-control" id="de-total" name="de-total"
                                   value="<?php echo $venta_actual['descuento_total_porcentaje']; ?>"
                            >
                        </div>
                        <div class="col-8"></div>
                        <label class="col-2 text-right" for="total">Descuento[Bs]:</label>
                        <div class="col-2">
                            <input type="text" class="form-control text-right" id="descuentototal" name="descuentototal" required readonly
                                   value="<?php
                                   echo number_format($venta_actual['descuento_total'], 2, '.','');
                                   ?>"
                            >
                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-8"></div>
                        <label class="col-2 text-right alert alert-info" for="total">Total[Bs]:</label>
                        <div class="col-2 alert alert-info">
                            <input type="text" class="form-control  text-right " id="ventatotal" name="ventatotal" required readonly
                                   value="<?php
                                   echo number_format($venta_actual['venta_total'], 2, '.','');
                                   ?>"
                            >
                        </div>

                    </div>


                    <div class="form-group row">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="far fa-save"></i>
                                Guardar
                            </button>
                            <a href="<?php echo site_url('puntoVenta/');?>" class="btn btn-danger" role="button">
                                <i class="fas fa-ban"></i>
                                Cancelar
                            </a>
                        </div>
                    </div>





                    <?php echo form_close(); ?>
                </div><!-- Fin body -->





            </div>





        </div>
    </div>
</div>

