 <?php
        $precioTotal = 0;
        $cantidadTotal = 0;
        $descuento_total = $this->session->descuento_total;
        foreach ($carrito as $indice => $producto) {
            $precioTotal = $precioTotal + $producto->total;
            $cantidadTotal = $cantidadTotal + $producto->cantidad;
        }
        foreach ($cliente as $key => $valor) {
            $idcliente = $valor['idcliente'];
            $nt = $valor['nit'];
            $rs = $valor['razonSocial'];
        }
        $descuento_calculado = round(($descuento_total/100)*$precioTotal, 0, PHP_ROUND_HALF_UP);
 ?>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
      <a class="navbar-brand" href="#">
          <i class="far fa-file-alt"></i>
          Emision de Facturas
      </a>
    <!-- Links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('puntoVenta'); ?>">
                <i class="fas fa-window-close"></i>
                Cancelar
            </a>
        </li>
    </ul>
</nav>

<section id="venfacturas">
    <div class="container">
        <div class="row">
            <div class="col-12 alert-primary text-center">
                <h2>Emision de Facturas</h2>
            </div>
            
            <div class="col-12">
                
                <?php
                    $atvf = [
                        'id'=>'formvenfactura',
                    ];
                echo form_open('puntoVenta/venFacturas/', $atvf); ?>
                    <!-- Fecha de emision -->
                    <div class="form-group row">
                        <label class="col-3" for="fecha">Fecha de Emision:</label>
                        <div class="col-9 input-group date" id="fechaVenFactura">
                            <input type="text" class="form-control" required
                                id="fecha" name="fecha" onkeydown="return noContenido(event);">
                            <span class="input-group-addon alert-secondary">
                                <span>
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-3" for="numerofactura">Numero de Factura:</label>
                            <div class="col-3">
                                <input type="number" class="form-control" required
                                       onkeydown="return noContenido(event);"
                                       id="numerofactura" name="numerofactura" 
                                       min="1"
                                       value="<?php echo $datos_facturacion->numero_actual_factura; ?>">
                            </div>
                        <label class="col-3 " for="ultimonumerofactura">Ultimo Numero Emitido:</label>
                        <div class="col-3">
                            <?php if($datos_facturacion->numero_ultimo_factura != 0): ?>
                            <input type="number" class="form-control " required readonly
                                   onkeydown="return noContenido(event);"
                                   id="ultimonumerofactura" name="ultimonumerofactura" 
                                   value="<?php echo $datos_facturacion->numero_ultimo_factura; ?>">
                            <?php else: ?>
                            <input type="text" class="form-control " required readonly
                                   onkeydown="return noContenido(event);"                           
                                   value="Sin Facturacion">
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="form-group row" >
                        <div class="col-12">
                            <input type="hidden" class="form-control" id="identificador" name="identificador" required
                                   value="<?php

                                   if(isset($idcliente))
                                                  {

                                                     echo base64_encode($idcliente); 
                                                  }

                                   ?>"

                                   >
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-3" for="nit">NIT:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="nit" name="nit" required readonly
                                    value="<?php 
                                                  if(isset($nt))
                                                  {

                                                     echo $nt; 
                                                  }?>">                                            
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-3" for="razonsocial">Razon Social:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="razonsocial" name="razonsocial" required readonly
                                   value="<?php
                                                  if(isset($rs)){echo $rs;}                                       
                                             ?>"
                                   >                                            
                        </div>                                        
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-3" for="montototal">Monto Total:</label>
                        <div class="col-9">
                            <input type="number" class="form-control" 
                                   id="montototal" name="montototal" required min="1" readonly
                                   value="<?php
                                                  if(isset($precioTotal)){echo $precioTotal;}
                                             ?>"
                                   >                                            
                        </div>                                        
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-3" for="descuentototal">Descuento:</label>
                        <div class="col-9">
                            <input type="number" class="form-control"
                                   id="descuentototal" name="descuentototal" required min="0" readonly
                                   value="<?php
                                          if(isset($descuento_total)){ echo $descuento_total;}
                                   ?>" > 
                        </div>
                    </div>
          
                    <div class="form-group row alert-info">
                        <label class="col-3" for="ventatotal">Total Venta:</label>
                        <div class="col-9">
                            <input type="number" class="form-control"
                                   id="ventatotal" name="ventatotal" required min="0" readonly
                                   value="<?php
                                          if(isset($precioTotal))
                                          { 
                                              echo ($precioTotal)-$descuento_calculado;

                                          }
                                   ?>" > 
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Procesar</button>
                        </div>                  
                     </div>
                    
                    <div class="form-group row">
                        <div class="col-12">
                            <a href="<?php echo site_url('puntoVenta/'); ?>" class="btn btn-danger btn-block">
                                Cancelar
                            </a>
                        </div>
                    </div>
                    
                    
                <?php echo form_close(); ?>
            </div>
            
            
            
            
            
        </div>
    </div>
</section>

