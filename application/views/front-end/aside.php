
<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">

            <p class="centered"><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="modal('','<?= base_url().'admin/admin_perfil'?>','.modal-body','#generalmodal')"><img src="public/img/perfil/<?php echo $this->session->userdata('usuario'); ?>/<?php echo $this->session->userdata('foto'); ?>" class="img-circle" width="60"></a></p>
            <h5 class="centered"><?php echo $this->session->userdata('nombre'); ?></h5>

            <li class="mt">
                <a href="javascript:void(0)"  onclick="mostrar('','<?php echo base_url(); ?>admin/principal','#resultado')">
                    <i class="fa fa-home"></i>
                    <span>Principal</span>
                </a>
                <!--
                       <a href="javascript:void(0)"  onclick="mostrar('','<?php echo base_url(); ?>admin/chatear','#resultado')">
                          <i class="fa fa-home"></i>
                          <span>chat</span>
                      </a>
                      -->
            </li>

            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-pencil-square-o"></i>
                    <span>Compras</span>
                </a>
                <ul class="sub">
                    <li><a href="javascript:void(0)"  onclick="mostrar('','<?php echo base_url(); ?>admin/registro_compras','#resultado')">Generar Compras</a></li>
                    <li><a href="javascript:void(0)"  onclick="mostrar('','<?php echo base_url(); ?>admin/mostrar_registro_caja','#resultado')">Ver Compras General</a></li>
                    <li><a href="javascript:void(0)"  onclick="mostrar('','<?php echo base_url(); ?>admin/reporte_dia_compras','#resultado')">Ver Compras por dia</a></li>
                    <li><a href="javascript:void(0)"  onclick="mostrar('','<?php echo base_url(); ?>admin/reporte_semana_compras','#resultado')">Ver Compras por Semana</a></li>
                    <li><a href="javascript:void(0)"  onclick="mostrar('','<?php echo base_url(); ?>admin/reporte_mes_compras','#resultado')">Ver Compras por mes</a></li>
                    <li><a href="javascript:void(0)"  onclick="mostrar('','<?php echo base_url(); ?>admin/reporte_contables','#resultado')">Reportes Contables</a></li>
                    <li><a href="javascript:void(0)"  onclick="mostrar('','<?php echo base_url(); ?>admin/reponer_caja','#resultado')">Reponer Caja chica</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-cog"></i>
                    <span>Configuracion</span>
                </a>
                <ul class="sub">

                    <li><a href="javascript:void(0)" onclick="mostrar('','<?php echo base_url(); ?>admin/configurar_caja','#resultado')">Caja chica</a></li>
                    <li><a href="javascript:void(0)"  onclick="mostrar('','<?php echo base_url(); ?>admin/agregar_operador','#resultado')">Tipos de Operador</a></li>
                    <li><a href="javascript:void(0)"  onclick="mostrar('','<?php echo base_url(); ?>admin/agregar_grupos','#resultado')">Grupos</a></li>
                    <li><a  href="javascript:void(0)"  onclick="mostrar('','<?php echo base_url(); ?>usuarios','#resultado')">Usuarios</a></li>
                </ul>
            </li>

        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>

<!--sidebar end-->