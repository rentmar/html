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
                        <a>Editar Usuario</a>
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
                                    Editar informacion personal de:
                                    <?php echo ' '.$usuario->first_name.' '.$usuario->last_name; ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo form_open('usuarios/procesarInfoPersonal/'); ?>

                <!-- Seccion Informacion Personal -->
                <div class="box-body">
                    <h4 class="purchase-heading">
                        <i class="fa fa-check-circle"></i>
                        Informacion Personal
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
                                <input type="hidden" id="idusr" name="idusr" class="form-control input-lg"
                                       placeholder="Nombre" required
                                       value="<?php echo base64_encode($usuario->id);?>"  />

                            </div>
                        </div>



                        <div class="col-4">
                            <div class="form-group">
                                <label>Usuario:</label>
                                <input type="text" id="username" name="username" class="form-control input-lg"
                                       placeholder="Alias de usuario (Unico)" required
                                       value="<?php echo $usuario->username; ?>" readonly />
                                <small>Nombre usado para el login  ? </small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" id="nombre" name="nombre" class="form-control input-lg"
                                       placeholder="Nombre" required
                                       value="<?php echo $usuario->first_name; ?>"  />
                                <small>Primer nombre ? </small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Apellido:</label>
                                <input type="text" id="apellido" name="apellido" class="form-control input-lg"
                                       placeholder="Apellido" required
                                       value="<?php echo $usuario->last_name;?>" />
                                <small>Apellido ? </small>
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
                                <a href="<?php echo site_url('usuarios/');?>" class="btn btn-danger" role="button">
                                    <i class="fas fa-ban"></i>
                                    Cancelar
                                </a>

                            </div>
                        </div>
                    </div>
                </div><!-- Fin Seccion Informacion Personal -->




                <?php echo form_close(); ?>







            </div>






        </div>
    </div>
</div>
