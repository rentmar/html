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
                    <li class="breadcrumb-item active">
                        <a>Test de Facturas</a>
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
                                    Prueba de facturas
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo form_open('facturas/procesarTest/'); ?>

                <!-- Seccion Informacion Personal -->
                <div class="box-body">
                    <h4 class="purchase-heading">
                        <i class="fa fa-check-circle"></i>
                        Datos
                    </h4>

                    <div class="row">

                        <?php  if(validation_errors()): ?>
                            <div class="col-12">
                                <div class="alert alert-warning">
                                    <?php echo validation_errors(); ?>
                                </div>
                            </div>
                        <?php  endif; ?>



                        <div class="col-4">
                            <div class="form-group">
                                <label>Numero Autorizacion:</label>
                                <input type="text" id="numautorizacion" name="numautorizacion" class="form-control input-lg"
                                       placeholder="Numero Autorizacion" required  />
                                <small>Numero de autorizacion  ? </small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Numero de Factura:</label>
                                <input type="text" id="numfactura" name="numfactura" class="form-control input-lg"
                                       placeholder="" required  />
                                <small>Numero de factura ? </small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>NIT/CI:</label>
                                <input type="text" id="nitcliente" name="nitcliente" class="form-control input-lg"
                                       placeholder="" required />
                                <small>NIT o CI del Cliente ? </small>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Fecha de la transaccion(AAAAMMDD):</label>
                                <input type="text" id="fechatransaccion" name="fechatransaccion" class="form-control input-lg"
                                       placeholder="" required />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Monto Transaccion:</label>
                                <input type="text" id="montotransaccion" name="montotransaccion" class="form-control input-lg"
                                       placeholder="" required />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Llave Dosificacion:</label>
                                <input type="text" id="llavedosificacion" name="llavedosificacion" class="form-control input-lg"
                                       placeholder="" required />
                            </div>
                        </div>


                    </div>
                </div><!-- Fin Seccion Informacion Personal -->



                <!-- Seccion Permisos -->
                <div class="box-body">



                    <div class="row">
                        <div class="col-12 d-flex justify-content-end ">
                            <div class="form-group">

                                <button type="submit" class="btn btn-primary">
                                    <i class="far fa-save"></i>
                                    Procesar
                                </button>
                                <a href="<?php echo site_url('usuarios/');?>" class="btn btn-danger" role="button">
                                    <i class="fas fa-ban"></i>
                                    Cancelar
                                </a>

                            </div>
                        </div>
                    </div>
                </div><!-- Fin Seccion Permisos -->

                <?php echo form_close(); ?>







            </div>






        </div>
    </div>
</div>

