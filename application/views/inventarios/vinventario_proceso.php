<div id="content-wrapper">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo site_url('/');?>">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a>Inventario/<?php echo $almacen->nombre_almacen;?>/Iniciar Inventario</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <div class="container-fluid" >
        <div class="row">
            <div class="col-12 d-flex" >
                <div class="ml-auto">
                    <a href="#" class="btn btn-secondary " role="button">
                        Opcion
                    </a>
                    <a href="<?php echo site_url(''); ?>" class="btn btn-secondary " role="button">
                        Cancelar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Linea Divisora -->
    <div class="container-fluid">
        <hr style="height:3px;border:none;color:#333;background-color:#333;" >
    </div>

    <div class="container-fluid">
        <div class="box-body">
            <h4 class="purchase-heading">
                <i class="fa fa-check-circle"></i>
                Conteo de Productos
            </h4>
            <div class="row">
                <div class="col-4">

                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5>CLASE A</h5>
                        </div>
                        <div class="card-body">
                            Contenido
                        </div>
                        <div class="card-footer bg-primary text-white">
                            Notas
                        </div>
                    </div>

                </div>

                <div class="col-4">

                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5>CLASE B</h5>
                        </div>
                        <div class="card-body">
                            Contenido
                        </div>
                        <div class="card-footer bg-primary text-white ">
                            Notas
                        </div>
                    </div>

                </div>

                <div class="col-4">

                    <div class="card">
                        <div class="card-header bg-primary text-white ">
                            <h5>CLASE C</h5>
                        </div>
                        <div class="card-body">
                            Contenido
                        </div>
                        <div class="card-footer bg-primary text-white ">
                            Notas
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>




</div>