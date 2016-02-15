<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso direccto a este script Su IP ha sido rastreada');

class Validacion
{

    public function __construct()
    {
        $this->CI = & get_instance();
    }


    function verificar_fecha($fecha)
    {
        if ($fecha < date('Y-m-d'))
        {
            $this->CI->form_validation->set_message('verificar_fecha', 'Por favor, elige fechas de entrada y de salida a partir del día de hoy');
            return false;
        }
        else
        {
            return true;
        }
    }

}