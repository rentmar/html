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
                        <a href="<?php echo site_url('facturas') ?>" >
                            facturas
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a>facturas emitidas</a>
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
                    <!-- <a href="#" class="btn btn-secondary " role="button">
                        Agregar Usuario
                    </a>
                    <a href="#" class="btn btn-secondary " role="button">
                        Imprimir
                    </a> -->
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

                <table id="" class="table table-striped table-bordered despliegue">
                    <thead>
                    <tr>
                        <th>No Registro</th>
                        <th>Fecha de Venta</th>
                        <th>NIT</th>
                        <th>Cliente</th>
                        <th>Monto[Bs]</th>
                        <th>Fecha facturacion</th>
                        <th>Numero Factura</th>
                        <th>No Autorizacion</th>
                       
                        <th>Codigo de control</th>
                     
						<th>Ver</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($facturas_emitidas as $factura): ?>
                        <tr>
                            <td><?php echo $factura->idfactura;?></td>
                            <td><?php echo mdate("%d-%m-%Y", $factura->fecha_facturacion);?></td>
                            <td><?php echo $factura->nit; ?></td>
                            <td><?php echo $factura->razon_social; ?></td>
                            <td><?php
                                $precio_total =  $factura->total - $factura->descuento_total;
                                echo number_format($precio_total, 2, ',', '');
                                ?>
                            </td>
                            <td><?php echo mdate("%d-%m-%Y", $factura->fecha_facturacion); ?></td>
                            <td><?php echo $factura->numero_factura;?>                            </td>
                            <td><?php echo $factura->numero_autorizacion; ?>                            </td>
                     
                            <td><?php echo $factura->cod_control;?>  </td>
         
							<td>
								<a href="<?php echo site_url('Facturacion/facturacionContadoVer/'.$factura->idfactura); ?>">
									<i class="fa fa-eye"></i>
									Ver
								</a>
							</td>
					   </tr>
                    <?php  endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
