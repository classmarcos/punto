<?php header ('Content-type: text/html; charset=utf-8'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"/>
<title><?php echo NOMBRE_SITIO ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<!-- CSS -->
<link rel="stylesheet" href="<?php echo base_url()?>public/css/estilos.css" />
<link rel="stylesheet" href="<?php echo base_url()?>public/css/font-awesome.css" />
<link rel="stylesheet" href="<?php echo base_url()?>public/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>public/bootstrap/css/bootstrap-theme.css" />
<link rel="shortcut icon" href="<?php echo base_url()?>favicon.ico" />

  <!-- JS -->
<script type="text/javascript" src="<?php echo base_url()?>public/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url()?>public/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url()?>public/js/ajaxload.js"></script>
<script src="<?php echo base_url()?>public/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>public/js/form.js"></script>
<script src="<?php echo base_url()?>public/js/highcharts.js"></script>
<script src="<?php echo base_url()?>public/js/modules/exporting.js"></script>
<script type="text/javascript">var base_url = "<?php echo base_url()?>"; </script>

</head>
<body>


  <?php if(@$modal == TRUE) { $this->load->view($modal); } ?>
  <?php if(@$cabecera == TRUE) { $this->load->view($cabecera); } ?>
	<div class="container">
    <div class="row">
    		<?php if(@$menu == TRUE) { $this->load->view($menu); } ?>

		     <!--
         <div class="col-md-2">
            <?php $this->load->view($menuadmin)?>
         </div>
         -->

  			  <!--<div class="col-lg-10">-->
  				 <?php if(@$panel == TRUE) {$this->load->view($panel); } ?>
  				    <div id="resultado">
          		  	<?php $this->load->view($contenido) ?>
          		</div>
            <!--</div> 	-->
     </div>
   </div>
  <?php if(@$pie == TRUE) { $this->load->view($pie); } ?>


</body>
</html>

