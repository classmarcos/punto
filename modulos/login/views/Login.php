<?php

        $usuario_in = array(

            'name'        =>'usuario',
            'id'          =>'username',
            'value'       =>@set_value('usuario'),
            'class'       =>'form-control',
            'placeholder' =>'Digiete Usuario',

        );

        $clave = array(
            'name'        =>'clave',
            'id'          =>'password',
            'value'       =>@set_value('clave'),
            'class'       =>'form-control',
            'placeholder' =>'Digiete Contraseña',

        );
?>

<div class="contenedor_login">
         <?php
            if(!$this->session->userdata('login'));
         ?>

        <?php
            $class = array('id'=>'login', 'class'=>'form-login');
         ?>

         <?php echo form_open_multipart('login/entrar',$class);?>

    <h2 class="form-login-headingd">
        <img src="<?php base_url();?> public/img/logo/edos.png" width="80" height="60">
        Ingrego al Sistema
    </h2>

</div>