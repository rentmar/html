<div id="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="box">
					
					<div class="box-header">
						<h3 class="box-title">
							<i class="fa fa-plus" aria-hidden="true"></i>
							Subir Nueva Imagen para Producto
						</h3>
					</div>
					<?php echo form_open_multipart('productos/subirImagen');?>
					<!-- Imagen -->
					<div class="box-body">
						<div class="row">
							<div class="col-4">
								<div>
									<label class="uploader" ondragover="return false">
										<i class="icon fas fa-upload"></i>
										<img src="" class="img-fluid" />
										<input type="file" id="imagproducto" name="imagproducto" accept="image/*" required >
									</label>
								</div>
							</div>
						</div>
					</div><!-- Fin Seccion Informacion General -->
					<div>
						<button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i>Subir Imagen</button>
						<?php echo form_close(); //Cierre del formulario ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script src="<?php echo base_url(); ?>assets/js/FileUploader.js" ></script>
<script type="text/javascript">
    new FileUploader('.uploader');
</script>
