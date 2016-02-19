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


<ol class="breadcrumb">

  <li> usuarios</li>
  <li><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="mostrar('','<?php echo base_url(); ?>usuarios/mostrar','#resultado')"><i class="fa fa-home"></i> Principal</a></li>

  <li><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="filtros('','<?php echo base_url(); ?>usuarios/mostrar','#resultado')"><i class="fa fa-user"></i> Total de usuarios <span class="badge"><?php echo $total_usuarios ?></span></a></li>

  <li><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="filtros('estado=1','<?php echo base_url(); ?>usuarios/mostrar','#resultado')"><i class="fa fa-user"></i> Activos <span class="badge"><?php echo $activos ?></span></a></li>

  <li><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="filtros('estado=2','<?php echo base_url(); ?>usuarios/mostrar','#resultado')"><i class="fa fa-user"></i> Inactivos <span class="badge"><?php echo $inactivos ?></span></a></li>

    <li><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="filtros('grupo=1','<?php echo base_url(); ?>usuarios/mostrar','#resultado')"><i class="fa fa-user"></i> Administrador <span class="badge"><?php echo $admin ?></span></a></li>

  <li><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="filtros('grupo=2','<?php echo base_url(); ?>usuarios/mostrar','#resultado')"><i class="fa fa-user"></i>  Operador <span class="badge"><?php echo $registrados ?></span></a></li>

  
  <li><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="mostrar('','<?php echo base_url(); ?>usuarios/estadistica','#resultado')"><i class="fa fa-line-chart"></i> Estadistica</a></li>
</ol>
  

<a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="mostrar('','<?php echo base_url(); ?>usuarios/registrarusuario','#resultado')"><i class="fa fa-user"></i> Crear Usuario</a>

<a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="mostrar('','<?php echo base_url(); ?>usuarios/formulariobusquedausuario','#resultado')"><i class="fa fa-search"></i> Buscar Usuario</a>

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
        <th width="10%">ESTADO</th>
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
            <?php if ($r->estado == 1)
            {
            ?>
              Usuario Activo
            <?php  
            }
            else
            {?>
              Usuario Inactivo
            <?php
            }?>

         </td>

        <td align="center">
            <ul class="tooltip-gestion list-inline">
                <li><a href="javascript:void(0)" class="btn btn-info btn-xs" title="Editar Usuario" class="text-info" onclick="modal('id=<?php echo $r->id; ?>','<?= base_url().'usuarios/editar_usuario'?>','.modal-body','.modal','')">Editar</a></li>

                <li><a href="javascript:void(0)" class="btn btn-danger btn-xs" title="Borrar Usuario" class="text-danger" onclick="borrar('#resultado','<?php echo base_url();?>usuarios/borrarusuario','id=<?php echo $r->id; ?>','<?php echo base_url(); ?>usuarios/mostrar')">Eliminar</a></li>

                <?php if ($r->estado == 1)
                {
                ?>
                    <li><a href="javascript:void(0)" class="btn btn-warning btn-xs" title="Inabilitar Usuario" class="text-danger" onclick="filtros('inhabilitar=<?php echo $r->id;?>','<?php echo base_url()?>usuarios/habiliatinabilitarusuario','#resultado')">Inhabilitar</a></li>
                <?php  
                }
                else
                {?>
                    <li><a href="javascript:void(0)" class="btn btn-default btn-xs" title="Habilitar Usuario" class="text-danger" onclick="filtros('habilitar=<?php echo $r->id;?>','<?php echo base_url()?>usuarios/habiliatinabilitarusuario','#resultado')">Habilitar</a></li>
                <?php
                }?>

                
                 
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