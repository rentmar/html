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
                        <a>Usuarios</a>
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
                    <a href="<?php echo site_url('usuarios/addUsuario'); ?>" class="btn btn-secondary " role="button">
                        Agregar Usuario
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

    <!-- Productos Despliegue -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <table id="" class="table table-striped table-bordered despliegue">
                    <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Compañia</th>
                        <th>Estado</th>
                        <th>Permisos</th>
                        <th>Accion</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo $usuario->username;?></td>
                            <td><?php echo $usuario->first_name;?></td>
                            <td><?php echo $usuario->last_name;?></td>
                            <td><?php echo $usuario->email;?></td>
                            <td><?php echo $usuario->phone;?></td>
                            <td><?php echo $usuario->company;?></td>
                            <td>
                                <?php if($usuario->active): ?>
                                <span class="badge badge-pill badge-success">
                                    Activo
                                </span>
                                <?php else: ?>
                                <span class="badge badge-pill badge-danger">
                                    Inactivo
                                </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                    $usuario_grupos = $this->ion_auth->get_users_groups($usuario->id)->result();
                                ?>
                                <?php foreach ($usuario_grupos as $grupo): ?>
                                    <?php if($grupo->id == 1): ?>
                                        <span class="badge badge-warning">
                                            Administrador
                                        </span>
                                    <?php endif; ?>
                                    <?php if($grupo->id == 2): ?>
                                        <span class="badge badge-info">
                                            Normal
                                        </span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </td>
                            <td>
                                <div class="dropdown dropleft">
                                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
                                        Accion
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?php echo site_url('usuarios/editarInfoPersonal/'.$usuario->id); ?>" data-toogle="modal" data-target="#myModal">
                                            <i class="fas fa-pencil-alt"></i>
                                            Editar Info. Personal
                                        </a>
                                        <a class="dropdown-item" href="<?php echo site_url('usuarios/editarInfoContacto/'.$usuario->id); ?>" data-toogle="modal" data-target="#myModal">
                                            <i class="fas fa-pencil-alt"></i>
                                            Editar Info. Contacto
                                        </a>
                                        <a class="dropdown-item" href="<?php echo site_url('usuarios/editarPermisos/'.$usuario->id); ?>" data-toogle="modal" data-target="#myModal">
                                            <i class="fas fa-pencil-alt"></i>
                                            Editar Permisos
                                        </a>
                                        <a class="dropdown-item" href="<?php echo site_url('usuarios/editarPassword/'.$usuario->id); ?>" data-toogle="modal" data-target="#myModal">
                                            <i class="fas fa-pencil-alt"></i>
                                            Cambiar contraseña
                                        </a>
                                        <a class="dropdown-item" href="<?php echo site_url('usuarios/cambiarEstado/'.$usuario->id); ?>" data-toogle="modal" data-target="#myModal">
                                            <i class="fas fa-toggle-on"></i>
                                            Activar/Desactivar
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