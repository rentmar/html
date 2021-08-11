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
                                    Editar permisos de:
                                    <?php echo ' '.$usuario->first_name.' '.$usuario->last_name; ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo form_open('usuarios/procesarPermisos/'); ?>





                <!-- Seccion Permisos -->
                <div class="box-body">
                    <h4 class="purchase-heading">
                        <i class="fa fa-check-circle"></i>
                        Permisos
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
                                <label>Tipo de Usuario:</label>
                                <select id="tipousuario" name="tipousuario" class="selectpicker show-tick form-control" data-header="Seleccione tipo de usuario" data-width="100%" style="font-size: 16pt;">
                                    <?php if($this->ion_auth->is_admin($usuario->id)): ?>
                                    <option value=2 >Normal</option>
                                    <option value=1 selected >Administrador</option>
                                    <?php else: ?>
                                    <option value=2 selected >Normal</option>
                                    <option value=1 >Administrador</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>


                    <!--    <div class="col-6">
                            <div class="form-group">
                                <label>Empresa a la que pertenece:</label>
                                <select id="empresa" name="empresa" class="selectpicker show-tick form-control" data-header="Seleccione Empresa" data-width="100%" style="font-size: 16pt;">
                                    <?php /*foreach ($empresas as $empresa): */?>
                                        <option value=<?php /*echo $empresa->idempresa; */?>  <?php /*if($empresa->idempresa==$usuario->rel_empresa){ echo "selected"; } */?> >
                                            <?php /*echo $empresa->nombre_empresa; */?>
                                        </option>
                                    <?php /*endforeach; */?>
                                </select>
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
                </div><!-- Fin Seccion Permisos -->

                <?php echo form_close(); ?>







            </div>






        </div>
    </div>
</div>