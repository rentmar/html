<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
      <a class="navbar-brand" href="#">
          <i class="far fa-file-alt"></i>
          Recibo
      </a>
    <!-- Links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url().'/comprobantes/recibo/'.$idVenta; ?>" target="_blank">
                <i class="fas fa-file-pdf"></i>
                PDF
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url().'/puntoVenta'; ?>">
                <i class="fas fa-sign-out-alt"></i>
                Continuar
            </a>
        </li>
    </ul>
</nav>


<div class="receipt-content">
    <div class="container bootstrap snippet">
		<div class="row">
			<div class="col-md-12">
				<div class="invoice-wrapper">
					<div class="intro">
						<strong></strong>, 
						<br>
						Recibo por el pago de: 
                                                <strong>
                                                    <?php echo $regVenta->total-$regVenta->saldo; ?>                                                    
                                                </strong> [Bs]
					</div>

					<div class="payment-info">
						<div class="row">
							<div class="col-sm-6">
								<span>Recibo No.</span>
								<strong> </strong>
							</div>
							<div class="col-sm-6 text-right">
								<span>Fecha</span>
								<strong> </strong>
							</div>
						</div>
					</div>

					<div class="payment-details">
						<div class="row">
							<div class="col-sm-6">
								<span></span>
								<strong>
									<?php echo $casaMatriz->razon_social; ?>
								</strong>
								<p>
									<?php echo ' '.$casaMatriz->direccion;?> <br>
									<?php echo ' '.$casaMatriz->telefono;?> <br>
									La Paz - Bolivia
								</p>
							</div>
							<div class="col-sm-6 text-right">
								<span>Recibido de: </span>
								<strong>
									<?php echo ' '.$regVenta->razon_social; ?>
								</strong>
								<p>
                                                                    NIT:
                                                                    <?php echo ' '.$regVenta->nit; ?>
									
								</p>
							</div>
						</div>
					</div>

					<div class="line-items">
						<div class="headers clearfix">
							<div class="row">
								<div class="col-4">Descripcion</div>
								<div class="col-3">Cantidad</div>
								<div class="col-5 text-right">Monto</div>
							</div>
						</div>
						<div class="items">
                                                        <?php foreach ($detalleVenta as $v) {?>
							<div class="row item">
								<div class="col-4 desc">
									<?php echo $v->descripcion; ?>
								</div>
								<div class="col-3 qty">
									<?php echo $v->cantidad;?>
								</div>
								<div class="col-5 amount text-right">
									<?php echo $v->total;?>
								</div>
							</div>
							<?php } ?>                                                     
						</div>
                                            
						<div class="total text-right">
							<p class="extra-notes">
								<strong>Notas</strong>
								
							</p>
							<div class="field">
								Total [Bs]
                                                                <span>
                                                                    <?php echo $regVenta->total; ?>
                                                                </span>
							</div>
                                                        <div class="field">
                                                            Descuento de <?php echo ' '.$regVenta->descuento_total.'%';?> [Bs]
                                                                <span>
                                                                    <?php echo $regVenta->total*($regVenta->descuento_total/100); ?>
                                                                </span>
							</div>
                                                        <div class="field">
								Total - Descuento [Bs]
                                                                <span class="alert-info">
                                                                    <?php echo $regVenta->total-$regVenta->total*($regVenta->descuento_total/100); ?>
                                                                </span>
							</div>
							<div class="field">
								A cuenta 
                                                                <span>
                                                                    <?php echo $regVenta->total-$regVenta->total*($regVenta->descuento_total/100)-$regVenta->saldo; ?>
                                                                </span>
							</div>
							
							<div class="field grand-total">
								Saldo[Bs] 
                                                                <span>
                                                                    <?php echo $regVenta->saldo; ?>
                                                                </span>
							</div>
						</div>

					</div>
				</div>

				
			</div>
		</div>
	</div>
</div>  

<style>
    .receipt-content .logo a:hover {
  text-decoration: none;
  color: #7793C4; 
}

.receipt-content .invoice-wrapper {
  background: #FFF;
  border: 1px solid #CDD3E2;
  box-shadow: 0px 0px 1px #CCC;
  padding: 40px 40px 60px;
  margin-top: 40px;
  border-radius: 4px; 
}

.receipt-content .invoice-wrapper .payment-details span {
  color: #A9B0BB;
  display: block; 
}
.receipt-content .invoice-wrapper .payment-details a {
  display: inline-block;
  margin-top: 5px; 
}

