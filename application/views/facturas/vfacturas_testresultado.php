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
                        <a href="<?php echo site_url('facturas/');?>" >Facturas</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a>Test de Facturas</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a>Test de Facturas Resultado</a>
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
                                    <i class="far fa-file-alt"></i>
                                    Resultado de la Prueba
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seccion Informacion Personal -->
                <div class="box-body">
                    <h4 class="purchase-heading">
                        <i class="fa fa-check-circle"></i>
                        Codigo de Control Calculado
                    </h4>

                    <div class="row">

                        <div class="col-12">

                            <dl class="row">
                                <dt class="col-sm-5">Numero de autorizacion</dt>
                                <dd class="col-sm-7"><?php echo $info['numero_autorizacion'];?></dd>
                                <dt class="col-sm-5">Numero de factura</dt>
                                <dd class="col-sm-7"><?php echo $info['numero_factura'];?></dd>
                                <dt class="col-sm-5">NIT Cliente</dt>
                                <dd class="col-sm-7"><?php echo $info['nit_cliente'];  ?></dd>
                                <dt class="col-sm-5">Fecha de Transaccion</dt>
                                <dd class="col-sm-7"><?php echo $info['fecha_transaccion'];  ?></dd>
                                <dt class="col-sm-5">Monto de Transaccion</dt>
                                <dd class="col-sm-7"><?php echo $info['monto_transaccion'];  ?></dd>
                                <dt class="col-sm-5">Llave de dosificacion</dt>
                                <dd class="col-sm-7"><?php echo $info['llave_dosificacion']; ?></dd>
                            </dl>

                            <p>
                                <strong>CODIGO DE CONTROL: </strong>
                                <?php echo $cod_control; ?>

                            </p>

                        </div>





                    </div>
                </div><!-- Fin Seccion Informacion Personal -->




                <!-- Seccion Permisos -->
                <div class="box-body">



                    <div class="row">
                        <div class="col-12 d-flex justify-content-end ">
                            <div class="form-group">


                                <a href="<?php echo site_url('facturas/testFacturas');?>" class="btn btn-primary" role="button">
                                    <i class="far fa-clipboard"></i>
                                    Continuar
                                </a>
                                <a href="<?php echo site_url('/');?>" class="btn btn-danger" role="button">
                                    <i class="fas fa-ban"></i>
                                    Salir
                                </a>

                            </div>
                        </div>
                    </div>
                </div><!-- Fin Seccion Permisos -->






            </div>






        </div>
    </div>
</div>