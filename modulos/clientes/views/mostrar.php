<section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
<?php 
  if(isset($filas["error"]))
  {
      echo "Actualmente no hay usuarios Registrados";
  }
  else
  {
  ?>
  

<a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="mostrar('','<?php echo base_url(); ?>clientes/formulariobusquedacliente','#resultado')"><i class="fa fa-search"></i> Buscar Usuario</a>

<div class="table-responsive">
<table class="table table-bordered">
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
        

        <td align="center">
            <ul class="tooltip-gestion list-inline">
                <li><a href="javascript:void(0)" class="btn btn-info btn-xs" title="Pagar" class="text-info" onclick="modal('idCliente=<?php echo $r->id; ?>','<?= base_url().'clienes/editar_usuario'?>','.modal-body','.modal','')">Pagar</a></li>  
            </ul>
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
</section>
</section>