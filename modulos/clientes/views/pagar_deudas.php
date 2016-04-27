<style type="text/css">
  /* Style the buttons that are used to open and close the accordion panel */
button.accordion {
    background-color: #FF6C10;
    color: #E1DEDC;
    cursor: pointer;
    padding: 5px;
    width: 100%;
    text-align: center;
    border: none;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
    margin-top: 1em;
}


/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
button.accordion.active, button.accordion:hover {
    background-color: #FF6C10;
}


button.accordion:after {
    content: '\02795'; /* Unicode character for "plus" sign (+) */
    font-size: 13px;
    color: #fff;
    float: right;
    margin-left: 5px;
}

button.accordion.active:after {
    content: "\2796"; /* Unicode character for "minus" sign (-) */
}

/* Style the accordion panel. Note: hidden by default */
div.panel {
    padding: 0 18px;
    background-color: white;
    display: none;
}

/* The "show" class is added to the accordion panel when the user clicks on one of the buttons. This will show the panel content */
div.panel.show {
    display: block !important;
}

 #efectivo{
    text-align:right;
  }

</style>

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
              'readonly'    => 'true',
             // 'style'       =>  'width:45%;'

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
              'readonly'    => 'true',
             // 'style'       =>  'width:40%;'

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
              'autocomplete'=> 'off',
              'step'        =>  'any',
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
              'autocomplete'=> 'off',
              'step'        =>  'any',
              );
}
if($accion==3){
  $balancetotal = array(
                  'name'        => 'Balance',
                  'id'          => 'Balance',
                  'value'       => '200',
                  'type'        => 'text',
                  'placeholder' => 'Balance Total',
                  'class'       => 'form-control',
                  'required'    => '""',
                  'readonly'    => 'true'
                  );
}else{
  $balancetotal = array(
                'name'        => 'Balance',
                'id'          => 'Balance',
                'value'       => $Balance,
                'type'        => 'text',
                'placeholder' => 'Balance Total',
                'class'       => 'form-control',
                'required'    => '""',
                'readonly'    => 'true',

                );

}

  $mensualidad = array(
                  'name'        => 'Mensualidad',
                  'id'          => 'Mensualidad',
                  'value'       => $tarifa,
                  'type'        => 'text',
                  'placeholder' => 'Mensualidad',
                  'class'       => 'form-control',
                  'required'    => '""',
                  'readonly'    => 'true'
                  );
$caja = array(
                  'name'        => 'Caja',
                  'id'          => 'Caja',
                  'value'       => $Caja,
                  'type'        => 'text',
                  'placeholder' => 'Caja',
                  'class'       => 'form-control',
                  'required'    => '""',
                  'readonly'    => 'true'
                  );


$cuenta=array(
                  'name'        => 'Cuenta',
                  'id'          => 'Cuenta',
                  'value'       => $Cuenta,
                  'type'        => 'number',
                  'placeholder' => 'Cuenta',
                  'class'       => 'form-control',
                  'required'    => '""',
                  'disabled'    => 'true'
                  );

$cheque=array(
                  'name'        => 'Cheque',
                  'id'          => 'Cheque',
                  'value'       => $Cheque,
                  'type'        => 'number',
                  'placeholder' => 'No. Cheque o Tarjeta',
                  'class'       => 'form-control',
                  'required'    => '""',
                  'disabled'    => 'true'
                  );

?>


    <?php $claseFormulario = array('id' =>'formularioCrear' ,'name'=>'formularioCrear' ); ?>
    <?php echo form_open_multipart('',$claseFormulario, array('enviado' => 'enviado'));?>

    	<?php
		if (isset($pagado))
		{?>
				<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $pagado ?></div>
		<?php
		}
	 ?>
      <?php
  if (isset($error))
    {  ?>
        <?php echo $error; ?>
    <?php
    }
   ?>

   <?php
  if (isset($errormonto))
    {  ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $errormonto; ?></div>
        
        
    <?php
    }
   ?>

