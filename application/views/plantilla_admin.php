<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?php echo $titulo ?></title>


    <link rel="stylesheet" href="<?php echo base_url()?>public/css/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>public/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>public/bootstrap/css/bootstrap-theme.css" />
    <link rel="shortcut icon" href="<?php echo base_url()?>favicon.ico" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/login.css">

    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style-responsive.css" rel="stylesheet">

</head>
<body>
<div class="container">

    <div class="col-md-4 col-md-offset-4">
        <div id="contenido">
            <?php $this->load->view($contenido) ?>
        </div>
    </div>
</div>


<script src="<?php echo base_url()?>public/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url()?>public/js/ajaxload.js"></script>
<script src="<?php echo base_url()?>public/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>public/js/login.js"></script>
<script src="<?php echo base_url()?>public/js/form.js"></script>
<script type="text/javascript">var base_url = "<?php echo base_url()?>"; </script>

</body>
</html>
               


        