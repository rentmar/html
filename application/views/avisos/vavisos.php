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
						<a>Error</a>
					</li>
				</ol>
			</div>
			<!-- End Breadcrumb -->
		</div>
	</div>
	<div class="container-fluid">
		<?php echo $error;?>
	</div>
</div>