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
                        <a>Clientes-Proveedores</a>
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
                    <a href="<?php echo site_url('clientes/addCliente'); ?>" class="btn btn-secondary " role="button">
                        Agregar Cliente/Proveedor
                    </a>
                    <a href="#" class="btn btn-secondary " role="button">
                        Imprimir
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
        <div class="row">
            <div class="col-12">

                <table id="" class="table table-striped table-bordered despliegue">
                    <thead>
                    <tr>
                        <th>NIT</th>
                        <th>Razon Social</th>
                        <th>Telefono</th>
                        <th>Tipo</th>
                        <th>Accion</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($lista_clientes as $cliente): ?>
                        <tr>
                            <td><?php echo $cliente->nit;?></td>
                            <td><?php echo $cliente->razon_social;?></td>
                            <td><?php echo $cliente->telefono; ?></td>
                            <td>
                                <?php if($cliente->es_cliente): ?>
                                <span class="badge badge-pill badge-info">Cliente</span>
                                <?php endif; ?>
                                <?php if($cliente->es_proveedor): ?>
                                <span class="badge badge-pill badge-warning">Proveedor</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
                                        Accion
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?php echo site_url('clientes/editarCliente/'.$cliente->idclipro); ?>" data-toogle="modal" data-target="#myModal">
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

</div>

