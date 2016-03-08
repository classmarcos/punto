<div style="text-align: center; margin-top: 0px; padding:0;">
  <span style="font-size: 110%;"><strong>TELEOPERADORA DEL NORDESTE</strong></span><br />
  <span style="font-size: 110%"><strong>(TELENORD)</strong></span><br />
  <span style="font-size: 100%"><strong>V. FRANK GRULLON #5</strong></span><br />
  <span style="font-size: 100%"><strong>SAN FRANCISCO DE MACORIS</strong></span><br />
  <span style="font-size: 100%"><strong>Tel: 809-588-6238 Fax: 809-588-0105</strong></span><br />
  <span style="font-size: 100%"><strong>RNC: 104-01619-1</strong></span><br />
</div>

<div style="text-align: right;">
  <span style="font-size: 110%">@date@</span><br />
  <span style="font-size: 110%">No.: @id_invoice@</span>
</div>

<div style="text-align: center;  margin-top: 2em;">
  <span style="display: block; font-size: 100%;">RECIBO</span>
</div>

<div style="border-top: dashed 2px black; border-bottom: dashed 2px black; margin-top: 1em;">
  <span style="margin-top: 1em; font-size: 100%;"><strong>Contrato:</strong> <?php $Contrato.'-'.$Nombre?></span><br/>
  <span style="margin-top: 1em; padding-bottom: 1em; font-size: 100%;"><strong>Balance Anterior:</strong> <?=$Balance?></span>
</div>

<table style="width:100%; border-bottom: dashed 2px black; font-size: 1.2em;">
  <tr>
    <th style="width:70%; text-align:left; font-size: 10%;">Concepto</th>
    <th style="width:30%; text-align:left; font-size: 10%;">Monto Pagado</th>
  </tr>
</table>
<!--
<table style="width:100%; border-bottom: dashed 2px black;">
  @table_body@
</table>
-->
<table style="width:100%; border-bottom: dashed 2px black;">
  <tr>
    <td style="width:70%; text-align:left; font-size: 100%;"><strong>Monto Total Recibido</strong></td>
    <td style="width:30%; text-align:left; font-size: 100%;"><div style="width: 40%; margin:0; padding:0; text-align: right;">@total@</div></td>
  </tr>
  <tr>
    <td style="width:70%; text-align:left; font-size: 100%;"><strong>Pendiente</strong></td>
    <td style="width:30%; text-align:left; font-size: 100%;"><div style="width: 40%; margin:0; padding:0; text-align: right;">@VPendiente@</div></td>
  </tr>
</table>

<div style="text-align: center;  margin-top: 2em;">
  <span style="display: block; font-size: 105%;">GRACIAS POR SU PAGO</span>
</div>

<div style="text-align: center;  margin-top: 2em;">
  <span style="display: block; font-size: 105%;">Le atendio:<STRONG>@cobrador@</STRONG></span>
  
</div>

<div style="text-align: center;  margin-top: 2em;">
  <span style="display: block; font-size: 105%;"><STRONG>*ABONO A FACTURA NO EVITA CORTE*</STRONG></span>
</div>

