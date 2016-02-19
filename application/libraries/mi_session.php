<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso direccto a este script Su IP ha sido rastreada');

class Mi_session
{
    public function __construct()
    {
        $this->CI = & get_instance();

    }

    public function entrar($usuario, $clave)
    {

        /*$usuario = 'l';
        $clave = '21232f297a57a5a743894a0e4a801fc3';//admin
        $clave = '202cb962ac59075b964b07152d234b70';//123*/



        $datos = array();

        $limit = 1;
        $this->CI->db->select('Compania,Codigo,NombreUsuario,NombresU,Perfil,Intentos');
        $this->CI->db->where("NombreUsuario = '$usuario'
                   		 AND Clave = '$clave'");
        $consulta = $this->CI->db->get('usuusuarios',$limit);

        //$estado = $this->CI->db->get_where('usuarios', array('usuario' => $usuario, 'password' => $clave, 'estado' => 1), $limit);
        $this->CI->db->select('NombreUsuario, Activo');
        $this->CI->db->where("NombreUsuario = '$usuario'
                   		 AND Clave = '$clave' AND Activo = '1'");
        $estado = $this->CI->db->get('usuusuarios',$limit);





        if($consulta->num_rows() > 0)
        {
            if ($estado->num_rows() > 0)
            {
                $consulta = $consulta->row();
                $data = array(
                    'login' => TRUE,
                    'operador' => $consulta->Perfil,
                    'nombre' => $consulta->NombresU,
                    'usuario' => $consulta->NombreUsuario,
                    'id_usuario' => $consulta->Codigo,
                    'fechainicio' => FECHAGESTOR,
                );
                $this->CI->session->set_userdata($data);

                $this->CI->db->set('Intentos', NULL);
                $this->CI->db->where("NombreUsuario = '$usuario' ");
                $this->CI->db->update('usuusuarios');
            }
            else
            {
                $datos['error'] = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> El Usuario no esta activo</div>';
            }
        }
        else
        {
            //$intento = $this->CI->db->get_where('usuarios', array('usuario' => $usuario),$limit);
            $this->CI->db->select('NombreUsuario, Intentos');
            $this->CI->db->where("NombreUsuario = '$usuario'");
            $intento = $this->CI->db->get('usuusuarios',$limit);

            if($intento->num_rows() > 0)
            {
                foreach ($intento->result() as $r)
                {
                    $verificarintentos = $r->Intentos;
                }

                if ($verificarintentos == 3)
                {
                    $this->CI->db->set('Activo', 0);
                    $this->CI->db->where("NombreUsuario = '$usuario'");
                    $this->CI->db->update('usuusuarios');

                    $datos['error'] = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Sistema Bloqueado Comuniquese con el Administrador</div>';
                }
                else
                {
                    $restar = 4;
                    $contador = $verificarintentos +1;
                    $total = $restar - $contador;

                    $this->CI->db->set('Intentos', $contador);
                    $this->CI->db->where("NombreUsuario = '$usuario'");
                    $this->CI->db->update('usuusuarios');

                    $datos['error'] = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> La Contrase&ntilde;a es Incorrecta Te quedan <b>'.$total.'</b> Intentos</div>';

                }
            }
            else
            {
                $datos['error'] = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> El Usuario <b>'.$usuario.'</b> no existe en nuestra base de datos</div>';
            }

            $this->CI->session->sess_destroy();
        }
        //$this->CI->output->enable_profiler(TRUE);

        return $datos;
    }

    function cambio_clave($claveactual, $clavenueva)
    {
        $consulta = $this->CI->db->get_where('usuarios', array('id' => $this->CI->session->userdata('id_usuario')));

        if ($consulta->num_rows() > 0)
        {
            $consulta = $consulta->row();

            if($consulta->password == $claveactual)
            {
                $data = array('id' => $this->CI->session->userdata('id_usuario'),
                    'password' => $clavenueva,
                    'fecha_editado' => FECHAGESTOR,
                );

                $this->CI->db->set($data);
                $this->CI->db->where('id', $this->CI->session->userdata('id_usuario'));
                $this->CI->db->update('usuarios');

                $datos['exito'] = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Su clave a sido cambiado con exito</div>';
            }
            else
            {
                $datos['error'] = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Error su clave No coincide</div>';
            }
        }
        else
        {
            $datos['error'] = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Error su clave No puede ser cambiada</div>';
        }
        return $datos;
    }

    function activo()
    {
        if ($this->CI->session->userdata('login') === TRUE)
        {
            return TRUE;
        }
        else
        {
            $this->salir();
            echo ("<script>window.location =  'login';</script>");
        }
    }

    function verificar_session()
    {
        if ($this->CI->session->userdata('login') === TRUE)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function verificar_inactividad()
    {
        $fechaGuardada =  $this->CI->session->userdata('fechainicio');

        $ahora = FECHAGESTOR;

        $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));

        if($tiempo_transcurrido >= 300)
        {
            //$this->CI->session->sess_destroy();
            return FALSE;
        }
        else
        {
            //$this->session->userdata('fechainicio')?;
            $_SESSION['fechainicio']=FECHAGESTOR;
        }
    }

    function salir()
    {
        $this->CI->session->sess_destroy();
    }
}	

