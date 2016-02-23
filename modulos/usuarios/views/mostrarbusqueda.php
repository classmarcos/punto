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
      <table class="table table-user-information">
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
                    <a href="javascript:void(0)" class="btn btn-info btn-xs" title="Editar Usuario" class="text-info"
                       onclick="modal('Contrato=<?= $r->Contrato?>','<?= base_url().'usuarios/editar_usuario'?>','.modal-body','.modal','')">Editar </a>
                </li>

                <li><a href="javascript:void(0)" class="btn btn-danger btn-xs" title="Borrar Usuario" class="text-danger" onclick="borrar('#resultado','<?php echo base_url();?>usuarios/borrarusuario','id=<?php echo $r->Contrato; ?>','<?php echo base_url(); ?>usuarios/mostrar')">Eliminar</a></li>

                <?php if ($r->AC == -1)
                {
                    ?>
                    <li><a href="javascript:void(0)" class="btn btn-warning btn-xs" title="Inabilitar Usuario" class="text-danger" onclick="filtros('inhabilitar=<?php echo $r->Contrato;?>','<?php echo base_url()?>usuarios/habiliatinabilitarusuario','#resultado')">Inhabilitar</a></li>
                    <?php
                }
                else
                {?>
                    <li><a href="javascript:void(0)" class="btn btn-default btn-xs" title="Habilitar Usuario" class="text-danger" onclick="filtros('habilitar=<?php echo $r->Contrato;?>','<?php echo base_url()?>usuarios/habiliatinabilitarusuario','#resultado')">Habilitar</a></li>
                    <?php
                }?>
            </ul>
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