.receipt-content .invoice-wrapper .line-items .print a {
  display: inline-block;
  border: 1px solid #9CB5D6;
  padding: 13px 13px;
  border-radius: 5px;
  color: #708DC0;
  font-size: 13px;
  -webkit-transition: all 0.2s linear;
  -moz-transition: all 0.2s linear;
  -ms-transition: all 0.2s linear;
  -o-transition: all 0.2s linear;
  transition: all 0.2s linear; 
}

.receipt-content .invoice-wrapper .line-items .print a:hover {
  text-decoration: none;
  border-color: #333;
  color: #333; 
}

.receipt-content {
  background: #ECEEF4; 
}
@media (min-width: 1200px) {
  .receipt-content .container {width: 900px; } 
}

.receipt-content .logo {
  text-align: center;
  margin-top: 50px; 
}

.receipt-content .logo a {
  font-family: Myriad Pro, Lato, Helvetica Neue, Arial;
  font-size: 36px;
  letter-spacing: .1px;
  color: #555;
  font-weight: 300;
  -webkit-transition: all 0.2s linear;
  -moz-transition: all 0.2s linear;
  -ms-transition: all 0.2s linear;
  -o-transition: all 0.2s linear;
  transition: all 0.2s linear; 
}

.receipt-content .invoice-wrapper .intro {
  line-height: 25px;
  color: #444; 
}

.receipt-content .invoice-wrapper .payment-info {
  margin-top: 25px;
  padding-top: 15px; 
}

.receipt-content .invoice-wrapper .payment-info span {
  color: #A9B0BB; 
}

.receipt-content .invoice-wrapper .payment-info strong {
  display: block;
  color: #444;
  margin-top: 3px; 
}

@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .payment-info .text-right {
  text-align: left;
  margin-top: 20px; } 
}
.receipt-content .invoice-wrapper .payment-details {
  border-top: 2px solid #EBECEE;
  margin-top: 30px;
  padding-top: 20px;
  line-height: 22px; 
}


@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .payment-details .text-right {
  text-align: left;
  margin-top: 20px; } 
}
.receipt-content .invoice-wrapper .line-items {
  margin-top: 40px; 
}
.receipt-content .invoice-wrapper .line-items .headers {
  color: #A9B0BB;
  font-size: 13px;
  letter-spacing: .3px;
  border-bottom: 2px solid #EBECEE;
  padding-bottom: 4px; 
}
.receipt-content .invoice-wrapper .line-items .items {
  margin-top: 8px;
  border-bottom: 2px solid #EBECEE;
  padding-bottom: 8px; 
}
.receipt-content .invoice-wrapper .line-items .items .item {
  padding: 10px 0;
  color: #696969;
  font-size: 15px; 
}
@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .line-items .items .item {
  font-size: 13px; } 
}
.receipt-content .invoice-wrapper .line-items .items .item .amount {
  letter-spacing: 0.1px;
  color: #84868A;
  font-size: 16px;
 }
@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .line-items .items .item .amount {
  font-size: 13px; } 
}

.receipt-content .invoice-wrapper .line-items .total {
  margin-top: 30px; 
}

.receipt-content .invoice-wrapper .line-items .total .extra-notes {
  float: left;
  width: 40%;
  text-align: left;
  font-size: 13px;
  color: #7A7A7A;
  line-height: 20px; 
}

@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .line-items .total .extra-notes {
  width: 100%;
  margin-bottom: 30px;
  float: none; } 
}

.receipt-content .invoice-wrapper .line-items .total .extra-notes strong {
  display: block;
  margin-bottom: 5px;
  color: #454545; 
}

.receipt-content .invoice-wrapper .line-items .total .field {
  margin-bottom: 7px;
  font-size: 14px;
  color: #555; 
}

.receipt-content .invoice-wrapper .line-items .total .field.grand-total {
  margin-top: 10px;
  font-size: 16px;
  font-weight: 500; 
}

.receipt-content .invoice-wrapper .line-items .total .field.grand-total span {
  color: #20A720;
  font-size: 16px; 
}

.receipt-content .invoice-wrapper .line-items .total .field span {
  display: inline-block;
  margin-left: 20px;
  min-width: 85px;
  color: #84868A;
  font-size: 15px; 
}

.receipt-content .invoice-wrapper .line-items .print {
  margin-top: 50px;
  text-align: center; 
}



.receipt-content .invoice-wrapper .line-items .print a i {
  margin-right: 3px;
  font-size: 14px; 
}

.receipt-content .footer {
  margin-top: 40px;
  margin-bottom: 110px;
  text-align: center;
  font-size: 12px;
  color: #969CAD; 
}                   
    
    
</style>