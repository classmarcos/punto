<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso direccto a este script Su IP ha sido rastreada');

class Resourcees
{
    protected $css_folder = 'public/css/';
    protected $js_folder = 'public/js/';
    protected $css_archivos = [];
    protected $js_archivos = [];

    public function __construct($parametros = [])
    {
        $this->CI = & get_instance();

        if (count($parametros) > 0)
        {
            $this->initialize($parametros);
        }
    }

    public function initialize($parametros = [])
    {
        foreach ($parametros as $key => $value)
        {
            if (isset($this->$key))
            {
                $this->$key = $value;
            }
        }

    }

    public function css()
    {
        $contenido = NULL;

        foreach($this->css_archivos as $key => $value)
        {
            $contenido .= link_tag($this->css_folder . $value . '.css');
        }
        return $contenido;
    }

    public function js()
    {
        $contenido = NULL;

        foreach($this->js_archivos as $key => $value)
        {
            $contenido .= '<script src="'. base_url(). $this->js_folder . $value .'.js"></script>';
        }
        return $contenido;

    }


}
