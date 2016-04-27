<?php
  $cedula = array(
              'name'        => 'Cedula',
              'id'          => 'Cedula',
              'value'       => '',
              'placeholder' => 'C&eacute;dula',
              'type'        => 'text',
              'class'       => 'form-control',
              'required'    => '""',
              'readonly'    => 'true',
              );
  $cuenta=array(
                  'name'        => 'Cuenta',
                  'id'          => 'Cuenta',
                  'value'       => '',
                  'type'        => 'number',
                  'placeholder' => 'Cuenta',
                  'class'       => 'form-control',
                  'required'    => '""',
                  
                  );

  $direccion = array(
              'name'        => 'Direccion',
              'id'          => 'Direccion',
              'value'       => '',
              'placeholder' => 'Direcci&oacute;n',
              'type'        => 'text',
              'class'       => 'form-control',
              'required'    => '""',
              'readonly'    => 'true'

              );
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
  $fecha_atributos = array(
                    'style' => 'text-align: right;', );

  $cuenta=array(
                  'name'        => 'Cuenta',
                  'id'          => 'Cuenta',
                  'value'       => '',
                  'type'        => 'number',
                  'placeholder' => 'Cuenta',
                  'class'       => 'form-control',
                  'required'    => '""',
                  
                  );

$cheque=array(
                  'name'        => 'Cheque',
                  'id'          => 'Cheque',
                  'value'       => '',
                  'type'        => 'number',
                  'placeholder' => 'No. Cheque o Tarjeta',
                  'class'       => 'form-control',
                  'required'    => '""',
                  
                  );
$concepto=array(
                  'name'        => 'Concepto',
                  'id'          => 'Concepto',
                  'value'       => '',
                  'type'        => 'text',
                  'placeholder' => 'Concepto',
                  'class'       => 'form-control',
                  'required'    => '""',
                  
                  );
$nombre = array('class' => '','style' =>'text-align:center;size:55px; color:blue;' );
$contrato = array(
              'name'        => 'Contrato',
              'id'          => 'Contrato',
              'value'       => '',
              'type'        => 'text',
              'placeholder' => 'Contrato',
              'class'       => 'form-control',
              'required'    => '""',
              'disabled'    =>  'true',
              );
?>
<section id="main-content">
  <section class="wrapper">
    <div class="row mt">
      <div class="col-lg-12">
          <div class="panel panel-default">
          <div class="panel-heading">
              <h4 style="text-align:center;color:#000; margin-botton:0px;padding:0px;">
                  <strong> DATOS DE COBROS</strong>
              </h4>
              <h5 style="text-align:left;color:green;" >CONECTADO</h5>
          </div>
          <div class="panel-body">
              
              <div class="col-md-12">
                <h3 style="text-align:center;color:orange; margin-botton:0px;padding:0px;">A0000501A</h3>
                <h3 style="text-align:center;color:#07ADB9;margin-top:0px;"> Arlette Espinal Romero</h3>
              </div>
              <div class="col-md-5 col-md-offset-1">
                  <div class="form-group">
                     <div class="input-group" >
                         <span class="input-group-addon">
                           <i class="fa fa-credit-card"></i>
                        </span>
                        <?php echo form_input($cedula); ?>
                      </div>
                 </div>
               </div>

               <div class="col-md-5 col-md-offset-0" >
                  <div class="form-group" >
                     <div class="input-group">
                         <span class="input-group-addon">
                            <i class="fa fa-building-o"></i>
                        </span>
                         <?php echo form_input($direccion); ?>
                     </div>
                  </div>
               </div>
               <!--una linea-->
               <HR width="85%" align="center" noshade="noshade"  size="2px" style="opacity:0.5;">
               <div class="col-md-5 col-md-offset-1">
                <div class="form-group">
                          <div class="input-group">
                              <span class="input-group-addon">
                                <i class="fa fa-list"></i>
                              </span>
                            <select class="form-control" id="tipotarjeta" name="tipotarjeta">
                               <option value="" >Pago Mensualidad</option>
                               <option value="" >Pago Caja Digital</option>
                               <option value="" >Pago Reconexion</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="form-group" >
                        <div class="input-group" >
                            <span class="input-group-addon">
                              <i class="fa fa-money"></i>
                            </span>
                          <?php echo form_input($montoapagar); ?>
                        </div>
                    </div>
                    <div id="pagock" style="display:none;">
                      
                    <div class="form-group">
                         <div class="input-group">
                             <span class="input-group-addon">
                                <i class="fa fa-credit-card"></i>
                            </span>
                           <?php echo form_input($cheque); ?>
                         </div>
                     </div>
                    </div>
               </div>

              
                <div class="col-md-5 col-md-offset-0" >
                 <div class="form-group">
                          <div class="input-group">
                              <span class="input-group-addon">
                                <i class="fa fa-list"></i>
                              </span>
                            <select class="form-control" id="formapago" name="formapago" onchange="formapagos(this);">
                               <option value="EF" >Efectivo</option>
                               <option value="CQ" >Cheque</option>
                               <option value="TA" >Tarjeta</option>
                            </select>
                        </div>
                    </div>
                  <div id="pagob" style="display:none;">
                  <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-keyboard-o"></i>
                          </span>
                          <?php echo form_input($cuenta); ?>
                        </div>
                    </div>
                   <div class="form-group" >
                       <div class="input-group" >
                            <span class="input-group-addon">
                              <i class="fa fa-university"></i>
                            </span>
                            <select class="form-control" id="Banco" name="Banco">
                                 <option value="" <?php //echo ($Banco=='')?'selected':'';?>>Elegir Banco</option>
                               <?php foreach($Bancos as $r):?>
                                  <option value="<?=$r->Codigo?>" <?php //echo ($Banco==$r->Codigo)?'selected':''; ?> ><?=$r->Descripcion;?></option>
                               <?php endforeach;?> 
                            </select>
                        </div>
                    </div>
                        
          </div><div id="pagota" style="display:none;">
                    <div class="form-group">
                       <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-list"></i>
                          </span>
                           <select class="form-control" id="tipotarjeta" name="tipotarjeta">
                             <option value="" <?php //echo ($tipotarjeta=='')?'selected':''; ?>>Tipo De Tarjeta</option>
                             <option value="C" <?php //echo ($tipotarjeta=='C')?'selected':''; ?>>Cr&eacute;dito</option>
                             <option value="D" <?php //echo ($tipotarjeta=='D')?'selected':''; ?>>D&eacute;bito</option>
                           </select>
                        </div>
                    </div>  
