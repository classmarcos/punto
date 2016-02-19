<?php
$usuario_in = array(
    'name'        => 'usuario',
    'id'          => 'username',
    'value'       => @set_value('usuario'),
    'class'       => 'form-control',
    'placeholder' => 'Usuario o correo',
);

$clave = array(
    'name'        => 'clave',
    'id'          => 'password',
    'value'       => @set_value('clave'),
    'class'       => 'form-control',
    'placeholder' => 'Contrase&ntilde;a',

);
?>

<div class="contenedor_login">

    <?php
    if (!$this->session->userdata('login')):
    ?>

    <?php $class = array('id' => 'login', 'class' => 'form-login'); ?>
    <?php echo form_open_multipart('login/entrar',$class);?>

    <h2 class="form-login-heading">
       
        Ingreso al Sistema de Telenord
    </h2>
    <div class="login-wrap">
        <div id="msj_alert">
            <?php echo $this->session->flashdata('denegado'); ?>
        </div>
        <div class="form-group">
            <div class="input-group">
                     <span class="input-group-addon">
                      <i class="fa fa-user"></i>
                    </span>
                <?php echo form_input($usuario_in); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                     <span class="input-group-addon">
                      <i class="fa fa-lock"></i>
                    </span>
                <?php echo form_password($clave); ?>
            </div>
        </div>

        <button type="submit" class="btn btn-theme btn-block"><i class="fa fa-check-circle"></i> Iniciar Sesi&oacute;n</button>

        <?php echo form_close(); ?>

        <label class="checkbox">
            <a href="#">&#191;Olvidaste Tu Contrase&ntilde;a?</a>
        </label>

        <hr>

        <?php
        else:

        ?>
        <?php echo $this->session->flashdata('denegado'); ?>
        Bienvenido
        </p>
        <?php echo $this->session->userdata('nombre').' '.$this->session->userdata('apellido').''; ?>
        </p>
        <a href="<?php echo base_url();?>admin">Ir al Panel Administrador</a>
        </p>
        <a href="<?php echo base_url();?>admin/salir">Cerrar Seccion</a>

        <?php

        endif;
        ?>


    </div>

