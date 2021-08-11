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
                        <a>addUsuario</a>
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
                                   Agregar Nuevo Usuario
                               </h3>
                           </div>
                       </div>
                   </div>
               </div>

               <?php echo form_open('usuarios/procesarNuevoUsuario/'); ?>

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



                       <div class="col-4">
                           <div class="form-group">
                               <label>Usuario:</label>
                               <input type="text" id="username" name="username" class="form-control input-lg"
                                      placeholder="Alias de usuario (Unico)" required  />
                               <small>Nombre usado para el login  ? </small>
                           </div>
                       </div>
                       <div class="col-4">
                           <div class="form-group">
                               <label>Nombre:</label>
                               <input type="text" id="nombre" name="nombre" class="form-control input-lg"
                                      placeholder="Nombre" required  />
                               <small>Primer nombre ? </small>
                           </div>
                       </div>
                       <div class="col-4">
                           <div class="form-group">
                               <label>Apellido:</label>
                               <input type="text" id="apellido" name="apellido" class="form-control input-lg"
                                      placeholder="Apellido" required />
                               <small>Apellido ? </small>
                           </div>
                       </div>

                       <div class="col-6">
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
                               <label>Telefono:</label>
                               <input type="text" id="telefono" name="telefono" class="form-control input-lg"
                                      placeholder="Numero de telefono"  />
                               <small>Fijo/Celular  ? </small>
                           </div>
                       </div>
                       <div class="col-6">
                           <div class="form-group">
                               <label>Email:</label>
                               <input type="email" id="email" name="email" class="form-control input-lg"
                                      placeholder="Correo electronico"  />
                               <small>Correo Electronico ? </small>
                           </div>
                       </div>
                   </div>
               </div><!-- Fin Seccion Informacion Contacto -->

               <!-- Seccion Permisos -->
               <div class="box-body">
                   <h4 class="purchase-heading">
                       <i class="fa fa-check-circle"></i>
                       Permisos
                   </h4>

                   <div class="row">

                       <div class="col-6">
                           <div class="form-group">
                               <label>Tipo de Usuario:</label>
                               <select id="tipousuario" name="tipousuario" class="selectpicker show-tick form-control" data-header="Seleccione tipo de usuario" data-width="100%" style="font-size: 16pt;">
                                   <option value=2 >Normal</option>
                                   <option value=1 >Administrador</option>
                               </select>
                           </div>
                       </div>


                       <div class="col-6">
                           <div class="form-group">
                               <label>Empresa a la que pertenece:</label>
                               <select id="empresa" name="empresa" class="selectpicker show-tick form-control" data-header="Seleccione Empresa" data-width="100%" style="font-size: 16pt;">
                                   <?php foreach ($empresas as $empresa): ?>
                                   <option value=<?php echo $empresa->idempresa; ?> ><?php echo $empresa->nombre_empresa; ?></option>
                                   <?php endforeach; ?>
                               </select>
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
               </div><!-- Fin Seccion Permisos -->

               <?php echo form_close(); ?>







           </div>






        </div>
    </div>
</div>