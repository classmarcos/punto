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

if($Montoapagar=="" ){
$montoapagar = array(
              'name'        => 'Montoapagar',
              'id'          => 'Montoapagar',
              'value'       =>  '',
              'type'        => 'number',
              'placeholder' => 'Monto a Pagar',
              'class'       => 'form-control',
              'required'    => '""',
              'autocomplete'=> 'off'
              );
}else{
  $montoapagar = array(
              'name'        => 'Montoapagar',
              'id'          => 'Montoapagar',
              'value'       =>  $Montoapagar,
              'type'        => 'number',
              'placeholder' => 'Monto a Pagar',
              'class'       => 'form-control',
              'required'    => '""',
              'autocomplete'=> 'off'
              );
}

  $balancetotal = array(
                  'name'        => 'Balance',
                  'id'          => 'Balance',
                  'value'       => $Balance,
                  'type'        => 'text',
                  'placeholder' => 'Balance Total',
                  'class'       => 'form-control',
                  'required'    => '""',
                  'readonly'    => 'true'
                  );

?>



</script>


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


<div id="imprimeme" >
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
         <!--
          <?php
            //$type_array = array('0' => 'Pago Mensualidad','1' => 'Caja Digital');
             // if(in_array($CodEstatus, array(1,4,12,13)))
                 // $type_array[] = 'Pago de Reconexión';

            ?>
            <label class="control-label inputs">Acci&oacute;n</label>
             <div class="input-group">
               <span class="input-group-addon">
                <i class="fa fa-list-alt"></i>
              </span>
               <select name="id_accion" class="form-control ">
                <?php
                 // foreach ($type_array as $key => $value) {
                 //   echo '<option value="' . $key . '">'. $value . '</option>';
                  //}  
                if($accion==1){
                 echo '<option value="' . $accion . '">Pago Mensualidad</option>';
                }elseif ($accion==2) {
                   echo '<option value="' . $accion . '">Pago de Caja Digital</option>';
                }elseif ($accion==3) {
                  $Balance = "200";
                   echo '<option value="' . $accion . '">Pago de Reconexi&oacute;n</option>';
                }
                ?>

               </select>
              </div>-->
               <label class="control-label inputs"></label>
                <a href="javascript:void(0)" onclick="modal('fila=<?php echo $Contrato.';'.$Balance.';'.'' ?>','<?php echo base_url(); ?>clientes/mostrarDetalle','.modal-body','.modal','','Detalle de Pendientes')"><span class="btn btn-lg btn-block btn-default" style="background:#FF6C10;text-align:left;">Detalle de Pendientes</span></a>
        
               <!--
              <?php //echo form_button(array('type'=>'', 'content'=>' Detalles de pendientes',  'id' => 'fDetalle', 'class'=>'btn btn-lg btn-block btn-default','style'=>'background:orange;text-align:left;','onclick'=>"modal('fila=<?php echo $Contrato.';'.$Balance.';'.'' ?>','<?php echo base_url(); ?>clientes/mostrarDetalle','.modal-body','.modal','','Detalle de Pendientes')")); ?>
                -->    
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
      <div class="col-md-5 col-md-offset-0" style=" position: relative; top: 0px; left: 250px;">
         <div class="control-group" >
                    <label class="control-label"></label>
                    <div class="controls">

                       <?php echo form_button(array('type'=>'submit', 'content'=>' Pagar <i class="fa fa-money"></i> ',  'id' => 'fenviar', 'class'=>'btn btn-lg btn-info btn-block')); ?>
                    </div> <!--
                    <button onclick="imprimir()">Call me</button>
                   
                    <a href="javascript:void(0)" class="btn btn-info btn-xs" title="Pagar" class="text-info"
                       onclick="modal('','<?= base_url().'imprimir()'?>','.modal-body','.modal','')">facturar </a>
               -->
            </div>
        </div>
    </div>
</div>

