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
                                    Editar informacion de contacto de:
                                    <?php echo ' '.$usuario->first_name.' '.$usuario->last_name; ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo form_open('usuarios/procesarInfoContacto/'); ?>


                <!-- Seccion Informacion Contacto -->
                <div class="box-body">
                    <h4 class="purchase-heading">
                        <i class="fa fa-check-circle"></i>
                        Informacion de Contacto
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



                        <div class="col-6">
                            <div class="form-group">
                                <label>Telefono:</label>
                                <input type="text" id="telefono" name="telefono" class="form-control input-lg"
                                       value="<?php echo $usuario->phone; ?>"
                                       placeholder="Numero de telefono"  />
                                <small>Fijo/Celular  ? </small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" id="email" name="email" class="form-control input-lg"
                                       value="<?php echo $usuario->email; ?>"
                                       placeholder="Correo electronico"  />
                                <small>Correo Electronico ? </small>
                            </div>
                        </div>
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





                </div><!-- Fin Seccion Informacion Contacto -->



                <?php echo form_close(); ?>







            </div>






        </div>
    </div>
</div>
