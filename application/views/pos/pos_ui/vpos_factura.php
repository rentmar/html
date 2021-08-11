<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
      <a class="navbar-brand" href="#">
          <i class="far fa-file-alt"></i>
          Facturacion
      </a>
    <!-- Links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('comprobantes/factura/'.$idVenta); ?>" target="_blank">
                <i class="fas fa-file-pdf"></i>
                Factura Original
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('comprobantes/facturaCopia/'.$idVenta); ?>" target="_blank">
                <i class="fas fa-file-pdf"></i>
                Factura Copia
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('comprobantes/boleta/'.$idVenta); ?>" target="_blank">
                <i class="fas fa-file-pdf"></i>
                Boleta
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('puntoVenta'); ?>">
                <i class="fas fa-sign-out-alt"></i>
                Continuar
            </a>
        </li>
    </ul>
</nav>




<section id="factura">
    
    <div class="container">
        <div class="card">
            <!-- Encabezado -->
            <div class="card-header">
                <strong style="font-size: 20pt;">
                    FACTURA
                </strong>
                <span class="float-right">
                    <strong>Fecha: </strong>
                    <?php echo mdate('%M  %d, %Y',$regVenta->fecha); ?>
                </span>               
            </div>
            <!-- Cuerpo -->
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h6>
                            
                        </h6>
                        <div>
                            <strong>
                                <?php echo $sucursal->nombre_empresa; ?>
                            </strong>
                            <div>
                                <?php echo 'DE: '.$sucursal->razon_social; ?>
                            </div>
                            <?php if($sucursal->es_casamatriz): ?>
                            <div>
                                CASA MATRIZ
                            </div>
                            <div>
                                Direccion:
                                <?php echo ' '.$sucursal->direccion;?>
                            </div>                            
                            <div>
                                Telefono:
                                <?php echo ' '.$sucursal->telefono; ?>
                            </div>
                            <div>La Paz - Bolivia</div>
                            <?php else: ?>
                            <div>
                                SUCURSAL No
                                <?php echo ' '.$sucursal->numero_sucursal; ?>
                            </div>
                            <div>
                                Direccion:
                                <?php echo ' '.$sucursal->direccion;?>
                            </div>                            
                            <div>
                                Telefono:
                                <?php echo ' '.$sucursal->telefono; ?>
                            </div>
                            <div>La Paz - Bolivia</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6>
                            
                        </h6>
                        <div>
                            <strong>
                                NIT:
                                <?php echo ' '.$sucursal->nit; ?>
                            </strong>                            
                            <div>
                                Factura No:
                                <?php echo $factura->numero_factura; ?>
                            </div>
                            <div>
                                Numero de autorizacion:
                                <?php echo $datos_facturacion->numero_autorizacion; ?>
                            </div>
                            <div>
                                ORIGINAL
                            </div>
                            <div>
                                <?php echo $sucursal->actividad; ?>
                            </div>
                        </div>
                    </div>                    
                </div> 
                
                                
                <div class="table-responsive-sm">
                    <table class="table table-bordered">
                        <tbody>                            
                            <tr>
                                <td>
                                    <strong>NIT/CI: </strong>
                                    <?php echo ' '.$regVenta->nit; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>RAZON SOCIAL: </strong>
                                    <?php echo ' '.$regVenta->razon_social; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
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
                            <?php foreach ($detalleVenta as $v) {?>
                            <tr>
                                <td class="text-center">
                                    <?php echo $contador; ?>
                                </td>
                                <!-- Descripcion -->
                                <td class="text-left">
                                    <?php echo $v->descripcion; ?>
                                </td>
                                <!-- Cantidad --->
                                <td class="text-center">
                                    <?php echo $v->cantidad;?>
                                </td>
                                <!-- Precio unitario -->
                                <td class="text-right">
                                    <?php
                                        $desc_parcial =  round(($v->descuento/100)*$v->precio_venta, 1, PHP_ROUND_HALF_DOWN) ;
                                        $precioUnitario = $v->precio_venta - $desc_parcial;

                                        echo number_format($precioUnitario, 2, ',', '');
                                    ?>
                                </td>
                                <td class="text-right">
                                    <?php echo number_format($v->total, 2, ',', '');?>
                                </td>
                            </tr>
                            <?php 
                                $contador++;
                                }
                            ?>                         
                            
                        </tbody>
                    </table>
                </div>
                
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                        <table class="table table-clear">
                            <tbody>                                
                                <tr>
                                    <td class="text-left">
                                        <strong>CODIGO DE CONTROL:</strong>
                                    </td>
                                    <td>
                                        <?php echo $codControl;?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>FECHA LIMITE DE EMISION:</strong>
                                    </td>
                                    <td>
                                        <?php echo mdate('%d/%m/%Y', $datos_facturacion->fecha_limite_emision);?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>    
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        
                        <?php if ($regVenta->rel_tipopago == 1 || $regVenta->rel_tipopago == 5): ?>
                        <table class="table table-clear">
                            <tbody>                                
                                <tr>
                                    <td class="text-left">
                                        <strong>Total[Bs]</strong>
                                    </td>
                                    <td class="text-right">
                                        <strong>
                                            <?php
                                                echo number_format($regVenta->total, 2, ',', '');

                                                //echo $regVenta->total;
                                            ?>
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <?php $descuento_calculado = round(($regVenta->descuento_total/100)*$regVenta->total, 0, PHP_ROUND_HALF_DOWN); ?>
                                        <strong>Descuento Total <?php echo ' '.$regVenta->descuento_total.' %';?>[Bs]</strong>
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
                                            <?php echo number_format($regVenta->total - $descuento_calculado, 2, ',', ''); ?>
                                        </strong>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        <?php endif ?>

                        <?php if ($regVenta->rel_tipopago == 2): ?>
                        <table class="table table-clear">
                            <tbody>                                
                                <tr>
                                    <td class="text-left">
                                        <strong>Total[Bs]</strong>
                                    </td>
                                    <td class="text-right">
                                        <strong>
                                            <?php echo $regVenta->total; ?>
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <?php $descuento_calculado = round(($regVenta->descuento_total/100)*$regVenta->total, 0, PHP_ROUND_HALF_DOWN) ?>
                                        <strong>Descuento <?php echo ' '.$regVenta->descuento_total.' %';?>[Bs]</strong>
                                    </td>
                                    <td class="text-right">
                                        <strong>
                                            <?php echo $descuento_calculado; ?>
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>Total - Descuento [Bs]</strong>
                                    </td>
                                    <td class="text-right">
                                        <strong>
                                            <?php echo $regVenta->total - $descuento_calculado; ?>
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>
                                            Cargo por debito,
                                            <?php echo ' '.$regVenta->cargo_transaccion.' %'; ?>
                                            [Bs]
                                        </strong>
                                    </td>
                                    <td class="text-right">
                                        <strong>
                                            <?php echo ($regVenta->total)*($regVenta->cargo_transaccion/100); ?>
                                        </strong>
                                    </td>
                                </tr>
                                <tr class="alert-primary">
                                    <td class="text-left">
                                        <strong>Total + Cargo [Bs]</strong>
                                    </td>
                                    <td class="text-right">
                                        <strong>
                                            <?php
                                                echo $regVenta->total - ($regVenta->total)*($regVenta->descuento_total/100) + ($regVenta->total)*($regVenta->cargo_transaccion/100); ?>
                                        </strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php endif ?>                        
                        
                    </div>
                </div>                
                
            </div>
        </div>        
    </div>    
</section>

