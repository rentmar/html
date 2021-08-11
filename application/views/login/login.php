<!DOCTYPE html>
<html lang="es">
    <head>
        <title>.:Registro:.</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login.css">
    </head>
    <body class="text-center">
                
        <?php
        //Apertura del formulario
        $atribs = [
            'class' => 'formulario',
        ];
        echo form_open('login/validar',$atribs); 
        ?>
            <?php
                $prop_img = [
                    'src' => 'assets/img/logo/logo.jpg',
                    'alt' => 'logo',
                    'class' => 'img-fluid rounded',
                ];
                echo img($prop_img);
            ?>
            <h1>Sistema de Ventas</h1>
            
            <!-- Usuario -->
            <?php
                $l1 = ['class'=>'sr-only',];
                echo form_label('Usuario', 'inputUsr', $l1);
                echo set_value('text');
            ?>
            <input type="text" id="inputUsr" name="usuario" class="form-control" placeholder="Usuario" required autofocus>
            
            <!-- Password -->
            <?php
                $l2 = ['class'=>'sr-only',];
                echo form_label('Password', 'inputPassword', $l1);
                echo set_value('text');
            ?>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
            
            <!-- Submit -->
            <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar</button> 
            
            <!-- Mensaje de error -->
            <?php if(!empty($this->session->flashdata())): ?>
            <div id="mensaje-loggin" class="bg-warning">
                <div class="alert alert-warning">
                    <?php echo $this->session->flashdata('log_mensaje') ?>
                </div>
            </div>
            <?php endif; ?>
        
        <?php echo form_close(); //Cierre del formulario ?>
            
            
            
            
  
        
    <!-- Java Script -->    
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>    
    </body>
</html>

