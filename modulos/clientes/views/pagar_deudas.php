<?php 

$nombre = array(
              'name'        => 'Nombre',
              'id'          => 'Nombre',
              'value'       => $Nombre,
              'type'        => 'text',
              'placeholder' => 'Nombre',
              'class'       => 'form-control ',
              'required'    => '""',
              'readonly'    => 'true'
              );


$cedula = array(
              'name'        => 'Cedula',
              'id'          => 'Cedula',
              'value'       => $Cedula,
              'placeholder' => 'C&eacute;dula',
              'type'        => 'text',
              'class'       => 'form-control',
              'required'    => '""',
              'readonly'    => 'true'
             
              );
$direccion = array(
              'name'        => 'Direccion',
              'id'          => 'Direccion',
              'value'       => $Direccion,
              'placeholder' => 'Direcci&oacute;n',
              'type'        => 'text',
              'class'       => 'form-control',
              'required'    => '""',
              'readonly'    => 'true'
             
              );
$contrato = array(
              'name'        => 'Contrato',
              'id'          => 'Contrato',
              'value'       => $Contrato,
              'placeholder' => 'Contrato',
              'type'        => 'text',
              'class'       => 'form-control',
              'required'    => '""',
              'readonly'    => 'true'
             
              );

if($Estatus == 'DESCONECTADO' || $Estatus == 'DESACTIVADO' || $Estatus == 'CANCELADO' || $Estatus =='DESMANTELADO'){
  $estatus = array(
              'name'        => 'Estatus',
              'id'          => 'Estatus',
              'value'       =>  $Estatus,
              'placeholder' => 'Estatus',
              'type'        => 'text',
              'class'       => 'form-control ',
              'required'    => '""',
              'readonly'    => 'true',
              'style'       => 'color: red;'
             
              );
}else{

$estatus = array(
            'name'        => 'Estatus',
            'id'          => 'Estatus',
            'value'       => $Estatus,
            'placeholder' => 'Estatus',
            'type'        => 'text',
            'class'       => 'form-control',
            'required'    => '""',
            'readonly'    => 'true',
            'style'       =>  'color:green;'
           
            );
  
}

$montoapagar = array(
              'name'        => 'Balance',
              'id'          => 'Balance',
              'value'       =>  '',
              'type'        => 'number',
              'placeholder' => 'Monto a Pagar',
              'class'       => 'form-control',
              'required'    => '""',
              'autocomplete'=> 'off'
              );

  $balancetotal = array(
                  'name'        => 'Balance',
                  'id'          => 'Balance',
                  'value'       => $Balance,
                  'type'        => 'number',
                  'placeholder' => 'Balance Total',
                  'class'       => 'form-control',
                  'required'    => '""',
                  'readonly'    => 'true'
                  );


?>


  
    <?php $claseFormulario = array('id' =>'formularioCrear' , ); ?>
    <?php echo form_open_multipart('',$claseFormulario, array('enviado' => 'enviado'));?>

    	<?php
		if (isset($pagado))
		{?>
				<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $pagado ?></div>
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

          <input type="hidden" name="Contrato" value="<?php echo $Contrato?>">

                 

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
                  
                

                   <option value="1" >Pago Mensualidad</option>
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

				 <input type="hidden" name="Contrato" value="<?php echo $Contrato?>">

         		       
      </div>
      <div class="col-md-5 col-md-offset-0" style=" position: relative; top: 0px; left: 250px;>
         <div class="control-group" ">
                    <label class="control-label"></label>
                    <div class="controls">

                       <?php echo form_button(array('type'=>'submit', 'content'=>' Pagar <i class="fa fa-money"></i> ',  'id' => 'fenviar', 'class'=>'btn btn-lg btn-info btn-block')); ?>
                    </div>
            </div>
        </div> 
    </div>   
  
    <?php echo form_close(); ?>



	<script type="text/javascript">
			$(document).ready(function()
			{

				 $("#fenviar").click(function()
				 {
					event.preventDefault();
					var formData = new FormData($("#formularioCrear")[0]);
					//mostrar(formData,'<?php echo base_url(); ?>admin/admin_perfil','#resultado');
					modal(formData,'<?php echo base_url(); ?>clientes/pagar_deudas','.modal-body','.modal','1');
				});
			});

   

		 </script>

		  <?php //$this->output->enable_profiler(TRUE); ?>