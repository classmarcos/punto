<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso direccto a este script Su IP ha sido rastreada');

class Select
{
    public function __construct()
    {
        $this->CI = & get_instance();
    }








    function grupos($id_grupo=NULL)
    {
        $grupos = $this->CI->db->get('grupos');
        if ($grupos->num_rows() > 0)
        {
            ?>
            <select name="id_grupos" class="form-control">
                <?php
                if ($id_grupo == NULL)
                {?>
                    <option value="" selected="selected"> Elige el Grupo</option>
                    <?php
                }
                foreach ($grupos->result() as $grupo)
                {
                    if ($id_grupo == $grupo->id )
                    {
                        ?>
                        <option value="<?php echo $grupo->id ?>" selected="selected"> <?php echo $grupo->categorias ?></option>
                        <?php
                    }
                    else
                    {
                        ?>
                        <option value="<?php echo $grupo->id ?>"> <?php echo $grupo->categorias ?>  </option>
                        <?php
                    }
                }
                ?>
            </select>
            <?php
        }
        else
        {
            return 'No se encontraron resultados';
        }
    }

    function mostrar_grupos($id=NULL)
    {
        $consulta = $this->CI->db->get_where('grupos', array('id' => $id));
        if ($consulta->num_rows() > 0)
        {
            foreach ($consulta->result() as $r)
            {
                return $r->categorias;
            }
        }
        else
        {
            return 'No se encontraron resultados';
        }
    }

      function mostrar_clientes($id=NULL)
    {
        $consulta = $this->CI->db->get_where('clientes', array('id' => $id));
        if ($consulta->num_rows() > 0)
        {
            foreach ($consulta->result() as $r)
            {
                return $r->nombre.' '.$r->apellidos;
            }
        }
        else
        {
            return 'No se encontraron resultados';
        }
    }

    function mostrar_usuario($id=NULL)
    {
        $consulta = $this->CI->db->get_where('usuusuarios', array('Codigo' => $id));
        if ($consulta->num_rows() > 0)
        {
            foreach ($consulta->result() as $r)
            {
                return $r->nombre.' '.$r->apellido;
            }
        }
        else
        {
            return 'SIn Aprobar';
        }
    }
}
