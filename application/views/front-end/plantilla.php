<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title><?php echo NOMBRE_EMPRESA ?></title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lineicons/style.css">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style-responsive.css" rel="stylesheet">

    <!--Css Adicionales vienes del controlador-->
    <?php if (isset($cssvista)): ?>
        <?php foreach($cssvista as $css): ?>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url().$css;?>">
        <?php endforeach; ?>
    <?php endif; ?>


    <script src="<?php echo base_url();?>public/js/jquery-1.11.3.min.js"></script>

    <script src="<?php echo base_url();?>public/js/ajaxload.js"></script>
    <script src="<?php echo base_url();?>public/js/form.js"></script>
    <script type="text/javascript">var base_url = "<?php echo base_url()?>"; </script>

    <script src="<?php echo base_url();?>assets/js/common-scripts.js"></script>

    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dcjqaccordion.2.7.js"></script>

    <script src="<?php echo base_url()?>public/js/highcharts.js"></script>
    <script src="<?php echo base_url()?>public/js/modules/exporting.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/jquery.datetimepicker.css">
    <script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.datetimepicker.js"></script>

    <!--Js Adicionales vienes del controlador-->
    <?php if (isset($jsvista)): ?>
        <?php foreach($jsvista as $js): ?>
            <script src="<?php echo base_url().$js;?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <script type="text/javascript">
        window.onload = cargarfunciones;
    </script>



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>


<?php if (isset($modal)): ?>
    <?php $this->load->view($modal);?>
<?php endif; ?>

<section id="container">

    <?php $this->load->view($header);?>

    <?php $this->load->view($aside);?>

    <div id="resultado">
        <?php $this->load->view($section);?>
    </div>

    <?php //$this->load->view($footer);?>

</section>
</body>
</html>