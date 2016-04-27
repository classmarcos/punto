<!--<?php 
  if(isset($filas["error"]))
  {
      echo "Actualmente no hay Registros";
  }
  else
  {
  ?>
 
<style type="text/css">
 /* #panel {
    overflow-x:auto;
    overflow-y: auto;
  }
  #panel thead  {
    
  position: fixed;
  top: 150px;
  width:1090px;
  z-index: 100;
  background-color: white;
  padding-top: 10px;
  }

  @media (max-width: 767px){
    #panel {
    
    overflow-x:auto;
    height: 350px;
    overflow-y: auto;

    }
  }
tbody tr:nth-child(odd) {
   background-color: #fff;
}
tbody tr:nth-child(even) {
   background-color: #C4C3C1;
}
*/


/*@media (max-width: 767px){
  table{
    max-height: 20vh; 
  }
  th,td{
    padding: 0px;
  }
}*/
/*table{
    /*border-spacing: 0*/
      /* display: flex;/*Se ajuste dinamicamente al tamano del dispositivo**/
    /*max-height: 60vh; /*El alto que necesitemos**/
   /* overflow-y: auto; /**El scroll verticalmente cuando sea necesario*/
    /*overflow-x: auto;*//*hidden;Sin scroll horizontal*/
   /* table-layout: fixed;/**Forzamos a que las filas tenga el mismo ancho**/
    /*width: 98vw;*/ /*El ancho que necesitemos*/
    /*border:1px solid gray;
}*/

/*thead{
    background-color: #f1eee9;
    position: fixed !important;/*el thead va ser siempre estatico**/

   /* overflow-x: auto;*/
/*}*/

#panel {
  /* overflow-x: auto;*/

}

/*th{
    border-bottom: 1px solid #c4c0c9;
    border-right: 1px solid #c4c0c9;
}*/

th,td{
    /*font-weight: normal;
    margin: 0;
    max-width: 18.5vw; /**Ancho por celda*/
    /*min-width: 18.5vw;/**Ancho por celda*/
    /*word-wrap: break-word;/*Si el contenido supera el tamano, adiciona a una nueve linea**/
    /*font-size: 11px;
    height: 3.5vh !important;/*El mismo alto para todas las celdas**/
   /* padding: 4px;*/
   /*border-right: 1px solid #c4c0c9;*/
}
/*tr:nth-child(2n) {
    background: none repeat scroll 0 0 #edebeb;

} */  
/*.table-fixed thead {
  width: 100%;
}
.table-fixed tbody {
  height: 230px;
  overflow-y: auto;
  width: 100%;
}
.table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th {
  display: block;
}
.table-fixed tbody td, .table-fixed thead > tr> th {
  float: left;
  border-bottom-width: 0;
}*/
 /*thead, tbody { display: block; }
 tbody {
    height: 200px;
    overflow-y: auto;
    overflow-x: auto;
}*/
</style>-->

<!--class="table table-user-information" class="form-panel"-->
 
<!-- cabecera estatica[error]-->
 <style type="text/css">
  /*#tabla tr {
    width: 100%;
    display: inline-table;
  }*/
 
  /*table{
    height:300px; 
  }*/
  thead{
    background-color: #F17A25;
  }
  /*#tabla tbody{
    overflow-y: scroll;
    height: 300px;
    width: 100%;
    position: absolute;
  }*/


 </style>

