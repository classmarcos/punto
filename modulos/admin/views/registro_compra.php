<?php
$concepto = array(
    'name' => 'concepto',
    'id' => 'concepto',
    'value' => set_value('concepto'),
    'class'       => 'form-control',
    'placeholder' => 'Concepto de comprar',
);

$numero_factura = array(
    'name' => 'numero_factura',
    'id' => 'numero_factura',
    'value' => set_value('numero_factura'),
    'class'       => 'form-control',
    'placeholder' => 'Numero de Factura',
);

$numero_control = array(
    'name' => 'numero_control',
    'id' => 'numero_control',
    'value' => set_value('numero_control'),
    'class'       => 'form-control',
    'placeholder' => 'Numero de Factura',
);

$preciounitario = array(
    'name' => 'preciounitario',
    'id' => 'montocompra',
    'value' => set_value('preciounitario'),
    'class'       => 'form-control',
    'placeholder' => 'Precio Unitario',
);

$montocompra = array(
    'name' => 'montocompra',
    'id' => 'montocompra',
    'value' => set_value('montocompra'),
    'class'       => 'form-control',
    'placeholder' => 'Monto a Pagar',
);

$subtotal = array(
    'name' => 'subtotal',
    'id' => 'subtotal',
    'value' => set_value('subtotal'),
    'class'       => 'form-control',
    'placeholder' => 'Sub Total',
    'onfocus'=> 'this.blur();',
    'data-placement'=> 'bottom',
    'data-toggle'=> 'tooltip',
    'data-original-title'=> 'SubTotal',
    'readonly'=> 'true',
    'data-bv-field'=> 'subtotal',
);

$iva = array(
    'name' => 'iva',
    'id' => 'iva',
    'value' => set_value('iva'),
    'class'       => 'form-control',
    'placeholder' => 'Iva',
);

$totalpagar = array(
    'name' => 'montocompra',
    'id' => 'totalpagares',
    'value' => set_value('totalpagar'),
    'class'       => 'form-control',
    'placeholder' => 'Total a Pagar',
    'onfocus'=> 'this.blur();',
    'data-placement'=> 'bottom',
    'data-toggle'=> 'tooltip',
    'data-original-title'=> 'Total',
    'readonly'=> 'true',
    'data-bv-field'=> 'total',
);

?>

<?php $class = array('id' => 'form'); ?>
<?php echo form_open_multipart('',$class, array('enviado' => 'enviado'));?>