<div id="imprision" style=" width:1; font-family:Arial; display:none; ">
  <div style="text-align: center; margin-top: 0px; padding:0;font-size:16px;">
  <span ><strong>TELEOPERADORA DEL NORDESTE</strong></span><br />
  <span ><strong>(TELENORD)</strong></span><br />
  <span ><strong>V. FRANK GRULLON #5</strong></span><br />
  <span ><strong>SAN FRANCISCO DE MACOR&Iacute;S</strong></span><br />
  <span ><strong>Tel: 809-588-6238 Fax: 809-588-0105</strong></span><br />
  <span ><strong>RNC: 104-01619-1</strong></span><br />
</div>

<div style="text-align: right;">
 <!-- <span ><?=$fecha?></span><br />-->
  <span>No.: <?=$TRN?></span>
</div>

<div style="text-align: center;  margin-top: 2em;">
  <span style="display: block;">RECIBO</span>
</div>

<div style="border-top: dashed 2px black; border-bottom: dashed 2px black; margin-top: 1em;">
  <span style="margin-top: 1em;"><strong>Contrato:</strong></span><span style="margin-top: 1em; font-size:12px;"><?= $Contrato.' - '.$Nombre?></span><br/>
  <span style="margin-top: 1em; padding-bottom: 1em; "><strong>Balance Anterior:</strong> <?=$Balance?></span>
</div>

<table style="width:100%; border-bottom: dashed 2px black;">
  <tr>
    <th style="width:40%; text-align:left;">Concepto</th>
    <th style="width:30%; text-align:left; ">Monto Pagado</th>
  </tr>
</table>
<?php
  $myArray = explode(';', $conceptoPago);

?>
<table style="width:100%; border-bottom: dashed 2px black;">
 <tr>

    <td style="width:40%; text-align:left; font-size:12px;"><?=$conceptoPago?></td>
    <th style="width:30%; text-align:left; "></th>
  </tr>
</table>

<table style="width:100%; border-bottom: dashed 2px black;">
  <tr>
    <td style="width:70%; text-align:left; "><strong>Monto Total Recibido</strong></td>
    <td style="width:30%; text-align:left; "><div style="width: 40%; margin:0; padding:0; text-align: right;"><?= $Montoapagar?></div></td>
  </tr>
  <tr>
    <td style="width:70%; text-align:left;"><strong>Pendiente</strong></td>
    <td style="width:30%; text-align:left; "><div style="width: 40%; margin:0; padding:0; text-align: right;"><?=$Balance-$Montoapagar?></div></td>
  </tr>
</table>

<div style="text-align: center;  margin-top: 2em;">
  <span style="display: block; ">GRACIAS POR SU PAGO</span>
</div>

<div style="text-align: center;  margin-top: 2em;">
  <span style="display: block; ">Le atendio:</span>
  <span style="display: block;"><STRONG><?=$usuario?></STRONG></span>
</div>

<div style="text-align: center;  margin-top: 2em;">
  <span style="display: block; "><STRONG>*ABONO A FACTURA NO EVITA CORTE*</STRONG></span>
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

         

            var agree=confirm("¿Realmente desea pagar $"+ $('input[name=Montoapagar]').val()+" ?");
            //if (agree) return true ;
           // else return false ;
           if(agree==true){
            modal(formData,'<?php echo base_url(); ?>clientes/realizarPago','.modal-body','.modal','1');
           }
           else{
            alert("Pago CANCELADO");
           }


					//mostrar(formData,'<?php echo base_url(); ?>admin/admin_perfil','#resultado');
					

				});
			});



		 </script>

		  <?php //$this->output->enable_profiler(TRUE); 
         
      ?>

<!--
<script type="text/javascript">

$(document).ready(function(){



  $("select[name=id_accion]").change(function(){
    
    if($('select[name=id_accion]').val()==0){
       $('input[name=Balance]').val("<?php echo $BalanceMensualidad;?>");
    }else if($('select[name=id_accion]').val()==1){
       $('input[name=Balance]').val("<?php echo $BalanceCaja;?>");
    }else if($('select[name=id_accion]').val()==2){
        $('input[name=Balance]').val("200.00");
    }
           
  });
});

</script>

-->
<script Language="Javascript">
 function imprimir(){
  var objeto=document.getElementById('imprision');  //obtenemos el objeto a imprimir
  var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
  ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
  ventana.document.close();  //cerramos el documento
  ventana.print();  //imprimimos la ventana
  ventana.close();  //cerramos la ventana

}
</script>