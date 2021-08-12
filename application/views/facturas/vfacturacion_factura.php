<div id="content-wrapper">

    <div class="container-fluid">
        <div class="row">
            <!-- Breadcrumb -->
            <div class="col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a>Factura</a>
                    </li>

                </ol>
            </div>
            <!-- End Breadcrumb -->
        </div>
    </div>

    <div class="container-fluid" >
        <div class="row">
            <div class="col-12 d-flex" >
                <div class="ml-auto">
                    <a href="<?php echo site_url('Facturas');?>" class="btn btn-secondary " role="button">
                        <i class="fas fa-sign-out-alt"></i>
                        Continuar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Linea Divisora -->
    <div class="container-fluid">
        <hr style="height:3px;border:none;color:#333;background-color:#333;" >
    </div>

    <!-- Productos Despliegue -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <!-- Encabezado -->
                    <div class="card-header">
                        <strong style="font-size: 20pt;">
                            FACTURA
                        </strong>
                        <span class="float-right">
                            <strong>Fecha: </strong>
                            <?php echo mdate("%d-%m-%Y",$registro_venta->fecha); ?>
                        </span>
                    </div>

                    <!-- Cuerpo -->
                    <div class="card-body" >
                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <strong>
                                        <?php echo $empresa->nombre_empresa; ?>
                                    </strong>
                                    <div>
                                        <?php echo 'DE: '.$empresa->razon_social; ?>
                                    </div>
                                   <div>
                                        CASA MATRIZ
                                    </div>
                                    <div>
                                        Direccion:
                                        <?php echo ' '.$empresa->direccion;?>
                                    </div>
                                    <div>
                                        Telefono:
                                        <?php echo ' '.$empresa->telefono; ?>
                                    </div>
                                    <div>La Paz - Bolivia</div>

                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <strong>
                                        NIT:
                                        <?php echo ' '.$empresa->nit; ?>
                                    </strong>
                                    <div>
                                        Factura No:
                                        <?php echo $factura->numero_factura; ?>
                                    </div>
                                    <div>
                                        Numero de autorizacion:
                                        <?php echo $factura->numero_autorizacion; ?>
                                    </div>
                                    <div>
                                        ORIGINAL
                                    </div>
                                    <div>
                                        <?php echo $empresa->actividad; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                            <div class="table-responsive-sm">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <strong>NIT/CI: </strong>
                                            <?php echo ' '.$registro_venta->nit; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>RAZON SOCIAL: </strong>
                                            <?php echo ' '.$registro_venta->razon_social; ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            </div>

                            <div class="col-12">
                            <div class="table-responsive-sm">
                                <table class="table table-striped">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-left">Descripcion</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-right">Precio Unitario[Bs]</th>
                                        <th class="text-right">Total[Bs]</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $contador = 1;?>
                                    <?php foreach ($detalle_venta as $v) {?>
                                        <tr>
                                            <td class="text-center">
                                                <?php echo $contador; ?>
                                            </td>
                                            <!-- Descripcion -->
                                            <td class="text-left">
                                                <?php echo $v->item.' '.$v->dimension; ?>
                                            </td>
                                            <!-- Cantidad --->
                                            <td class="text-center">
                                                <?php echo $v->cantidad_producto;?>
                                            </td>
                                            <!-- Precio unitario -->
                                            <td class="text-right">
                                                <?php
                                                $incremento_item = ($v->total_producto/$v->cantidad_producto)*($v->incremento/100);
                                                $descuento_item = ($v->total_producto/$v->cantidad_producto)*($v->descuento_producto/100);
                                                $precio_unitario = ($v->total_producto/$v->cantidad_producto) - $descuento_item;

                                                echo number_format($precio_unitario, 2, ',', '');
                                                ?>
                                            </td>
                                            <td class="text-right">
                                                <?php echo number_format($v->total_producto, 2, ',', '');?>
                                            </td>
                                        </tr>
                                        <?php
                                        $contador++;
                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                            </div>






                            <div class="col-4">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td class="text-left">
                                            <strong>CODIGO DE CONTROL:</strong>
                                        </td>
                                        <td>
                                            <?php echo $factura->cod_control;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                            <strong>FECHA LIMITE DE EMISION:</strong>
                                        </td>
                                        <td>
                                            <?php echo mdate('%d/%m/%Y', $factura->fecha_limite_emision);?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-8">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td class="text-left">
                                            <strong>Total[Bs]</strong>
                                        </td>
                                        <td class="text-right">
                                            <strong>
                                                <?php
                                                echo number_format($registro_venta->total, 2, ',', '');

                                                //echo $regVenta->total;
                                                ?>
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                            <?php $descuento_calculado = round(($registro_venta->descuento_total/100)*$registro_venta->total, 0, PHP_ROUND_HALF_DOWN); ?>
                                            <strong>Descuento Total <?php echo ' '.$registro_venta->descuento_total.' %';?>[Bs]</strong>
                                        </td>
                                        <td class="text-right">
                                            <strong>
                                                <?php echo number_format($descuento_calculado, 2, ',', ''); ?>
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr class="alert-primary">
                                        <td class="text-left">
                                            <strong>Total [Bs]</strong>
                                        </td>
                                        <td class="text-right">
                                            <strong>
                                                <?php echo number_format($registro_venta->total - $descuento_calculado, 2, ',', ''); ?>
                                            </strong>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>

                            </div>

















                        </div>

                    </div>

                </div>



            </div>
        </div>
    </div>

</div>