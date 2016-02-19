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
        <th width="2%">ID</th>
        <th width="10%">NOMBRE</th>
        <th width="10%">APELLIDO</th>
        <th width="10%">USUARIO</th>
        <th width="10%">CORREO</th>
        <th width="10%">TIPO OPERADOR</th>
         <th width="10%">PENDIENTES</th>
        <td width="10%" align="center"><span class="glyphicon glyphicon-cog"></span></td>
    </tr>
    </thead> 
    <?php foreach($filas as $r):?>
    <tbody> 
    <tr>
        <td><?= $r->id?></td>
        <td><?= $r->nombre?></td>
        <td><?= $r->apellido?></td>
        <td><?= $r->usuario?></td>
        <td><?= $r->correo?></td>
        <td>
            <?php if ($r->tipo_operador == 1)
            {
            ?>
              ADMINISTRADOR
            <?php  
            }
            else
            {?>
              OPERADOR
            <?php
            }?>
            
        </td>
        <td>
        <a href="javascript:void(0)" onclick="modal('id=<?php echo $r->id ?>','<?php echo base_url(); ?>usuarios/mostrarDetalle','.modal-body','.modal','')"><span class="badge bg-theme">Detalle</span></a>
        
        <!--
         <a href="javascript:void(0)" class="btn btn-info btn-xs" title="Editar Usuario" class="text-info" onclick="modal('id=<?php echo $r->id; ?>','<?= base_url().'usuarios/mostrarDetalle'?>','.modal-body','.modal','')">Detalle</a>
        -->
        </td>
         <td align="center">
           <a href="javascript:void(0)" class="btn btn-info btn-xs" title="Pagar" class="text-info" onclick="modal('id=<?php echo $r->id; ?>','<?= base_url().'usuarios/editar_usuario'?>','.modal-body','.modal','')">Pagar</a>
        </td>
    </tr>
    </tbody> 
    <?php endforeach;?>  
</table> 
</div>

  <?php echo $paginacion ?>
  
 <?php    
  }
  ?>
  </div>
</div>
