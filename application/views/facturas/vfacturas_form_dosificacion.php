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
                        <a href="<?php echo site_url('Facturas/');?>">
                            Facturas
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a>Actualizar Dosificacion</a>
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
                                    Actualizar los Datos de Facturacion de:
                                    <?php echo $empresa_factura->nombre_empresa;?>,
                                    NIT:
                                    <?php echo $empresa_factura->nit; ?>.
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo form_open('Facturas/procesarDosificacion/'); ?>


                <!-- Seccion Informacion Personal -->
                <div class="box-body">
                    <h4 class="purchase-heading">
                        <i class="fa fa-check-circle"></i>
                        Dosificacion
                    </h4>

                    <div class="row">

                        <?php  if(validation_errors()): ?>
                            <div class="col-12">
                                <div class="alert alert-warning">
                                    <?php echo validation_errors(); ?>
                                </div>
                            </div>
                        <?php  endif; ?>


                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" id="iddosificacion" name="iddosificacion" class="form-control input-lg"
                                       placeholder="Nombre" required
                                       value="<?php echo base64_encode($empresa_factura->rel_datos_factura); ?>"  />

                            </div>
                        </div>



                        <div class="col-6">
                            <div class="form-group">
                                <label>Numero de Autorizacion:</label>
                                <input type="text" id="numautorizacion" name="numautorizacion" class="form-control input-lg"
                                        required
                                       value="<?php echo ""; ?>"  />
                                <small>Numero de autorizacion   </small>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Confirmar Numero de Autorizacion:</label>
                                <input type="text" id="numautorizacionc" name="numautorizacionc" class="form-control input-lg"
                                        required
                                       value="<?php echo ""; ?>"  />
                                <small>Confirmar Numero de autorizacion  </small>
                            </div>
                        </div>

                        <!-- Linea Divisora -->
                        <div class="container-fluid">
                            <hr style="height:3px;border:none;color:#333;background-color:#333;" >
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Numero inicial de la factura:</label>
                                <input type="number" id="numerofactura" name="numerofactura" class="form-control input-lg"
                                       placeholder="" required min="1" onkeypress="return noContenido(event);"
                                       value="1" />
                                <small></small>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Confirmar Numero inicial de la factura:</label>
                                <input type="number" id="numerofacturac" name="numerofacturac" class="form-control input-lg"
                                       placeholder="" required min="1" onkeypress="return noContenido(event);"
                                       value="1" />
                                <small> </small>
                            </div>
                        </div>

                        <!-- Linea Divisora -->
                        <div class="container-fluid">
                            <hr style="height:3px;border:none;color:#333;background-color:#333;" >
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Fecha Limite de Emision:</label>
                                <input type="date" id="fechaemision" name="fechaemision" class="form-control input-lg"
                                       placeholder="" required min="1" onkeypress="return noContenido(event);"
                                       value="" />
                                <small></small>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Confirmar Fecha Limite de Emision::</label>
                                <input type="date" id="fechaemisionc" name="fechaemisionc" class="form-control input-lg"
                                       placeholder="" required min="1" onkeypress="return noContenido(event);"
                                       value="" />
                                <small> </small>
                            </div>
                        </div>

                        <!-- Linea Divisora -->
                        <div class="container-fluid">
                            <hr style="height:3px;border:none;color:#333;background-color:#333;" >
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Llave de Dosificacion:</label>
                                <input type="text" id="llavedosificacion" name="llavedosificacion" class="form-control input-lg"
                                       placeholder=""
                                       value="" />
                                <small></small>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Confirmar Llave de Dosificacion:</label>
                                <input type="text" id="llavedosificacionc" name="llavedosificacionc" class="form-control input-lg"
                                       placeholder=""
                                       value="" />
                                <small> </small>
                            </div>
                        </div>

                        <!-- Linea Divisora -->
                        <div class="container-fluid">
                            <hr style="height:3px;border:none;color:#333;background-color:#333;" >
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Leyenda del Pie de Pagina:</label>
                                <textarea class="form-control" rows="4" required
                                          id="leyendaPiePagina" name="leyendaPiePagina">
                                </textarea>
                                <small>Pie de pagina </small>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Leyenda del Pie de Pagina Ley 453:</label>
                                <textarea class="form-control" rows="4" required
                                          id="leyendaPiePaginaL453" name="leyendaPiePaginaL453">
                                </textarea>
                                <small>Pie de pagina Ley 453  </small>
                            </div>
                        </div>











                        <!--<div class="col-6">
                            <div class="form-group">
                                <label>Password:</label>
                                <input type="password" id="passwd" name="passwd" class="form-control input-lg"
                                       placeholder="" required />
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Confirmar Password:</label>
                                <input type="password" id="passwdc" name="passwdc" class="form-control input-lg"
                                       placeholder="" required />
                            </div>
                        </div>-->

                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end ">
                            <div class="form-group">

                                <button type="submit" class="btn btn-primary">
                                    <i class="far fa-save"></i>
                                    Guardar
                                </button>
                                <a href="<?php echo site_url('facturas/');?>" class="btn btn-danger" role="button">
                                    <i class="fas fa-ban"></i>
                                    Cancelar
                                </a>

                            </div>
                        </div>
                    </div>
                </div><!-- Fin Seccion Informacion Personal -->









                <?php echo form_close(); ?>


            </div><!-- Fin container-fluid -->





        </div>
    </div>
</div>
