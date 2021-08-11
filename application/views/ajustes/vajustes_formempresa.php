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
                    <li  class="breadcrumb-item">
                        <a href="<?php echo site_url('ajustes');?>" >
                            ajustes
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a>crearEmpresa</a>
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
                                    Agregar Nueva Empresa
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo form_open('ajustes/empresaProcesar/'); ?>

                <!-- Seccion Informacion Personal -->
                <div class="box-body">
                    <h4 class="purchase-heading">
                        <i class="fa fa-check-circle"></i>
                        Informacion General
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
                                <label>Usuario:</label>
                                <input type="text" id="nit" name="nit" class="form-control input-lg"
                                       placeholder="NIT" required  />
                                <small>NIT de la empresa  ? </small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" id="nombreempresa" name="nombreempresa" class="form-control input-lg"
                                       placeholder="Nombre" required  />
                                <small>Nombre de la Empresa ? </small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Razon Social:</label>
                                <input type="text" id="rsocial" name="rsocial" class="form-control input-lg"
                                       placeholder="Razon Social" required />
                                <small>Razon Social ? </small>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Actividad</label>
                                <input type="text" id="actividad" name="actividad" class="form-control input-lg"
                                       placeholder="Actividad de la empresa" required />
                            </div>
                        </div>



                    </div>
                </div><!-- Fin Seccion Informacion Personal -->

                <!-- Seccion Informacion Contacto -->
                <div class="box-body">
                    <h4 class="purchase-heading">
                        <i class="fa fa-check-circle"></i>
                        Informacion de Contacto
                    </h4>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Direccion:</label>
                                <input type="text" id="direccion" name="direccion" class="form-control input-lg"
                                       placeholder="Direccion"  />
                                <small>Direccion  ? </small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Telefono:</label>
                                <input type="text" id="telefono" name="telefono" class="form-control input-lg"
                                       placeholder=""  />
                                <small>Telefono ? </small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Celular:</label>
                                <input type="text" id="telefonomov" name="telefonomov" class="form-control input-lg"
                                       placeholder=""  />
                                <small>Celular ? </small>
                            </div>
                        </div>
                    </div>
                </div><!-- Fin Seccion Informacion Contacto -->

                <!-- Seccion Permisos -->
                <div class="box-body">


                    <div class="row">
                        <div class="col-12 d-flex justify-content-end ">
                            <div class="form-group">

                                <button type="submit" class="btn btn-primary">
                                    <i class="far fa-save"></i>
                                    Guardar
                                </button>
                                <a href="<?php echo site_url('ajustes/');?>" class="btn btn-danger" role="button">
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
