<div id="content-wrapper" >
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
                        <a href="<?php echo site_url('clientes/');?>">
                            Clientes-Proveedores
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a>Editar Cliente-Proveedor</a>
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
                                    Editar Cliente-Proveedor
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="box-body">
                    <h4 class="purchase-heading">
                        <i class="fa fa-check-circle"></i>
                        Informacion General
                    </h4>
                </div>

                <div class="box-body">
                    <?php echo form_open('clientes/procesarEdicion/');?>
                    <div class="form-group row">
                        <?php if(validation_errors()): ?>
                            <div class="col-12">
                                <div class="alert alert-warning">
                                    <?php echo validation_errors(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <input type="hidden" id="identificador" name="identificador" type="text"
                                   value="<?php echo base64_encode($cliente->idclipro);?>" >

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12">
                            <?php if($cliente->es_cliente == 1 && $cliente->es_proveedor == 0 ): ?>
                            <input value=1 type="radio" class="mr-1" name="tipo" checked >Cliente
                            <input value=2 type="radio" class="mr-1" name="tipo"  >Proveedor
                            <input value=3 type="radio" class="mr-1" name="tipo"  >Cliente/Proveedor
                            <?php elseif($cliente->es_cliente == 0 && $cliente->es_proveedor == 1): ?>
                            <input value=1 type="radio" class="mr-1" name="tipo"  >Cliente
                            <input value=2 type="radio" class="mr-1" name="tipo" checked >Proveedor
                            <input value=3 type="radio" class="mr-1" name="tipo"  >Cliente/Proveedor
                            <?php elseif($cliente->es_cliente == 1 && $cliente->es_proveedor == 1): ?>
                            <input value=1 type="radio" class="mr-1" name="tipo"  >Cliente
                            <input value=2 type="radio" class="mr-1" name="tipo"  >Proveedor
                            <input value=3 type="radio" class="mr-1" name="tipo" checked >Cliente/Proveedor
                            <?php endif; ?>

                        </label>
                    </div>
                    <div class="form-group row">
                        <label for="nit" class="col-2 col-form-label">NIT</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="nit" name="nit" required readonly
                                   placeholder="Numero de NIT" value="<?php echo $cliente->nit; ?>" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rsocial" class="col-2 col-form-label">Razon Social:</label>
                        <div class="col-10">
                            <input type="text"  class="form-control"   id="rsocial" name="rsocial" required
                                   value="<?php echo $cliente->razon_social;?>"
                                   placeholder="Nombre del cliente-proveedor" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rsocial" class="col-2 col-form-label">Telefono:</label>
                        <div class="col-10">
                            <input type="text"  class="form-control"   id="telefono" name="telefono"
                                   value="<?php echo $cliente->telefono; ?>"
                                   placeholder="Telefono" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="far fa-save"></i>
                                Guardar
                            </button>
                            <a href="<?php echo site_url('clientes');?>" class="btn btn-danger" role="button">
                                <i class="fas fa-ban"></i>
                                Cancelar
                            </a>
                        </div>
                    </div>


                    </form>

                </div>




            </div>

        </div>
    </div>

</div>
