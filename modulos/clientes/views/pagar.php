<div class="container">
    <div class="row row-space">
        <ol class="breadcrumb" id="breadcum-custom">
            <li><a href="<?php echo base_url();?>index.php/busquedacliente/index">Inicio</a></li>
            <li class="active">Pago Servicios a clientes</li>
        </ol>

        <div id="div-foto">
            <h3>Pago Servicios a Clientes</h3>
        </div>
    </div>

    <div class="row row-space">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-6">
            <div class="panel panel-default panel-primary text-primary">
                <div class="panel-heading text-center">Datos clientes</div>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Cliente: </strong><?=  $basic_info['Nombre']; ?>
                    </li>
                    <li <?= $basic_info['Estatus'] == "DESCONECTADO" ? "class='list-group-item red'" : "class='list-group-item'"  ?>><strong>Estatus: </strong><?=  $basic_info['Estatus']; ?>
                    </li>
                    <li class="list-group-item"><strong>Contrato: </strong><?php echo $basic_info['Contrato']; ?>
                    </li>
                    <li class="list-group-item"><strong>Cedula: </strong><?php echo $basic_info['Cedula']; ?>
                    </li>
                    <li class="list-group-item"><strong>Dirección: </strong><?php echo $basic_info['Direccion']; ?>
                    </li>
                    <li class="list-group-item">
                        <?php
                        $type_array = array('0' => 'Pago Mensualidad','1' => 'Caja Digital');
                        if(in_array($basic_info['CodigoEstatus'], array(1,4,12,13)))
                            $type_array[] = 'Pago de Reconexión';

                        ?>
                        <div class="form-group">

                            <label class="control-label negro" for="accionselect">Acción: </label>
                            <select id="accionselect" class="form-control">
                                <?php
                                foreach ($type_array as $key => $value) {
                                    echo '<option value="' . $key . '">'. $value . '</option>';
                                } ?>
                            </select>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-6">
            <div class="panel panel-default panel-danger text-danger">
                <div class="panel-heading text-center">Detalle de pendientes</div>
                <div class="table-responsive" id="pn-g"></div>
            </div>
            <h4 class="pull-right currency" id="balance_generado"></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="panel panel-default panel-success text-success">
                <div class="panel-heading text-center">Pagos</div>
                <div class="panel-body">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h3 class="text-center" id="generated_sumbalance"></h3>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="InputMontoPagar">Monto a pagar</label>
                        <input type="number" class="form-control" id="InputMontoPagar" placeholder="Monto a pagar">
                    </div>
                    <button type="button" class="btn btn-default pull-right btn-success" id="btn_pagar">Pagar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="infomodal" tabindex="-1" role="dialog" aria-labelledby="LabelModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="LabelModal"></h4>
                </div>
                <div class="modal-body" id="BodyModal">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <span id="modalFooter"></span>
                </div>
            </div>
        </div>
    </div>
</div>



<!--<ol class="breadcrumb">
  <li><a href="<?php echo base_url();?>index.php/busquedacliente/index">Inicio</a></li>
  <li class="active">Pago Servicios a clientes</li>
</ol>
<div class="jumbotron">
  <h1>Pago Servicios a clientes</h1>
</div>

<div class="row" style="margin-top: 1em;">
	<div class="col-md-4 col-md-offset-6" id="contenedor_botones_superior">
		<ul>
			<li>
		<?php
$type_array = array('0' => 'Hoja A4','1' => 'Hoja Star');
echo "<label for='type_printer'>Tipo Hoja:</label>";
echo form_dropdown('type_printer', $type_array, '');?>
			<button name='btn_reimprimir_factura' role='button' class="btn btn-primary">Reimprimir Ultima Factura</button></li>
		</ul>
	</div>
</div>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<ul class="well well-sm" id="contenedor_datos_cliente">
			<li><label>Cliente: <?=  $basic_info['Nombre']; ?></label></li>
			<li><label>Contrato: <?php echo $basic_info['Contrato']; ?></label></li>
			<li><label>Cedula: <?php echo $basic_info['Cedula']; ?></label></li>
			<li><label>Direccion: <?php echo $basic_info['Direccion']; ?></label></li>
			<li>
			<?php
$type_array = array('0' => 'Pago Mensualidad','1' => 'Caja Digital');
if(in_array($basic_info['CodigoEstatus'], array(1,4,12,13)))
    $type_array[] = 'Pago de Reconexión';
echo "<label for='type'>Accion a realizar:</label>";
echo form_dropdown('type', $type_array, '');
?>
			</li>
		</ul>
	</div>
</div>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<table id="lista"></table> 
		<span class="generated_balance" id="generated_sumbalance"></span>
	</div>
</div>

<div class="row">
	<div class="col-md-7 col-md-offset-2">
		<div class="col-md-2"><label class="control-label" for='txt_monto_pago'>Monto a pagar:</label></div>
		<div class="col-md-4"><input type='number' class="number form-control" name='txt_monto_pago' /></div>
		<div class="col-md-1"> <button name='btn_pagar_monto' role='button' class="btn btn-primary">Pagar</button></div>
	</div>
</div>  -->

<?php if (isset($pagos_adelantados) && $pagos_adelantados) {
    echo '<form id="form_pagos_adelantados" action="' . site_url('cliente/pagos_adelantados/') .'" method="post">
                        <input type="hidden" name="contrato" value="' . $pagos_adelantados . '">
                   </form> '; }?>

<?php if (isset($extensiones) && $extensiones) {
    echo '<form id="form_extensiones" action="' . site_url('cliente/extensiones/') .'" method="post">
                        <input type="hidden" name="contrato" value="' . $basic_info['Contrato'] . '">
                        <input type="hidden" name="nombre" value="' . $basic_info['Nombre']  . '">
                        <input type="hidden" name="cedula" value="' . $basic_info['Cedula']  . '">
                        <input type="hidden" name="direccion" value="' . $basic_info['Direccion'] . '">
                   </form> '; }?>

                 