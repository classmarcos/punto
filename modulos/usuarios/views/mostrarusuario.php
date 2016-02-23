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

  

<a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="mostrar('','<?php echo base_url(); ?>usuarios/registrarusuario','#resultado')"><i class="fa fa-user"></i> Crear Usuario</a>

<a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="mostrar('','<?php echo base_url(); ?>usuarios/buscarusuario','#resultado')"><i class="fa fa-search"></i> Buscar Usuario</a>

<div class="table-responsive">
<table class="table table-bordered">
    <thead> 
    <tr>
        <th width="2%">ID</th>
        <th width="10%">NOMBRE</th>
        <th width="10%">APELLIDO</th>
        <th width="10%">USUARIO</th>
        <th width="10%">CORREO</th>
        <th width="10%">TIPO OPERADOR</th>
        <td width="15%" align="center"><span class="glyphicon glyphicon-cog"></span></td>
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

        <td align="center">
            <ul class="tooltip-gestion list-inline">
                <li><a href="javascript:void(0)" class="btn btn-default btn-xs" title="Editar Usuario" class="text-info" onclick="modal('id=<?php echo $r->id; ?>','<?= base_url().'usuarios/editar_usuario'?>','.modal-body','.modal','')"><span class="glyphicon glyphicon-edit"></span></a></li>

                <li><a href="javascript:void(0)" class="btn btn-default btn-xs" title="Borrar Usuario" class="text-danger" onclick="eliminar('<?php echo $r->id; ?>')"><i class="fa fa-trash"></i></a></li>

                 <li><a href="javascript:void(0)" class="btn btn-default btn-xs" title="Habilitar Usuario" class="text-danger" onclick="eliminar('<?php echo $r->id; ?>')"><i class="fa fa-user-plus"></i></a></li>

                <li><a href="javascript:void(0)" class="btn btn-default btn-xs" title="Inabilitar Usuario" class="text-danger" onclick="eliminar('<?php echo $r->id; ?>')"><i class="fa fa-user-times"></i></a></li>

                <li><a href="javascript:void(0)" class="btn btn-default btn-xs" title="Movimientos Usuario" class="text-danger" onclick="eliminar('<?php echo $r->id; ?>')"><i class="fa fa-bar-chart"></i></a></li>
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
</section>
</section>