<div id="imprimeme" >
<div class="row" >

   <div class="col-md-5 col-md-offset-1">
         <div class="form-group" >
            
             <div class="input-group" >
               <span class="input-group-addon" >
               	 Cliente
              </span>
         <?php echo form_input($nombre); ?>
              </div>
         </div>

           <div class="form-group" >
           
             <div class="input-group">
               <span class="input-group-addon">
                Estatus
              </span>
             <?php echo form_input($estatus); ?>
              </div>
         </div>



       <div class="form-group">
          
             <div class="input-group">
                <span class="input-group-addon">
                 Contrato
              </span>
             <?php echo form_input($contrato); ?>
              </div>

               
         </div>

         <div class="form-group">
           <div class="input-group" >
               <span class="input-group-addon">
                C&eacute;dula
              </span>
              <?php echo form_input($cedula); ?>
              </div>
            
         </div>

          <input type="hidden" name="Contrato" value="<?php echo $Contrato?>" >



     </div>

      <div class="col-md-5 col-md-offset-0" >



      	<div class="form-group" >
            
             <div class="input-group">
               <span class="input-group-addon">
              Direcci&oacute;n
              </span>
             	 <?php echo form_input($direccion); ?>
              </div>
         </div>

          <div class="form-group">
        
             <div class="input-group" style="display:none;" >
               <span class="input-group-addon">
                <i class="fa fa-list-alt"></i>
              </span>
               <select name="id_accion" class="form-control ">
                <?php
                 
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
              </div>
            
                <div class="input-group">
               <span class="input-group-addon">
                Mensualidad RD<i class="fa fa-usd"></i>
              </span>
             <?php echo form_input($mensualidad); ?>
              </div>   
         </div>

         <div class="form-group">
             <div class="input-group">
               <span class="input-group-addon">
               Balance Total RD<i class="fa fa-usd"></i>
              </span>
             <?php echo form_input($caja); ?>
              </div>
         </div>

         <div class="form-group">
             <div class="input-group">
               <span class="input-group-addon">
               Balance a Cobrar RD<i class="fa fa-usd"></i>
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
         

         <!--<div class="form-group">
            <label class="control-label inputs">Monto a Pagar</label>
             <div class="input-group">
               <span class="input-group-addon">
                RD<i class="fa fa-usd"></i>
              </span>
             <?php echo form_input($montoapagar); ?>
              </div>
         </div>-->

				 <input type="hidden" name="Contrato" value="<?php echo $Contrato?>">
