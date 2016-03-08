<?php 
  if(isset($filas["error"]))
  {
      echo "Actualmente no hay Registros";
  }
  else
  {
  ?>

<div class="col-md-8 col-lg-12">
    <div class="form-panel">
      <table id="tabla" class="table table-user-information">
    <thead> 
    <tr>
        <th width="10%">Contrato</th>
        <th width="10%">Nombres</th>
        <th width="10%">C&eacute;dula</th>
        <th width="10%">Direcci&oacute;n</th>
        <th width="10%">Balance</th>
        <th width="10%">Estatus</th>
        <th width="10%">C&oacute;digo Estatus</th>
        <th width="10%">Balance Caja</th>
        <th width="10%">AC</th>
        <td width="10%" align="center"><span class="glyphicon glyphicon-cog"></span></td>
    </tr>
    </thead> 
    <?php foreach($filas as $r):?>
    <tbody> 
    <tr>
        <td><?= $r->Contrato?></td>
        <td><?= $r->Nombre?></td>
        <td><?= $r->Cedula?></td>
        <td><?= $r->Direccion?></td>
        <td> 
           <a href="javascript:void(0)" onclick="modal('fila=<?php echo $r->Contrato.';'.$r->Balance.';'.$r->BalanceCaja ?>','<?php echo base_url(); ?>clientes/mostrarDetalle','.modal-body','.modal','','Detalle de Pendientes')"><span class="badge bg-theme"><?=$r->Balance?></span></a>
        </td>
        <td><?= $r->Estatus?> </td>
        <td><?= $r->CodigoEstatus?> </td>
        <td><?= $r->BalanceCaja?> </td>
        <td><?= $r->AC?> </td>


        <td align="center">
            <ul class="tooltip-gestion list-inline">
                <li>
                 <div class="input-group-btn">
        <button type="button" class="btn  dropdown-toggle btn-info btn-xs"
                data-toggle="dropdown">
          Pagar<span class="caret"></span>
        </button>
        
        <ul class="dropdown-menu" role="menu">
          <li> <a href="javascript:void(0)" class="btn btn-xs" title="Pagar Mensualidad" class="text-info"
                       onclick="modal('fila=<?=$r->Contrato.';'.$r->Nombre.';'.$r->Cedula.';'.$r->Estatus.';'.$r->Direccion.';'.($r->Balance-$r->BalanceCaja).';1'?>','<?= base_url().'clientes/pagar'?>','.modal-body','.modal','','Pago Mensualidad')">Mensualidad </a>
              </li>
          <li><a href="javascript:void(0)" class="btn btn-xs" title="Pagar Caja" class="text-info"
                       onclick="modal('fila=<?=$r->Contrato.';'.$r->Nombre.';'.$r->Cedula.';'.$r->Estatus.';'.$r->Direccion.';'.$r->BalanceCaja.';2'?>','<?= base_url().'clientes/pagar'?>','.modal-body','.modal','','Pago Caja Digital')">Caja Digital</a>
             </li>
             <?php
           
              if(in_array($r->CodigoEstatus, array(1,4,5,12,13)))
                {
        ?>
          <li><a href="javascript:void(0)" class="btn btn-xs" title="Pagar Reconexi&oacute;n" class="text-info"
                       onclick="modal('fila=<?=$r->Contrato.';'.$r->Nombre.';'.$r->Cedula.';'.$r->Estatus.';'.$r->Direccion.';200;3'?>','<?= base_url().'clientes/pagar'?>','.modal-body','.modal','','Pago Reconexi&oacute;n')">Reconexi&oacute;n </a>
             </li>
          <?php }?>
        </ul>
      </div><!--
                    <a href="javascript:void(0)" class="btn btn-info btn-xs" title="Pagar" class="text-info"
                       onclick="modal('fila=<?=$r->Contrato?>','<?= base_url().'clientes/pagar'?>','.modal-body','.modal','')">Pagar </a>
               --> </li>

        </td>

    </tr>
    </tbody> 
    <?php endforeach;?>  
</table> 
</div>


  
 <?php    
  }
  ?>
  </div>
</div>
