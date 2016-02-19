<?php 
foreach ($filas as $r):

$foto = array(
              'name'        => 'nombre',
              'id'          => 'nombre',
              'value'       => $r->foto,
              'type'        => 'text',
              'placeholder' => 'Nombre',
              'class'       => 'form-control',
              'required'    => '""'
              );

$nombre = array(
              'name'        => 'nombre',
              'id'          => 'nombre',
              'value'       => $r->nombre.' '.$r->apellido,
              'type'        => 'text',
              'placeholder' => '',
              'class'       => 'form-control ',
              'required'    => '""',
              'readonly'    => 'true'
              );

$apellido = array(
              'name'        => 'apellido',
              'id'          => 'apellido',
              'value'       =>$r->apellido,
              'type'        => 'text',
              'placeholder' => '',
              'class'       => 'form-control',
              'required'    => '""',
              'readonly'    => 'true'
              );

$usuario = array(
              'name'        => 'usuario',
              'id'          => 'usuario',
              'value'       => $r->usuario,
              'type'        => 'text',
              'placeholder' => '',
              'class'       => 'form-control',
              'required'    => '""',
              'readonly'    => 'true'
              );

$correo = array(
              'name'        => 'correo',
              'id'          => 'correo',
              'value'       => $r->correo,
              'type'        => 'email',
              'placeholder' => '',
              'class'       => 'form-control',
              'required'    => '""',
              'readonly'    => 'true'
              );


$cedula = array(
              'name'        => 'cedula',
              'id'          => 'cedula',
              'value'       => '',
              'placeholder' => 'C&eacute;dula',
              'type'        => 'text',
              'class'       => 'form-control',
              'required'    => '""',
              'readonly'    => 'true'
             
              );
$direccion = array(
              'name'        => 'direccion',
              'id'          => 'direccion',
              'value'       => '',
              'placeholder' => 'Direcci&oacute;n',
              'type'        => 'text',
              'class'       => 'form-control',
              'required'    => '""',
              'readonly'    => 'true'
             
              );
$contrato = array(
              'name'        => 'contrato',
              'id'          => 'contrato',
              'value'       => '',
              'placeholder' => 'Contrato',
              'type'        => 'text',
              'class'       => 'form-control',
              'required'    => '""',
              'readonly'    => 'true'
             
              );

$estatus = array(
              'name'        => 'estatus',
              'id'          => 'estatus',
              'value'       => '',
              'placeholder' => 'Estatus',
              'type'        => 'text',
              'class'       => 'form-control',
              'required'    => '""',
              'readonly'    => 'true'
             
              );
$balancetotal = array(
              'name'        => 'Balance',
              'id'          => 'Balance',
              'value'       =>'',
              'type'        => 'text',
              'placeholder' => 'Balance Total',
              'class'       => 'form-control',
              'required'    => '""',
              'readonly'    => 'true'
              );



$montoapagar = array(
              'name'        => 'monto',
              'id'          => 'monto',
              'value'       =>'',
              'type'        => 'text',
              'placeholder' => 'Monto a Pagar',
              'class'       => 'form-control',
              'required'    => '""'
              );

?>

  
    <?php $claseFormulario = array('id' =>'formularioCrear' , ); ?>
    <?php echo form_open_multipart('',$claseFormulario, array('enviado' => 'enviado'));?>

    	<?php
		if (isset($editado))
		{?>
				<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $editado ?></div>
		<?php			
		}
	 ?> 

<div class="row">


   <div class="col-md-5 col-md-offset-1">
         <div class="form-group" >
            <label class="control-label inputs">Cliente</label>
             <div class="input-group" >
               <span class="input-group-addon">
               	<i class="fa fa-user"></i>
              </span>
             <?php echo form_input($nombre); ?>
              </div>
         </div> 

           <div class="form-group">
            <label class="control-label inputs">Estatus</label>
             <div class="input-group">
               <span class="input-group-addon">
                <i class="fa fa-pencil-square-o"></i>
              </span>
             <?php echo form_input($estatus); ?>
              </div>
         </div>
    
       

       <div class="form-group">
            <label class="control-label inputs">Contrato</label>
             <div class="input-group">
                <span class="input-group-addon">
                <i class="fa fa-file-text-o"></i>
              </span>
             <?php echo form_input($contrato); ?>
              </div>
         </div> 

         <div class="form-group">
            <label class="control-label inputs">C&eacute;dula</label>
             <div class="input-group">
               <span class="input-group-addon">
                <i class="fa fa-pencil-square-o"></i>
              </span>
              <?php echo form_input($cedula); ?>
              </div>
         </div>  

          <input type="hidden" name="id" value="<?php echo $r->id?>">

             <div class="control-group">
                  <label class="control-label"></label>
                  <div class="controls">

                     <?php echo form_button(array('type'=>'submit', 'content'=>' Imprimir <i class="fa fa-print"></i> ',  'id' => 'fenviar', 'class'=>'btn btn-lg btn-info btn-block')); ?>
                  </div>
          </div>        

     </div>    

      <div class="col-md-5 col-md-offset-0">
      
       

      	<div class="form-group">
            <label class="control-label inputs">Direcci&oacute;n</label>
             <div class="input-group">
               <span class="input-group-addon">
                <i class="fa fa-building-o"></i>
              </span>
             	 <?php echo form_input($direccion); ?>
              </div>
         </div>  

          <div class="form-group">
            <label class="control-label inputs">Acci&oacute;n</label>
             <div class="input-group">
               <span class="input-group-addon">
                <i class="fa fa-list-alt"></i>
              </span>
               <select name="id_operador" class="form-control">
                  
                

                   <option value="1">Pago Mensualidad</option>
                   <option value="2">Caja Digital</option>
                   <option value="3">Reconexi&oacute;n</option>
      

               </select>
              </div>
         </div>  

         <div class="form-group">
            <label class="control-label inputs">Balance Total</label>
             <div class="input-group">
               <span class="input-group-addon">
                RD<i class="fa fa-usd"></i>
              </span>
             <?php echo form_input($balancetotal); ?>
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

         <div class="form-group">
            <label class="control-label inputs">Monto a Pagar</label>
             <div class="input-group">
               <span class="input-group-addon">
                RD<i class="fa fa-usd"></i>
              </span>
             <?php echo form_input($montoapagar); ?>
              </div>
         </div>

				 <input type="hidden" name="id" value="<?php echo $r->id?>">

         		 <div class="control-group">
                  <label class="control-label"></label>
                  <div class="controls">

                     <?php echo form_button(array('type'=>'submit', 'content'=>' Pagar <i class="fa fa-money"></i> ',  'id' => 'fenviar', 'class'=>'btn btn-lg btn-info btn-block')); ?>
                  </div>
          </div>        
      </div>
    </div>   
  
    <?php echo form_close(); ?>

<?php endforeach; ?>

	<script type="text/javascript">
			$(document).ready(function()
			{

				 $("#fenviar").click(function()
				 {
					event.preventDefault();
					var formData = new FormData($("#formularioCrear")[0]);
					//mostrar(formData,'<?php echo base_url(); ?>admin/admin_perfil','#resultado');
					modal(formData,'<?php echo base_url(); ?>usuarios/editar_usuario','.modal-body','.modal','1');
				});
			});

   

		 </script>

		  <?php //$this->output->enable_profiler(TRUE); ?>