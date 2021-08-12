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
                    <li class="breadcrumb-item active">
                        <a>Facturas</a>
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
					<a href="<?php echo site_url('facturas/facturasRevisar'); ?>" class="btn btn-secondary " role="button">
                        Revisar Facturas 
                    </a>
                    <a href="<?php echo site_url('Facturas/actualizarDosificacion'); ?>" class="btn btn-secondary " role="button">
                        Dosificacion
                    </a>
                    <a href="<?php echo site_url('facturas/testFacturas'); ?>" class="btn btn-secondary " role="button">
                        Test Facturas
                    </a>

                   <!-- <a href="#" class="btn btn-secondary " role="button">
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

    <div class="container-fluid">

        <div class="box-body">
            <h4 class="purchase-heading">
                <i class="fa fa-check-circle"></i>
                Datos Actuales de Dosificacion
            </h4>

            <dl class="row">
                <dt class="col-4 text-right">NIT:</dt>
                <dt class="col-8 text-left"><?php echo $empresa_factura->nit; ?></dt>
                <dt class="col-4 text-right">Nombre Empresa:</dt>
                <dt class="col-8 text-left"><?php echo $empresa_factura->nombre_empresa; ?></dt>
                <dt class="col-4 text-right">Razon Social:</dt>
                <dt class="col-8 text-left"><?php echo $empresa_factura->razon_social; ?></dt>
                <dt class="col-4 text-right">Numero de Autorizacion:</dt>
                <dt class="col-8 text-left"><?php echo $empresa_factura->numero_autorizacion; ?></dt>
                <dt class="col-4 text-right">Fecha Limite de Emision:</dt>
                <dt class="col-8 text-left">
                    <div class="alert alert-warning">
                        <?php echo mdate('%d/%m/%Y', $empresa_factura->fecha_limite_emision); ?>
                    </div>
                </dt>
                <dt class="col-4 text-right">Numero de factura inicial:</dt>
                <dt class="col-8 text-left"><?php echo $empresa_factura->numero_inicial_factura; ?></dt>
                <dt class="col-4 text-right">Numero de factura actual:</dt>
                <dt class="col-8 text-left"><?php echo $empresa_factura->numero_actual_factura; ?></dt>
                <dt class="col-4 text-right">Llave de dosificacion:</dt>
                <dt class="col-8 text-left"><?php echo $empresa_factura->llave_dosificacion; ?></dt>
                <dt class="col-4 text-right">Leyenda:</dt>
                <dt class="col-8 text-left"><?php echo $empresa_factura->pie; ?></dt>
                <dt class="col-4 text-right">Ley No 453:</dt>
                <dt class="col-8 text-left"><?php echo $empresa_factura->pie_ley453; ?></dt>
            </dl>


        </div>

        <div class="box-body">
            <h4 class="purchase-heading">
                <i class="fa fa-check-circle"></i>
                Historial de Dosificacion
            </h4>

            <div class="row">
                <div class="col-12">

                    <table id="" class="table table-striped table-bordered despliegue" >
                        <thead>
                            <tr>
                                <th>Fecha de Dosificacion</th>
                                <th>No Autorizacion</th>
                                <th>Fecha Limite de Emision</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($historial_dosificacion as $dosi) {?>
                            <tr>
                                <th><?php echo mdate('%d/%m/%Y - %h:%i %a', $dosi->fecha_dosificacion); ?></th>
                                <th><?php echo $dosi->numero_autorizacion_reg; ?></th>
                                <th><?php echo mdate('%d/%m/%Y', $dosi->fecha_limite_emision); ?></th>
                            </tr>
                            <?php }?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>

    </div>


</div>