</div>
      </div>  <fieldset><legend></legend>
  <div class="col-md-5 col-md-offset-1">
   <div class="form-group" >
           <label class="control-label inputs">Forma de Pago</label>
             <div class="input-group">
             <span class="input-group-addon" class="form-control">
              <input id="formapago" type="radio"  name="formapago" value="EF" onClick="javascript:tipodepago('EF');" <?php echo ($Formapago=='EF')?'checked':''; ?> >Efectivo 
              <input id="formapago" type="radio" style="margin-left:10px;" name="formapago" value="CK" onClick="javascript:tipodepago('CK');" <?php echo ($Formapago=='CK')?'checked':''; ?>>Cheque
              <input id="formapago" type="radio" style="margin-left:10px;" name="formapago" value="TA" onClick="javascript:tipodepago('TA');" <?php echo ($Formapago=='TA')?'checked':''; ?>>Tarjeta</span>
           
              </div>
         </div>

     <div class="form-group" >
            <label class="control-label inputs">Banco</label>
             <div class="input-group" >
               <span class="input-group-addon">
                <i class="fa fa-university"></i>
              </span>

          <select class="form-control" id="Banco" name="Banco" disabled="true">
                   <option value="" <?php echo ($Banco=='')?'selected':'';?>>- Elegir una opcion -</option>
                 <?php foreach($Bancos as $r):?>
                    <option value="<?=$r->Codigo?>" <?php echo ($Banco==$r->Codigo)?'selected':''; ?> ><?=$r->Descripcion;?></option>
                 <?php endforeach;?> 
                 </select>
              </div>
         </div>

           <div class="form-group">
            <label class="control-label inputs">No. Cheque o Tarjeta</label>
             <div class="input-group">
               <span class="input-group-addon">
                <i class="fa fa-pencil-square-o"></i>
              </span>
             <?php echo form_input($cheque); ?>
              </div>
         </div>



  </div>
  <div class="col-md-5 col-md-offset-0">
   

         <div class="form-group" >
            <label class="control-label inputs">Monto</label>
             <div class="input-group" >
               <span class="input-group-addon">
                RD<i class="fa fa-usd"></i>
              </span>
         <?php echo form_input($montoapagar); ?>
              </div>
         </div>

           <div class="form-group">
            <label class="control-label inputs">Cuenta</label>
             <div class="input-group">
               <span class="input-group-addon">
                <i class="fa fa-pencil-square-o"></i>
              </span>
             <?php echo form_input($cuenta); ?>
              </div>
         </div>



       <div class="form-group">
            <label class="control-label inputs">Tipo Tarjeta</label>
             <div class="input-group">
                <span class="input-group-addon">
                <i class="fa fa-list-ul"></i>
              </span>
                 <select class="form-control" id="tipotarjeta" name="tipotarjeta" disabled="true">
                   <option value="" <?php echo ($tipotarjeta=='')?'selected':''; ?>>- Elegir una opcion -</option>
                   <option value="C" <?php echo ($tipotarjeta=='C')?'selected':''; ?>>Cr&eacute;dito</option>
                   <option value="D" <?php echo ($tipotarjeta=='D')?'selected':''; ?>>D&eacute;bito</option>
                 </select>
              </div>
         </div>


  </div>

</fieldset>

 <!-- style=" position: relative; top: 0px; left: 250px;" -->
      <div class="col-md-offset-0" style="width: 41.66666667%; margin:0 auto;" >
         <div class="control-group" >
                    
                    <div class="controls" >

                       <?php echo form_button(array('type'=>'submit', 'content'=>' Pagar <i class="fa fa-money"></i> ',  'id' => 'fenviar', 'class'=>'btn btn-lg btn-info btn-block')); ?>
                    </div> <!--
                    <button onclick="imprimir()">Call me</button>
                   
                    <a href="javascript:void(0)" class="btn btn-info btn-xs" title="Pagar" class="text-info"
                       onclick="modal('','<?= base_url().'imprimir()'?>','.modal-body','.modal','')">facturar </a>
                   -->   
              
            </div>
        </div>
    </div>
  

<?php echo form_close(); ?>

 <button class="accordion" id="detalle">Detalle de Pendientes  </button>
<!--
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
  <span ><?=$fecha?></span><br />
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


</div>-->
    
<div class="panel" style="overflow-x:auto;  height: 200px;overflow-y: auto;">
  <p><?php 
  if(isset($detalle["error"]) || $detalle=="")
  {
      echo "Actualmente no hay Registros";
  }
  else
  {
  ?>
 <table class="table table-bordered" >
                                          <thead> 
                                            <tr>  
                                                
                                                <th>CONCEPTO</th>
                                                <th>TIPO</th>
                                                <th>FECHA</th>
                                                <th>BALANCE</th>
                                              
                                            </tr>
                                            </thead>  
                                            <tbody> 
                                            <?php
                                              $accionTexto="";
                                              if($accion==1){
                                                $accionTexto="MENSUALIDAD";
                                              }else if($accion==2){
                                                $accionTexto="CAJA DIGITAL";
                                              }


                                              if(!isset($detalle["error"]) || $detalle!=""){
                                           
                                              foreach($detalle as $r):?>
                                            
                                            <tr>
                                                 
                                                
                                                <td> <?=$r->Concepto?> </td>
                                                <td><?= $accionTexto;?></td>
                                                <td> <?=$r->Fecha?>     </td>
                                                <td style="text-align:right;"> <?=$r->Balance?>   </td>
                                      
                                              </tr>

                                           
                                           
                                             <?php  endforeach;}?> </tbody>

                                            <tbody>
                                              
                                              <td></td>
                                              <td></td>
                                              
                                              <td><strong>Balance Total</strong></td>
                                              <td id="efectivo"><strong><?= $Balance?></strong></td>
                                            </tbody>
                                            
                                           </table><?php }?></p>