<div class="col-md-8 col-lg-12" >
    <div id="panel" class="table-responsive" >
      <table id="tabla" class="table table-user-information " >
    <thead> 
    <tr>
        <th width="10%">Contrato</th>
        <th width="10%">Nombres</th>
        <th width="10%">C&eacute;dula</th>
        <th width="10%">Direcci&oacute;n</th>
        <th width="10%" style="text-align:right;">Balance</th>
        <th width="10%" style="text-align:right;">Balance Caja</th>
        <th width="10%">Estatus</th>
      <td width="10%" align="center"><span class="glyphicon glyphicon-cog"></span></td>
    </tr>
    </thead> 
    <tbody>
    <!--<tr>
      <td colspan="5">&nbsp;</td>
    </tr>-->
    <?php foreach($filas as $r):?>
    

    <tr>
        <td id="contrato"><?= $r->Contrato?></td>
        <td><?= $r->Nombre?></td>
        <td><?= $r->Cedula?></td>
        <td><?= $r->Direccion?></td>
        <td style=" text-align:right;" > 
           <a href="javascript:void(0)" onclick="modal('fila=<?php echo $r->Contrato.';'.$r->Balance.';'.$r->BalanceCaja ?>','<?php echo base_url(); ?>clientes/mostrarDetalle','.modal-body','.modal','','Detalle de Pendientes')"><span class="badge bg-theme" ><div id="cuarto"><?= $r->Balance?></div></span></a>
        </td>
         <td style=" text-align:right;" ><?= $r->BalanceCaja?></td>
        <td><?= $r->Estatus?>  </td>

        <td align="center">
      <div class="input-group-btn">
            <button type="button" class="btn  dropdown-toggle btn-info btn-xs" style="border-radius: 3px 3px 3px 3px;-moz-border-radius: 3px 3px 3px 3px;-webkit-border-radius: 3px 3px 3px 3px;" 
                data-toggle="dropdown">Pagar<span class="caret"></span>
             </button>
            
            <ul class="dropdown-menu pull-right" role="menu">
              <li> 
                <a href="javascript:void(0)"  title="Pagar Mensualidad" class="text-info"
                  onclick="modal('fila=<?=$r->Contrato.';'.$r->Nombre.';'.$r->Cedula.';'.$r->Estatus.';'.$r->Direccion.';'.($r->Balance-$r->BalanceCaja).';1;'.$r->Mensualidad.';'.$r->Balance?>','<?= base_url().'clientes/pagar'?>','.modal-body','.modal','','Pago Mensualidad')">Mensualidad </a>
              </li>

              <?php if($r->BalanceCaja>0){ ?>
              <li>
                <a href="javascript:void(0)"  title="Pagar Caja" class="text-info"
                 onclick="modal('fila=<?=$r->Contrato.';'.$r->Nombre.';'.$r->Cedula.';'.$r->Estatus.';'.$r->Direccion.';'.$r->BalanceCaja.';2;0'.';'.$r->Balance?>','<?= base_url().'clientes/pagar'?>','.modal-body','.modal','','Pago Caja Digital')">Caja Digital</a>
             </li>
              <?php } if(in_array($r->CodigoEstatus, array(1,4,5,12,13))) { ?>
              <li>
                <a href="javascript:void(0)"  title="Pagar Reconexi&oacute;n" class="text-info"
                 onclick="modal('fila=<?=$r->Contrato.';'.$r->Nombre.';'.$r->Cedula.';'.$r->Estatus.';'.$r->Direccion.';200;3;0'.';'.$r->Balance?>','<?= base_url().'clientes/pagar'?>','.modal-body','.modal','','Pago Reconexi&oacute;n')">Reconexi&oacute;n </a>
              </li>
              <?php } ?>
            </ul>
          </div>
        </td>
      </tr>
      <?php endforeach;?>  
      </tbody> 
    </table> 
  </div>
 <!--<?php } ?>-->
</div>
<!--<script src="<?php echo base_url('assets/js/jquery-1.8.3.min.js')?>"></script>
<script src="<?php echo base_url('public/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('public/js/jquery.dataTables.min.js')?>"></script>
-->
<script language="javascript">

//var table;

/*$(document).ready(function() {

    //datatables
    table = $('#tabla').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "scrollY": 200,
        "scrollX": true,
        // Load data for the table's content from an Ajax source
        "ajax": {
            //"url": "<?php echo site_url('person/ajax_list')?>",
            //"type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],

    });
});*/

 
 // alert($("#contrato").text());
  //$("#cuarto").text('200');
/*if($("#contrato").text()=="A0000301A"){
  alert($("#contrato").text());
  document.getElementById("cuarto").innerHTML = '200';
}*/


/*function format(input)//formatear los numeros
{
var num = input.value.replace(/\./g,'');
if(!isNaN(num)){
num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1,');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
input.value = num;
}
 
else{ //alert('Solo se permiten numeros');
input.value = input.value.replace(/[^\d\.]*//*g,'');
}
}*/

</script>
