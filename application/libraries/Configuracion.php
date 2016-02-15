<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso direccto a este script Su IP ha sido rastreada');

class Configuracion
{
    public function __construct()
    {
        $this->CI = & get_instance();

        $consultaconfig = $this->CI->db->get('parametros');

        foreach ($consultaconfig->result() as $filaconfig)
        {
            define("NOMBRE_EMPRESA", $filaconfig->nombre_empresa);
            define("APERTURACAJA", $filaconfig->apertura);
            define("CAJACHICA", $filaconfig->caja);
            define("MONTOMINIMO", $filaconfig->monto_minimo);
            define("MONTOMAXIMO", $filaconfig->monto_maximo);
            define("MONTOCONSUMIBLE", $filaconfig->monto_consumible);
            define("ESTADOCAJA", $filaconfig->estado_caja);
        }

        setlocale(LC_ALL, 'es_VE');
        // Setea el huso horario del servidor...
        date_default_timezone_set('America/Caracas');
        // Imprime la fecha, hora y huso horario.
        $fecha = date("Y-m-d h:i:s");

        define("FECHAGESTOR", $fecha);

    }

    function codigo($tamanio = NULL, $mivar = NULL, $cs = FALSE, $may = TRUE, $num = TRUE)
    {
        $fuente = 'abcdefghjkmnopqrstuvwxyz';

        if(!empty($mivar)) $fuente .= $mivar;
        if($may == 1) $fuente .= 'ABCDEFGHIJKLMNPQRSTUVWXYZ';
        if($num == 1) $fuente .= '123456789';
        if($cs == 1) $fuente .= '|@#~$%()=^*+[]{}-_';
        if($tamanio>0)
        {
            $codigo = "";
            $fuente = str_split($fuente,1);

            for($i=1; $i<=$tamanio; $i++)
            {
                mt_srand((double)microtime() * 1000000);
                $nume = mt_rand(1,count($fuente));
                $codigo .= $fuente[$nume-1];
            }
        }
        return $codigo;
    }

    function textomes($mes)
    {
        switch($mes)
        {
            case '1': echo "Enero"; break;
            case '2': echo "Febrero"; break;
            case '3': echo "Marzo"; break;
            case '4': echo "Abril"; break;
            case '5': echo "Mayo"; break;
            case '6': echo "Junio"; break;
            case '7': echo "Julio"; break;
            case '8': echo "Agosto"; break;
            case '9': echo "Septiembre"; break;
            case '10': echo "Octubre"; break;
            case '11': echo "Noviembre"; break;
            case '12': echo "Diciembre"; break;

            default: echo "Error la fecha no coincide"; break;

        }
    }

}