<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Registros de Compras</h3>
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel">

                    <!--<ol class="breadcrumb">
                        <li class="active">Registro de Compra</li>
                        <li class="active">Apertura de Caja <i class="fa fa-money"></i> <span class="badge bg-theme">Bs.F.<?php echo APERTURACAJA ?></span></li>
                        <li class="active">Caja chica <i class="fa fa-money"></i> <span class="badge bg-theme">Bs.F.<?php echo CAJACHICA ?></span></li>
                        <li class="active">Monto Maximo <i class="fa fa-money"></i> <span class="badge bg-theme">Bs.F.<?php echo MONTOMAXIMO ?></span></li>
                        <li class="active">Monto Minimo <i class="fa fa-money"></i> <span class="badge bg-theme">Bs.F.<?php echo MONTOMINIMO ?></span></li>
                    </ol>-->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label inputs">Concepto</label>
                                <div class="input-group">
  	                 <span class="input-group-addon">
    	                 <i class="fa fa-pencil-square"></i>
    	               </span>
                                    <?php echo form_input($concepto); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label inputs">Grupos</label>
                                <div class="input-group input-group-sm select2-bootstrap-prepend">
 	               <span class="input-group-addon">
 	                 <i class="fa fa-pencil-square"></i>
 	               </span>
                                    <select name="id_grupos" class="form-control select2" id="selectgrupos"></select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label inputs">Tipo de Pago</label>
                                <div class="input-group">
    	               <span class="input-group-addon">
    	                   <i class="fa fa-table"></i>
    	               </span>
                                    <select name="id_pago" class="form-control" onChange="pagostipos(this)">
                                        <option value="">Seleccione el Tipo de Pago</option>
                                        <option value="Factura">Factura</option>
                                        <option value="Sin factura">Sin Factura</option>
                                    </select>
                                </div>
                                <div id="sinfactura" style="display:none;">
                                    <small>El monto consumible sin factura es <i class="fa fa-money"></i> <?php echo MONTOCONSUMIBLE ?></small>
                                </div>
                            </div>

                            <div id="factura" style="display:none;">
                                <div class="form-group">
                                    <label class="control-label inputs">Numero de Factura</label>
                                    <div class="input-group">
   		                 <span class="input-group-addon">
   		                     <i class="fa fa-sort-numeric-asc"></i>
   		                 </span>
                                        <?php echo form_input($numero_factura); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label inputs">Numero de control</label>
                                    <div class="input-group">
   		                 <span class="input-group-addon">
   		                      <i class="fa fa-sort-numeric-asc"></i>
   		                </span>
                                        <?php echo form_input($numero_control); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label inputs">Fecha de Factura</label>
                                    <div class="input-group">
   		                 <span class="input-group-addon">
   		                     <i class="fa fa-calendar"></i>
   		                 </span>
                                        <input type="text" id="fechafactura" name="fecha_factura" class="form-control" onclick="getTimePicker('#fechafactura')"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label inputs">Precio Unitario</label>
                                <div class="input-group">
  	               <span class="input-group-addon">
  	                   <i class="fa fa-usd"></i>
  	               </span>
                                    <?php echo form_input($preciounitario); ?>
                                </div>
                                <small>Precio por unidad <i class="fa fa-money"></i></small>
                            </div>

                            <div class="form-group">
                                <label class="control-label inputs">Cantidad</label>
                                <div class="input-group">
     	               <span class="input-group-addon">
     	                  <i class="fa fa-pencil-square"></i>
     	               </span>
                                    <select name="cantidad" id="cantidad" class="form-control">
                                        <option value="">Cantidad de producto</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                                <small>Eliga la cantidad <i class="fa fa-money"></i></small>
                            </div>

                            <div class="form-group">
                                <label class="control-label inputs">Sub Total</label>
                                <div class="input-group">
                    <span class="input-group-addon">
                       <i class="fa fa-usd"></i>
                    </span>
                                    <?php echo form_input($subtotal); ?>
                                </div>
                                <small>Sub total <i class="fa fa-money"></i></small>
                            </div>

                            <div class="form-group">
                                <label class="control-label inputs">Impuesto del valor agregado</label>
                                <div class="input-group">
                       <span class="input-group-addon">
                          <i class="fa fa">%</i>
                       </span>
                                    <?php echo form_input($iva); ?>
                                </div>
                                <small>Iva total <div id="ivatotal"></div  <i class="fa fa-money"></i></small>
                                <input type="hidden" id="ivahidden" name="ivatotal" value=""/>
                            </div>

                            <div class="form-group">
                                <label class="control-label inputs">Total a Pagar</label>
                                <div class="input-group">
                      <span class="input-group-addon">
                        <i class="fa fa-usd"></i>
                      </span>
                                    <?php echo form_input($totalpagar); ?>
                                </div>
                                <small>Total de la compra <i class="fa fa-money"></i></small>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-offset-5">
                            <?php echo form_submit('submit','Enviar', 'id="fenviar" class="btn btn-primary"');?>
                            <?php echo form_close(); ?>
                        </div>
                    </div>

                    <script type="text/javascript">
                        $(document).ready(function()
                        {
                            /*Cargo el select de los grupos por ajax y json*/
                            grupos('','#selectgrupos','<?php echo base_url();?>admin/grupos','Seleccionar');

                            /*Funcion para el envio del formulario*/
                            $("#form").submit(function(event)
                            {
                                event.preventDefault();
                                modalshow($("#form").serialize(),'<?php echo base_url(); ?>admin/registro_compras','.modal-body','.modal','<?php echo base_url(); ?>admin/mostrar_registro_caja');
                            });

                            /*Suma la cantidad de productos segun la compra*/
                            $("#cantidad").change(function()
                            {
                                sumar_cantidar();
                            });

                            /*Saca el Porcentage segun la cantidad de la compra*/
                            $("#iva").on('keyup',function()
                            {
                                porcentaje_iva();
                            });
                        });
                    </script>

                </div>
            </div>
        </div><!-- col-lg-12-->
        </div><!-- /row -->
    </section>

