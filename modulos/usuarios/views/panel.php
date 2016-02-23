<ol class="breadcrumb">
  <li><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="mostrar('','<?php echo base_url(); ?>usuarios/mostrar','#resultado')"><i class="fa fa-home"></i> Principal</a></li>

  <li><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="filtros('','<?php echo base_url(); ?>usuarios/mostrar','#resultado')"><i class="fa fa-user"></i> Total de usuarios <span class="badge"><?php echo $total_usuarios ?></span></a></li>

  <li><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="filtros('estado=1','<?php echo base_url(); ?>usuarios/mostrar','#resultado')"><i class="fa fa-user"></i> Activos <span class="badge"><?php echo $activos ?></span></a></li>

  <li><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="filtros('estado=2','<?php echo base_url(); ?>usuarios/mostrar','#resultado')"><i class="fa fa-user"></i> Inactivos <span class="badge"><?php echo $inactivos ?></span></a></li>

    <li><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="filtros('grupo=1','<?php echo base_url(); ?>usuarios/mostrar','#resultado')"><i class="fa fa-user"></i> Grupo Administrador <span class="badge"><?php echo $admin ?></span></a></li>

  <li><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="filtros('grupo=2','<?php echo base_url(); ?>usuarios/mostrar','#resultado')"><i class="fa fa-user"></i> Grupo Registrados <span class="badge"><?php echo $registrados ?></span></a></li>

  
  <li><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="mostrar('','<?php echo base_url(); ?>usuarios/estadistica','#resultado')"><i class="fa fa-line-chart"></i> Estadistica</a></li>

  <li><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="modulos_salir('<?php echo base_url(); ?>formulario/configcontroller')"><i class="fa fa-times"></i> Salir del Modulo de Usuarios</a></li>
</ol>


