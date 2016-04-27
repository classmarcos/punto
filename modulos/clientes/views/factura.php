

<div id="imprision" style=" font-family:Arial; display:none; margin: 0em;padding: 0em; ">
 <div style="text-align: center; margin-top: 0px; padding:0;font-size:12px; font-family:Arial;">
  <span ><strong>TELEOPERADORA DEL NORDESTE</strong></span><br />
  <span ><strong>(TELENORD)</strong></span><br />
  <span ><strong>V. FRANK GRULLON #5</strong></span><br />
  <span ><strong>SAN FRANCISCO DE MACOR&Iacute;S</strong></span><br />
  <span ><strong>Tel: 809-588-6238 Fax: 809-588-0105</strong></span><br />
  <span ><strong>RNC: 104-01619-1</strong></span><br />
</div>

<div style="text-align: right;">
 <span style="font-size:12px;"><?=$fecha?></span><br />
  <span style="font-size:12px;">No.: <?=$TRN?></span>
</div>

<div style="text-align: center;">
  <span style="display: block; font-size:12px;">RECIBO</span>
</div>

<div style="border-top: dashed 2px black; border-bottom: dashed 2px black; ">
  <span style="margin-top: 1em;"><strong style="font-size:12px;">Contrato:</strong></span><span style="margin-top: 1em; font-size:12px;"><?= $Contrato.' - '.$Nombre?></span><br/>
  <span style="margin-top: 1em; padding-bottom: 1em; font-size:12px;"><strong>Balance Anterior:</strong> <?=$Balance?></span>
</div>

<table style="width:100%; border-bottom: dashed 2px black;">
  <tr>
    <th style="width:40%; text-align:left;font-size:12px;">Concepto</th>
    <th style="width:30%; text-align:left;font-size:12px; ">Monto Pagado</th>
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
    <td style="width:70%; text-align:left; font-size:12px;"><strong >Monto Total Recibido</strong></td>
    <td style="width:30%; text-align:left; font-size:12px;"><div style="width: 40%; margin:0; padding:0; text-align: right;"><?= $Montoapagar?></div></td>
  </tr>
  <tr>
    <td style="width:70%; text-align:left; font-size:12px;"><strong>Pendiente</strong></td>
    <td style="width:30%; text-align:left; "><div style="width: 40%; margin:0; padding:0; text-align: right;font-size:12px;"><?=$Balance-$Montoapagar?></div></td>
  </tr>
</table>

<div style="text-align: center;  ">
  <span style="display: block; font-size:12px;">GRACIAS POR SU PAGO</span>
</div>

<div style="text-align: center;  ">
  <span style="display: block; font-size:12px;">Le atendio:<STRONG><?=$usuario?></STRONG></span>
</div>

<div style="text-align: center; ">
  <span style="display: block; font-size:12px;"><STRONG>*ABONO A FACTURA NO EVITA CORTE*</STRONG></span>
</div>
<!-- 

<div style="text-align: right;">
  <span style="">@date@</span><br />
  <span style="">Recibo #: <?=$TRN?></span>
</div>

<div style="text-align: center; margin-top: -25px; padding:0;">
  <span style="font-size: 1.5em;"><strong>TELEOPERADORA DEL NORDESTE</strong></span><br />
  <span style="font-size: 1.5em;"><strong>(TELENORD)</strong></span><br />
  <span style="font-size: 1.2em;"><strong>V. FRANK GRULLON #5</strong></span><br />
  <span style="font-size: 1.2em;"><strong>SAN FRANCISCO DE MACOR&Iacute;S</strong></span><br />
  <span style="font-size: 1.2em;"><strong>Tel: 809-588-6238 Fax: 809-588-0105</strong></span><br />
  <span style="font-size: 1.2em;"><strong>RNC: 104-01619-1</strong></span><br />
</div>

<div style="text-align: center;  margin-top: 2em;">
  <span style="display: block; font-size: 1.5em;">RECIBO</span>
</div>

<div style="border-top: dashed 1px black; border-bottom: dashed 1px black; margin-top: 1em;">
  <span style="margin-top: 1em;"><strong>Contrato:</strong><?= $Contrato.' - '.$Nombre?></span><br/>
  <span style="margin-top: 1em; padding-bottom: 1em;"><strong>Balance Anterior:</strong> <?=$Balance?></span>
</div>

<table style="width:100%; border-bottom: dashed 1px black; font-size: 1.2em;">
  <tr>
    <th style="width:70%; text-align:left;">Concepto</th>
    <th style="width:30%; text-align:left;">Monto Pagado</th>
  </tr>
</table>

<table style="width:100%; border-bottom: dashed 1px black;">
  @table_body@
</table>

<table style="width:100%; border-bottom: dashed 1px black;">
  <tr>
    <td style="width:70%; text-align:left;"><strong>Monto Total Recibido</strong></td>
    <td style="width:30%; text-align:left;"><div style="width: 40%; margin:0; padding:0; text-align: right;"><?= $Montoapagar?></div></td>
  </tr>
  <tr>
    <td style="width:70%; text-align:left;"><strong>Pendiente</strong></td>
    <td style="width:30%; text-align:left;"><div style="width: 40%; margin:0; padding:0; text-align: right;"><?=$Balance-$Montoapagar?></div></td>
  </tr>
</table>

<div style="text-align: center;  margin-top: 2em;">
  <span style="display: block; font-size: 1.5em;">GRACIAS POR SU PAGO</span>
</div>

<div style="text-align: center;  margin-top: 2em;">
  <span style="display: block; font-size: 1.5em;">Le atendio:<STRONG><?=$usuario?></STRONG></span>
</div>

<div style="text-align: center;  margin-top: 2em;">
  <span style="display: block; font-size: 1.5em;"><STRONG>*ABONO A FACTURA NO EVITA CORTE*</STRONG></span>
</div>
-->
</div>

<script Language="Javascript">

 //function imprimir(){
 var objeto=document.getElementById('imprision');  //obtenemos el objeto a imprimir
  var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
  ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
  ventana.document.close();  //cerramos el documento
  ventana.print();  //imprimimos la ventana
  ventana.close();  //cerramos la ventana
$(".modal").modal('hide');
//window.print();
//$("#impresion").printElement();





</script>

