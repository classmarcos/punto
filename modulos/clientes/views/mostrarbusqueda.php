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
        <th width="10%">APELLIDOS</th>
        <th width="10%">CEDULA</th>
        <th width="10%">DIRECCION</th>
        <th width="10%">ESTATUS</th>
         <th width="10%">Pendientes</th>
        <td width="10%" align="center"><span class="glyphicon glyphicon-cog"></span></td>
    </tr>
    </thead> 
    <?php foreach($filas as $r):?>
    <tbody> 
    <tr>
        <td><?= $r->id?></td>
        <td><?= $r->nombre?></td>
        <td><?= $r->apellidos?></td>
        <td><?= $r->cedula?></td>
        <td><?= $r->direccion?></td>
        <td><?= $r->estatus?> </td>
        <td>

         <a href="javascript:void(0)" onclick="modal('idCliente=<?php echo $r->id ?>','<?php echo base_url(); ?>clientes/detallesPedientes','.modal-body','.modal','')"><span class="badge bg-theme"><?php echo $this->global_model->metodoanteguo('deudas','cuente','idCliente',$r->id);?></span></a>
 
        </td>
         <td align="center">
           <a href="javascript:void(0)" class="btn btn-info btn-xs" title="Pagar" class="text-info" onclick="modal('idCliente=<?php echo $r->id; ?>','<?= base_url().'clientes/pagar'?>','.modal-body','.modal','')">Pagar</a>
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
