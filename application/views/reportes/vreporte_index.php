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
                        <a>Reportes</a>
                    </li>
                </ol>
            </div>
            <!-- End Breadcrumb -->
        </div>
    </div>
    <!-- Productos Despliegue -->
    <div class="container-fluid">
        <h1>
            REPORTES
        </h1>
    </div>
    <div class="container-fluid" >
        <div class="row">
            <div class="col-12 d-flex" >
                <div class="ml-auto">
                    <a href="<?php echo site_url('reportes/generarReporte'); ?>" class="btn btn-secondary " role="button">
                        <i class="fas fa-file-image"></i>
                        Generar Reporte Facturas
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Linea Divisora -->
    <div class="container-fluid">
        <hr style="height:3px;border:none;color:#333;background-color:#333;" >
    </div>
    <!-- Modal busqueda para la editar producto -->
    <div class="modal fade" id="modaleditproducto">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Buscar producto para editar</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <?php
                    echo form_open('reportes/generar');
                    ?>
                    <div>
                        <label>Producto:</label>
                        <input type="text" id="busca_producto_editar" name="busca_producto_editar" value="" class="form-control input-lg" placeholder="" required=""  />
                        <small>Producto para editar</small>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i>Buscar Producto</button>
                        <?php echo form_close(); //Cierre del formulario ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