</div>
	<script type="text/javascript" languaje="JavaScript">
			$(document).ready(function(event)
			{

				 $("#fenviar").click(function(event)
				 {
            event.preventDefault();
				
            var monto =$('input[name=Montoapagar]').val();
            var agree=confirm("¿Realmente desea pagar $"+ monto+" ?");

           if(agree==true){
            
            var formData = new FormData($("#formularioCrear")[0]);
              
          if("<?=$accion?>"=="1"){
              var url = "clientes/realizarPago";
              var titulo = "Pago Mensualidad";
            }else if("<?=$accion?>"=="2" ){
              var url = "clientes/realizarPago";
              var titulo = "Pago Caja Digital";
            }else if("<?=$accion?>"=="3"){
              var url = "clientes/pago_reconexion";
              var titulo = "Pago Reconexión";
            }

            modal(formData,'<?php echo base_url(); ?>'+url+'','.modal-body','.modal','1',titulo);

           } else{

            alert("Pago CANCELADO");
            $(".modal").modal('hide');
           }
            

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


<script Language="Javascript">
 function imprimir(){
  var objeto=document.getElementById('imprision');  //obtenemos el objeto a imprimir
  var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
  ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
  ventana.document.close();  //cerramos el documento
  ventana.print();  //imprimimos la ventana
  ventana.close();  //cerramos la ventana

}
</script>-->

<script  Language="Javascript">
 //document.getElementById("Montoapagar").focus();

  var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");

    }
 }
</script>

<script language="javascript">
function format(input)
{

var num =  input.innerHTML.replace(/\,/g,'');
if(!isNaN(num)){
num = num.toString().split('').reverse().join('').replace(/(?=\d*\,?)(\d{3})/g,'$1,');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
input.innerHTML = num;
}
 
else{ alert('Solo se permiten numeros');
input.innerHTML = input.innerHTML.replace(/[^\d\,]*/g,'');
}
}

</script>

<script>

  for(i=0;i<3;i++){
    if(document.formularioCrear.formapago[i].checked) {
      marcado=i; // el indice del radio que esta marcado
    }
  }

  tipodepago(document.formularioCrear.formapago[marcado].value);//para que la opcion que este marcada se habiliten sus componentes



function tipodepago(tipopago){ //para habilitar y desabilitar los campos que se ncesitend dependiendo la opcion seleccionada
  var valor;
  var valortarjeta;

  if(tipopago=='EF'){
    valor=true;
    valortarjeta=true;
     document.getElementById('Banco').getElementsByTagName('option')[0].selected = 'selected';
  document.getElementById('tipotarjeta').getElementsByTagName('option')[0].selected = 'selected';
  }else if(tipopago=='CK'){
    valor=false;
    valortarjeta=true;
     document.getElementById('tipotarjeta').getElementsByTagName('option')[0].selected = 'selected';
  }else if(tipopago=='TA'){
    valor=false;
    valortarjeta=false;
  }

  document.getElementById('Banco').disabled=valor;
  document.getElementById('Cuenta').disabled=valor;
  document.getElementById('Cheque').disabled=valor;
  document.getElementById('tipotarjeta').disabled=valortarjeta;
 
}

</script>