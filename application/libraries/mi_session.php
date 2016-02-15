<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso direccto a este script Su IP ha sido rastreada');

class Mi_session
{
    public function __construct()
    {
        $this->CI = & get_instance();
    }

    public function entrar($usuario, $clave)
    {
        $datos = array();

        $limit = 1;
        $this->CI->db->select('usuario,intentos,correo, nombre, foto,apellido,id,tipo_operador');
        $this->CI->db->where("(usuario = '$usuario' OR correo = '$usuario') 
                   		 AND password = '$clave'");
        $consulta = $this->CI->db->get('usuarios',$limit);

        //$estado = $this->CI->db->get_where('usuarios', array('usuario' => $usuario, 'password' => $clave, 'estado' => 1), $limit);  
        $this->CI->db->select('usuario, estado');
        $this->CI->db->where("(usuario = '$usuario' OR correo = '$usuario')
                   		 AND password = '$clave' AND estado = '1'");
        $estado = $this->CI->db->get('usuarios',$limit);

        if($consulta->num_rows() > 0)
        {
            if ($estado->num_rows() > 0)
            {
                $consulta = $consulta->row();
                $data = array(
                    'login' => TRUE,
                    'operador' => $consulta->tipo_operador,
                    'correo' => $consulta->correo,
                    'nombre' => $consulta->nombre,
                    'foto' => $consulta->foto,
                    'apellido' => $consulta->apellido,
                    'usuario' => $consulta->usuario,
                    'id_usuario' => $consulta->id,
                    'fechainicio' => FECHAGESTOR,
                );
                $this->CI->session->set_userdata($data);

                $this->CI->db->set('intentos', NULL);
                $this->CI->db->where("(usuario = '$usuario' OR correo = '$usuario')");
                $this->CI->db->update('usuarios');
            }
            else
            {
                $datos['error'] = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> El Usuario no esta activo</div>';
            }
        }
        else
        {
            //$intento = $this->CI->db->get_where('usuarios', array('usuario' => $usuario),$limit);
            $this->CI->db->select('usuario,intentos');
            $this->CI->db->where("(usuario = '$usuario' OR correo = '$usuario')");
            $intento = $this->CI->db->get('usuarios',$limit);

            if($intento->num_rows() > 0)
            {
                foreach ($intento->result() as $r)
                {
                    $verificarintentos = $r->intentos;
                }

                if ($verificarintentos == 3)
                {
                    $this->CI->db->set('estado', 2);
                    $this->CI->db->where("(usuario = '$usuario' OR correo = '$usuario')");
                    $this->CI->db->update('usuarios');

                    $datos['error'] = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Sistema Bloqueado Comuniquese con el Administrador</div>';
                }
                else
                {
                    $restar = 4;
                    $contador = $verificarintentos +1;
                    $total = $restar - $contador;

                    $this->CI->db->set('intentos', $contador);
                    $this->CI->db->where("(usuario = '$usuario' OR correo = '$usuario')");
                    $this->CI->db->update('usuarios');

                    $datos['error'] = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> La Contraseña es Incorrecta Te quedan <b>'.$total.'</b> Intentos</div>';
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

