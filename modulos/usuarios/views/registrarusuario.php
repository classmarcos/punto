<?php 
$foto = array(
              'name'        => 'nombre',
              'id'          => 'nombre',
              'value'       => '',
              'type'        => 'text',
              'placeholder' => 'Nombre',
              'class'       => 'form-control',
              );

$nombre = array(
              'name'        => 'nombre',
              'id'          => 'nombre',
              'value'       => '',
              'type'        => 'text',
              'placeholder' => 'Nombre',
              'class'       => 'form-control',
              );

$apellido = array(
              'name'        => 'apellido',
              'id'          => 'apellido',
              'value'       => '',
              'type'        => 'text',
              'placeholder' => 'Apellido',
              'class'       => 'form-control',
              );

$usuario = array(
              'name'        => 'usuario',
              'id'          => 'usuario',
              'value'       => '',
              'type'        => 'text',
              'placeholder' => 'Usuario',
              'class'       => 'form-control',
              );

$clave = array(
              'name'        => 'clave',
              'id'          => 'clave',
              'value'       => '',
              'type'        => 'password',
              'placeholder' => 'Ingrese una clave',
              'class'       => 'form-control',
              );

$cclave = array(
              'name'        => 'cclave',
              'id'          => 'cclave',
              'value'       => '',
              'type'        => 'password',
              'placeholder' => 'Vuelva a ingresar la clave',
              'class'       => 'form-control',
              );

$correo = array(
              'name'        => 'correo',
              'id'          => 'correo',
              'value'       => '',
              'type'        => 'email',
              'placeholder' => 'Correo Electronico',
              'class'       => 'form-control',
              );


?>

  
    <?php $claseFormulario = array('id' =>'formularioCrear' , ); ?>
    <?php echo form_open_multipart('',$claseFormulario, array('enviado' => 'enviado'));?>

<section id="main-content">
          <section class="wrapper">
          <h3><i class="fa fa-angle-right"></i> Registros de usuarios</h3>
            <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">

                    <ol class="breadcrumb">
                          <li class="active">Registro de Compra</li>
                           <li class="active">Apertura de Caja <i class="fa fa-money"></i> <span class="badge bg-theme">Bs.F.<?php echo APERTURACAJA ?></span></li>
                          <li class="active">Caja chica <i class="fa fa-money"></i> <span class="badge bg-theme">Bs.F.<?php echo CAJACHICA ?></span></li>
                          <li class="active">Monto Maximo <i class="fa fa-money"></i> <span class="badge bg-theme">Bs.F.<?php echo MONTOMAXIMO ?></span></li>
                          <li class="active">Monto Minimo <i class="fa fa-money"></i> <span class="badge bg-theme">Bs.F.<?php echo MONTOMINIMO ?></span></li>
                      </ol>

<div class="row">
   <div class="col-md-5 col-md-offset-1">
         <div class="form-group">
            <label class="control-label inputs">Nombres</label>
             <div class="input-group">
               <span class="input-group-addon">
               	<i class="fa fa-pencil-square"></i>
              </span>
             <?php echo form_input($nombre); ?>
              </div>
         </div> 

           <div class="form-group">
            <label class="control-label inputs">Apellidos</label>
             <div class="input-group">
               <span class="input-group-addon">
                <i class="fa fa-pencil-square"></i>
              </span>
             <?php echo form_input($apellido); ?>
              </div>
         </div>
    
         <div class="form-group">
            <label class="control-label inputs">Usuario</label>
             <div class="input-group">
               <span class="input-group-addon">
                <i class="fa fa-user"></i>
              </span>
             <?php echo form_input($usuario); ?>
              </div>
         </div> 

         <div class="form-group">
            <label class="control-label inputs">Contraseña</label>
             <div class="input-group">
               <span class="input-group-addon">
                <i class="glyphicon glyphicon-lock"></i>
              </span>
             <?php echo form_input($clave); ?>
              </div>
         </div>

          <div class="form-group">
            <label class="control-label inputs">Repita la contraseña</label>
             <div class="input-group">
               <span class="input-group-addon">
                <i class="glyphicon glyphicon-lock"></i>
              </span>
             <?php echo form_input($cclave); ?>
              </div>
         </div>

     </div>    

      <div class="col-md-5 col-md-offset-0">
      
      <div class="form-group">
            <label class="control-label inputs">Correo</label>
             <div class="input-group">
               <span class="input-group-addon">
                <i class="fa fa-envelope-o"></i>
              </span>
             	<?php echo form_input($correo); ?>
              </div>
         </div>  

         <div class="form-group">
            <label class="control-label inputs">Tipo de Operador</label>
             <div class="input-group">
               <span class="input-group-addon">
                <i class="glyphicon glyphicon-headphones"></i>
              </span>
              <select name="id_operador" class="form-control">
                  <option value="">Seleccionar</option>
                  <option value="1">Administrador</option>
                  <option value="2">Operador normal</option>
                  <option value="3">Registrados en el sistemas</option>
              </select>
              </div>
         </div>  

      	<div class="form-group">
            <label class="control-label inputs">Avatar</label>
             <div class="input-group">
               <span class="input-group-addon">
                <i class="glyphicon glyphicon-picture"></i>
              </span>
             	 <input type="file" class="form-control" name="userfile" id="userfile" size="20" />
              </div>
         </div>  

          <?php
  					if (isset($respuesta))
  					{
  						foreach ($respuesta as $mensaje)
  						{
  					?>
  							  <div class="alert alert-danger alert-dismissible" role="alert">
  		  					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $mensaje ?></div>
  				<?php			
  						}
  					}
				 ?> 
         		 <div class="control-group">
                  <label class="control-label"></label>
                  <div class="controls">
                     <?php echo form_button(array('type'=>'submit', 'content'=>'Registrar Usuario <i class="fa fa-male"></i>',  'id' => 'fenviar', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
                  </div>
            </div>        
      </div>
    </div>   
  
    <?php echo form_close(); ?>

	<script type="text/javascript">
			$(document).ready(function()
			{
				 $("#formularioCrear").submit(function(event)
				 {
					event.preventDefault();
					var formData = new FormData($("#formularioCrear")[0]);
  					//mostrar(formData,'<?php echo base_url(); ?>admin/admin_perfil','#resultado');
  					modalregistrousuario(formData,'<?php echo base_url(); ?>usuarios/registrarusuario','.modal-body','.modal','<?php echo base_url(); ?>usuarios/mostrarusuario');
				});
			});
</script>

		  <?php //$this->output->enable_profiler(TRUE); ?>
          </div>
       </div>
    </div><!-- col-lg-12-->
  </div><!-- /row --> 
</section>   