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
                        <a>Ajustes Generales</a>
                    </li>

                </ol>
            </div>
            <!-- End Breadcrumb -->
        </div>
    </div>

    <div class="container-fluid" >
        <div class="row">
            <div class="col-12 d-flex" >
                <div class="ml-auto">
                    <a href="<?php echo site_url('ajustes/crearEmpresa'); ?>" class="btn btn-secondary " role="button">
                        Nueva Empresa
                    </a>

                </div>
            </div>
        </div>
    </div>

    <!-- Linea Divisora -->
    <div class="container-fluid">
        <hr style="height:3px;border:none;color:#333;background-color:#333;" >
    </div>

    <!-- Empresa Despliegue -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <table id="" class="table table-striped table-bordered despliegue">
                    <thead>
                    <tr>
                        <th>NIT</th>
                        <th>Empresa</th>
                        <th>Razon Social</th>
                        <th>Accion</th>

                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($empresas as $empresa): ?>
                        <tr>
                            <td><?php echo $empresa->nit; ?></td>
                            <td><?php echo $empresa->nombre_empresa; ?></td>
                            <td><?php echo $empresa->razon_social; ?></td>

                            <td>
                                <div class="dropdown dropleft">
                                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
                                        Accion
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?php echo site_url('ajustes/editarEmpresa/'.$empresa->idempresa); ?>" data-toogle="modal" data-target="#myModal">
                                            <i class="fas fa-pencil-alt"></i>
                                            Editar
                                        </a>

                                    </div>
                                </div>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>
    <!-- Fin Empresa Despliegue -->


</div>