</div>
                    
              </div>

              <div class="col-md-10 col-md-offset-1" >
                 <div class="form-group" >
                     <div class="input-group" >
                        <span class="input-group-addon" >
                          <i class="fa fa-file-text-o"></i>
                        </span>
                        <?php echo form_input($concepto); ?>
                      </div>
                 </div>
             </div>

       <div class="col-md-10 col-md-offset-1" >
            <div class="form-group" >
            <legend style="text-align:center;">Detalle Cobro </legend>
                     
               <div id="panel" class="table-responsive" >
                     <table class="table table-bordered">
                        <thread>
                          <tr>
                            <th>Concepto</th>
                            <th>Fecha Vencimiento</th>
                            <th>Balance</th>
                            <th>Pagado</th>
                            <th>Balance Total</th>
                          </tr>
                          </thread>
                          <tbody>
                            <tr>
                              <td>Cargo enero 2015</td>
                              <td>03/04/2016</td>
                              <td>2,000.00</td>
                              <td>1.00</td>
                              <td>1,999.00</td>
                            </tr>
                            <tr>
                              <td>Cargo enero 2015</td>
                              <td>03/04/2016</td>
                               <td>2,000.00</td>
                              <td>1.00</td>
                              <td>1,999.00</td>
                            </tr>
                            <tr>
                              <td>Cargo enero 2015</td>
                              <td>03/04/2016</td>
                               <td>2,000.00</td>
                              <td>1.00</td>
                              <td>1,999.00</td>
                            </tr>
                          </tbody>
                      </table>
                      </div>
                    <!--  <button style="background-color:#B96007;color:#000;" aria-label="Left Align">Pagar</button>
              --><div class="col-md-offset-0" style="width: 41.66666667%; margin:0 auto;" >
         <div class="control-group" >
                    
                    <div class="controls" >

                       <?php echo form_button(array('type'=>'submit', 'content'=>' Pagar',  'id' => 'fenviar', 'class'=>'btn btn-lg btn-info btn-block')); ?>
                    </div> <!--
                    <button onclick="imprimir()">Call me</button>
                   
                    <a href="javascript:void(0)" class="btn btn-info btn-xs" title="Pagar" class="text-info"
                       onclick="modal('','<?= base_url().'imprimir()'?>','.modal-body','.modal','')">facturar </a>
                   -->   
              
            </div>
        </div>
              </div>
            </div>
        </div>


      </div>
          
      </div><!-- col-lg-12-->
    </div><!-- /row --> 
  </section>
</section> 

<script>
  function formapagos(sel)
{
    if (sel.value=="EF")
    {
       divC = document.getElementById("pagock");
       divC.style.display = "none";

       divT = document.getElementById("pagota");
       divT.style.display = "none";

       divT = document.getElementById("pagob");
       divT.style.display = "none";
    }

    if (sel.value=="CQ")
    {
       divC = document.getElementById("pagock");
       divC.style.display = "";

       divT = document.getElementById("pagota");
       divT.style.display = "none";

       divT = document.getElementById("pagob");
       divT.style.display = "";
    }

    if (sel.value=="TA") {
        divC = document.getElementById("pagock");
       divC.style.display = "";

       divT = document.getElementById("pagota");
       divT.style.display = "";

       divT = document.getElementById("pagob");
       divT.style.display = "";
    }
}

</script>