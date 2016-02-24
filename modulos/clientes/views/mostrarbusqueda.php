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
        <th width="10%">Cedula</th>
        <th width="10%">Direccion</th>
        <th width="10%">Balance</th>
        <th width="10%">Estatus</th>
        <th width="10%">Codigo Estatus</th>
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
        <td><?= $r->Balance?></td>
        <td><?= $r->Estatus?> </td>
        <td><?= $r->CodigoEstatus?> </td>
        <td><?= $r->BalanceCaja?> </td>
        <td><?= $r->AC?> </td>


        <td align="center">
            <ul class="tooltip-gestion list-inline">
                <li>
                    <a href="javascript:void(0)" class="btn btn-info btn-xs" title="Pagar" class="text-info"
                       onclick="modal('Contrato=<?= $r->Contrato?>','<?= base_url().'clientes/pagar'?>','.modal-body','.modal','')">Pagar </a>
                </li>

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
