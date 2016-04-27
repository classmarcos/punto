<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /*
        function listar($limit, $offset, $ruta, $valorcampo, $nombreedicion)
        {
            $consulta = $this->db->get('publicaciones',$limit, $offset);

            if ($consulta->num_rows() > 0)
            {
                foreach ($consulta->result_array() as $r)
                {
                    $link = anchor($ruta.$r[$valorcampo], $nombreedicion);
                    $r['opciones'] = $link;
                    $datos[] = $r;
                }
            }
            else
            {
                $datos["error"] = TRUE;

            }
            return $datos;

        }
    */



    public function obtener_rango_fecha($fecha=NULL, $condicion1=NULL, $condicion2 =NULL, $agrupar=NULL, $campo=NULL,$ordenar=NULL,$tipo=NULL, $suma=NULL,$mesnombre=NULL)
    {

        if ($mesnombre!=NULL)
        {
            $this->db->select("$mesnombre,
			 CASE MONTH(".$mesnombre.") 
			 WHEN 1 THEN 'Enero'
		     WHEN 2 THEN 'Febrero'
		     WHEN 3 THEN 'Marzo'
		     WHEN 4 THEN 'Abril'
		     WHEN 5 THEN 'Mayo'
		     WHEN 6 THEN 'Junio'
		     WHEN 7 THEN 'Julio'
		     WHEN 8 THEN 'Agosto'
		     WHEN 9 THEN 'Septiembre'
		     WHEN 10 THEN 'Octubre'
		     WHEN 11 THEN 'Noviembre'
		     WHEN 12 THEN 'Diciembre'
		     END nombre_mes");
        }

        if($fecha!=NULL)
        {
            $this->db->select("YEAR(".$fecha.") AS anio, MONTHNAME(".$fecha.") AS mes", FALSE);
        }
        if ($condicion1!=NULL)
        {
            $this->db->where("YEAR(".$condicion1.")", $condicion2);
        }
        if ($agrupar!=NULL)
        {
            $this->db->group_by("MONTHNAME(".$agrupar.")", "MONTHNAME(".$campo.")");
        }

        if ($ordenar!=NULL)
        {
            $this->db->order_by($ordenar, $tipo);
        }

        if ($suma!=NULL)
        {
            $this->db->select('SUM('.$suma.') as montos');
        }

        return $this->db->get('caja_chica')->result();
        //return $consulta->row()->diff;

    }

    public function gruposjson($id=NULL)
    {
        if($id!=NULL)
        {
            $this->db->where('id', $id);
        }

        return $this->db->get('grupos')->result();

    }

    public function consultarfechas($caso=NULL, $caso2=NULL,$caso3=NULL, $caso4=NULL)
    {

        if($caso!=NULL)
        {
            $this->db->where($caso, $caso2);
        }

        if($caso3!=NULL)
        {
            $this->db->where($caso3, $caso4);
        }

        return $this->db->get('caja_chica')->result();

    }

    public function total_usuarios($caso=NULL, $caso2=NULL)
    {
        if($caso!=NULL)
        {
            $this->db->where($caso, $caso2);
        }

        $consulta = $this->db->get('usuarios');
        return $consulta->num_rows();
    }

    function total_filas()
    {
        return $this->db->count_all('contenidos');
    }

    public function mostrar($cbd=NULL)
    { //$this->Bdc_m->mostrar();

        $cbdi = array(
            /*1*/	"bd" => NULL,		// $bd = CONST Indicamos la BD, si se deja NULL tomará la BD por defecto en el archivo database.php de la carpeta configuración
            /*2*/	"tabla" =>NULL,			// $tabla = "tabla"	Seleccionamos la Tabla. Campo Obligatorio
            /*3*/"select" => NULL,	// $campos = "a.id as aid,a.nombre as nombre"; 	Seleccionamos los campos que consultaremos
            /*4*/	"where" => NULL,		// array(0 => array("campo" => "tabla", "valor" => "$var", "tipo" => "where,or_where,where_in,or_where_in,where_not_in,or_where_not_in"))
            /*5*/	"limit" => NULL,		// Limite de la consulta
            /*6*/	"offset" => NULL,	// Compensación de la consulta
            /*7*/	"min" => NULL,		// Selecciona el valor Mínimo del campo en la consulta se personaliza el nombre del campo usando el offset
            /*8*/	"max" => NULL,		// Selecciona el valor Máximo del campo en la consulta se personaliza el nombre del campo usando el offset
            /*9*/	"avg" => NULL,		// Selecciona el valor Average-Promedio del campo en la consulta se personaliza el nombre del campo usando el offset
            /*10*/	"sum" => NULL,		// Selecciona el valor Sumado del campo en la consulta se personaliza el nombre del campo usando el offset
            /*11*/	"group_by" => NULL,	//  array("campo", "campo2")
            /*12*/	"distinct" => NULL,	//  $distinct = "campo"
            /*13*/	"having" => NULL,	//  $having = array(0 => array("campo" => "tabla", "valor" => "$var", "tipo" => "having,or_having"))
            /*14*/	"join" => NULL,		// array(0 => array("tabla" => "moebius_citas b", "condicion" => "b.cedula = a.cedula", "tipo" => "RIGHT"))//Permite realizar joins
            /*15*/	"like" => NULL,		// array(0 => array("campo" => "tabla", "valor" => "$var", "comodin" => "before,after,both", "tipo" => "like,or_like,not_like, or_not_like"))
            /*16*/	"group_by" => NULL,	//  array("campo", "campo2")
            /*17*/	"order_by" => NULL,		// array(0 => array("campo" => "tabla", "valor" => "ASC, DESC", "tipo" => "NORMAL,RANDOM"))
        );
        // Funcion que realiza la consulta que describe la tabla
        $cbd = array_replace($cbdi, $cbd);

        //print_r($cbd);

        if ($cbd["select"])/*3*/		// Seleccionamos campos especificos de la tabla o por defecto todos los campos
        {
            $this->db->select($cbd["select"]);
        }
        else
        {
            $this->db->select("*");
        }

        if ($cbd["where"])/*4*/
        {
            foreach ($cbd["where"] as $k => $r)
            {
                if ($r["tipo"] === "where")
                {
                    if($r["valor"] !=NULL)
                    {
                        $this->db->where($r["campo"], $r["valor"]);
                    }
                }
                if ($r["tipo"] === "or_where")
                {
                    if($r["valor"] !=NULL)
                    {
                        $this->db->or_where($r["campo"], $r["valor"]);
                    }
                }
                if ($r["tipo"] === "where_in")
                {
                    if($r["valor"] !=NULL)
                    {
                        $this->db->where_in($r["campo"], $r["valor"]);
                    }
                }
                if ($r["tipo"] === "or_where_in")
                {
                    if($r["valor"] !=NULL)
                    {
                        $this->db->or_where_in($r["campo"], $r["valor"]);
                    }
                }
                if ($r["tipo"] === "where_not_in")
                {
                    if($r["valor"] !=NULL)
                    {
                        $this->db->where_not_in($r["campo"], $r["valor"]);
                    }
                }
                if ($r["tipo"] === "or_where_not_in")
                {
                    if($r["valor"] !=NULL)
                    {
                        $this->db->or_where_not_in($r["campo"], $r["valor"]);
                    }
                }
            }
        }

        if ($cbd["min"])/*7*/
        {
            $consulta = $this->db->select_min($cbd["min"], $cbd["offset"]);
        }

        if ($cbd["max"])/*8*/
        {
            $consulta = $this->db->select_max($cbd["max"], $cbd["offset"]);
        }

        if ($cbd["avg"])/*9*/
        {
            $consulta = $this->db->select_avg($cbd["avg"], $cbd["offset"]);
        }

        if ($cbd["sum"])/*10*/
        {
            $consulta = $this->db->select_sum($cbd["sum"], $cbd["offset"]);
        }

        if($cbd["group_by"] != NULL)/*11*/
        {
            $this->db->group_by($cbd["group_by"]);
        }

        if($cbd["distinct"])/*11*/
        {
            $this->db->distinct($cbd["distinct"]);
        }

        if ($cbd["having"] != NULL)/*4*/
        {
            foreach ($cbd["having"] as $k => $r)
            {
                if ($r["tipo"] === "having")
                {
                    $this->db->having($r["campo"], $r["valor"]);
                }
                if ($r["tipo"] === "or_having")
                {
                    $this->db->or_having($r["campo"], $r["valor"]);
                }
            }
        }

        if ($cbd["join"]) /*11*/
        {
            foreach ($cbd["join"] as $k => $r)
            {
                $this->db->join($r["tabla"], $r["condicion"], $r["tipo"]);
            }
        }

        if ($cbd["join"]) /*12*/
        {
            foreach ($cbd["join"] as $k => $r)
            {
                if ($r["tipo"] === "like")
                {
                    $this->db->like($r["campo"], $r["valor"], $r["comodin"]);
                }
                if ($r["tipo"] === "or_like")
                {
                    $this->db->or_like($r["campo"], $r["valor"], $r["comodin"]);
                }
                if ($r["tipo"] === "not_like")
                {
                    $this->db->not_like($r["campo"], $r["valor"], $r["comodin"]);
                }
                if ($r["tipo"] === "or_not_like")
                {
                    $this->db->or_not_like($r["campo"], $r["valor"], $r["comodin"]);
                }
            }
        }

        if ($cbd["order_by"]) /*17*/
        {
            foreach ($cbd["order_by"] as $k => $r)
            {
                if ($r["tipo"] === "NORMAL")
                {
                    $this->db->order_by($r["campo"], $r["valor"]);
                }
                if ($r["tipo"] === "RANDOM")
                {
                    $this->db->order_by($r["campo"], $r["tipo"]);
                }
            }
        }


        if ($cbd["bd"])/*1 y 2 */		// // Seleccionamos la base de datos opcional o tomo la por defecto más su tabla
        {
            $consulta = $this->db->get($cbd["bd"].'.'.$cbd["tabla"], $cbd["limit"], $cbd["offset"]);
            $this->total = $this->db->count_all_results($cbd["bd"].'.'.$cbd["tabla"]);
        }
        else
        {
            $consulta = $this->db->get($cbd["tabla"], $cbd["limit"], $cbd["offset"]);
            $this->total = $this->db->count_all_results($cbd["tabla"]);
        }

        if ($consulta->num_rows() > 0)
        {
            foreach ($consulta->result() as $consulta)
            {
                $datos[] = $consulta; // resultado de la consulta en un arreglo
            }
        }
        else
        {
            $datos["error"] = TRUE;
        }
        return $datos;
        //print_r($datos);
    }

    function agregar($cbd = array(""), $datos) //$this->Bdc_m->agregar($cbd);
    {
        $cbdi = array(
            /*1*/	"bd" => NULL,		// $bd = CONST Indicamos la BD, si se deja NULL tomará la BD por defecto en el archivo database.php de la carpeta configuración
            /*2*/	"tabla" => NULL,			// $c["tabla"] = "tabla"	Seleccionamos la Tabla. Campo Obligatorio
        );
        $c = array_replace($cbdi, $cbd);

        if ($c["bd"] != NULL)/*1 y 2 */		// // Seleccionamos la base de datos opcional o tomo la por defecto más su tabla
        {
            $consulta = $this->db->insert($c["bd"].'.'.$c["tabla"], $datos);
        }
        else
        {
            $consulta = $this->db->insert($c["tabla"], $datos);
        }
        return;
    }


    function actualizar($cbd = array(""), $datos) //$this->Bdc_m->actualizar($cbd);
    {
        $cbdi = array(
            /*1*/	"bd" => NULL,		// $bd = CONST Indicamos la BD, si se deja NULL tomará la BD por defecto en el archivo database.php de la carpeta configuración
            /*2*/	"tabla" => NULL,			// $c["tabla"] = "tabla"	Seleccionamos la Tabla. Campo Obligatorio
            /*3*/	"where" => NULL,		// array(0 => array("campo" => "tabla", "valor" => "$var", "tipo" => "where,or_where,where_in,or_where_in,where_not_in,or_where_not_in"))
        );

        $c = array_replace($cbdi, $cbd);

        if ($c["where"])/*3*/
        {
            foreach ($c["where"] as $k => $r)
            {
                if ($r["tipo"] === "where")
                {
                    $this->db->where($r["campo"], $r["valor"]);
                }
                if ($r["tipo"] === "or_where")
                {
                    $this->db->or_where($r["campo"], $r["valor"]);
                }
                if ($r["tipo"] === "where_in")
                {
                    $this->db->where_in($r["campo"], $r["valor"]);
                }
                if ($r["tipo"] === "or_where_in")
                {
                    $this->db->or_where_in($r["campo"], $r["valor"]);
                }
                if ($r["tipo"] === "where_not_in")
                {
                    $this->db->where_not_in($r["campo"], $r["valor"]);
                }
                if ($r["tipo"] === "or_where_not_in")
                {
                    $this->db->or_where_not_in($r["campo"], $r["valor"]);
                }
            }
        }
        if ($c["bd"])/*1 y 2 */		// // Seleccionamos la base de datos opcional o tomo la por defecto más su tabla
        {
            $consulta = $this->db->update($c["bd"].'.'.$c["tabla"], $datos);
        }
        else
        {
            $consulta = $this->db->update($c["tabla"], $datos);
        }
        return;
    }


    function borrar($cbd = array("")) //$this->Bdc_m->borrar($cbd);
    {
        $cbdi = array(
            /*1*/	"bd" => NULL,		// $bd = CONST Indicamos la BD, si se deja NULL tomará la BD por defecto en el archivo database.php de la carpeta configuración
            /*2*/	"tabla" => NULL,			// $c["tabla"] = "tabla"	Seleccionamos la Tabla. Campo Obligatorio
            /*3*/	"where" => NULL,		// array(0 => array("campo" => "tabla", "valor" => "$var", "tipo" => "where,or_where,where_in,or_where_in,where_not_in,or_where_not_in"))
        );

        $c = array_replace($cbdi, $cbd);

        if ($c["where"])/*3*/
        {
            foreach ($c["where"] as $k => $r)
            {
                if ($r["tipo"] === "where")
                {
                    $this->db->where($r["campo"], $r["valor"]);
                }
                if ($r["tipo"] === "or_where")
                {
                    $this->db->or_where($r["campo"], $r["valor"]);
                }
                if ($r["tipo"] === "where_in")
                {
                    $this->db->where_in($r["campo"], $r["valor"]);
                }
                if ($r["tipo"] === "or_where_in")
                {
                    $this->db->or_where_in($r["campo"], $r["valor"]);
                }
                if ($r["tipo"] === "where_not_in")
                {
                    $this->db->where_not_in($r["campo"], $r["valor"]);
                }
                if ($r["tipo"] === "or_where_not_in")
                {
                    $this->db->or_where_not_in($r["campo"], $r["valor"]);
                }
            }
        }
        if ($c["bd"])/*1 y 2 */		// // Seleccionamos la base de datos opcional o tomo la por defecto más su tabla
        {
            $consulta = $this->db->delete($c["bd"].'.'.$c["tabla"]);
        }
        else
        {
            $consulta = $this->db->delete($c["tabla"]);
        }
        return;
    }

    function mostrar_noticias($cuenta=NULL,  $id=NULL, $caso1=NULL, $caso2=NULL, $campo=NULL, $orden=NULL, $pag=NULL, $pag2=NULL, $busqueda=NULL, $caso3=NULL, $caso4=NULL, $caso5=NULL, $caso6=NULL, $todos=NULL, $distinct=NULL, $group_by=NULL, $ultimasemana=NULL) //Consulta General
    {
        if($campo!=NULL) // Ordenar según Campos
        {
            $this->db->order_by($campo, $orden);
        }

        if($caso1!=NULL) // Opción uno para filtrar
        {
            $this->db->where($caso1, $caso2);
        }
        if($caso3!=NULL) // Opción dos para filtrar
        {
            $this->db->where($caso3, $caso4);
        }

        if($caso5!=NULL)
        {
            $this->db->where($caso5, $caso6);
        }

        if($busqueda!=NULL)
        {
            $this->db->like($caso6, $busqueda);
        }
        if($id!=NULL) // Consulta según ID
        {
            $this->db->where('a.id', $id);
        }

        if($ultimasemana!=NULL)
        {
            $this->db->where('YEARWEEK('.$ultimasemana.')', 'YEARWEEK(NOW())', FALSE);
            //Select {fn week(fecha)},sum(imp) as imp From Tabla Where {fn year(fecha)}=2011 group by {fn week(fecha)}
        }



        $this->db->select("
		*			
		"); // Detalles en caso de compartir nombres

        // formato a las fechas


        $this->db->from('publicaciones'); // tabla principal consultada


        if($group_by!=NULL)
        {
            $this->db->group_by($group_by);
        }

        if($distinct!=NULL)
        {
            $this->db->distinct($distinct);
        }



        if ($cuenta!=NULL) // Consulta para contar el total de registros
        {
            return $this->db->count_all_results();
        }
        else
        {
            if ($pag != NULL and $pag2 != NULL) // Uso de paginación
            {
                $this->db->limit($pag, $pag2);
            }
            if ($pag != NULL and $pag2 == NULL) // Limite de listado
            {
                $this->db->limit($pag);
            }

            $consulta = $this->db->get(); // llamado a la consulta

            if ($consulta->num_rows() > 0)
            {
                foreach ($consulta->result() as $consulta)
                {
                    $datos[] = $consulta; // resultado de la consulta en un arreglo
                }
            }
            else
            {
                $datos['error'] = 'No se encontraron resultados'; // ,mensaje de error en caso de no existir registro para la consulta
            }
            return $datos;
        }
    }

    function metodoanteguo($tabla, $cuenta=NULL,  $id=NULL, $caso1=NULL, $caso2=NULL, $campo=NULL, $orden=NULL, $pag=NULL, $pag2=NULL, $busqueda=NULL, $caso3=NULL, $caso4=NULL, $caso5=NULL, $caso6=NULL, $todos=NULL, $distinct=NULL, $group_by=NULL, $ultimasemana=NULL, $ultimomes=NULL, $dia=NULL) //Consulta General
    {
        if($campo!=NULL) // Ordenar según Campos
        {
            $this->db->order_by($campo, $orden);
        }

        if($caso1!=NULL) // Opción uno para filtrar
        {
            $this->db->where($caso1, $caso2);
        }
        if($caso3!=NULL) // Opción dos para filtrar
        {
            $this->db->where($caso3, $caso4);
        }

        if($caso5!=NULL)
        {
            $this->db->where($caso5, $caso6);
        }

        if($busqueda!=NULL)
        {
            $this->db->like($caso6, $busqueda);
        }
        if($id!=NULL) // Consulta según ID
        {
            $this->db->where('id', $id);
        }

        if($ultimasemana!=NULL)
        {
            $this->db->where('YEARWEEK('.$ultimasemana.')', 'YEARWEEK(NOW())', FALSE);
            //Select {fn week(fecha)},sum(imp) as imp From Tabla Where {fn year(fecha)}=2011 group by {fn week(fecha)}
        }

        if($ultimomes !=NULL)
        {
            $this->db->where('MONTH('.$ultimomes.')', 'MONTH(NOW())', FALSE);
            //Select {fn week(fecha)},sum(imp) as imp From Tabla Where {fn year(fecha)}=2011 group by {fn week(fecha)}
        }

        if($dia !=NULL)
        {
            $this->db->where('DAYOFMONTH('.$dia.')', 'DAYOFMONTH(NOW())', FALSE);
            //Select {fn week(fecha)},sum(imp) as imp From Tabla Where {fn year(fecha)}=2011 group by {fn week(fecha)}
        }

        $this->db->select("
		*			
		"); // Detalles en caso de compartir nombres

        // formato a las fechas


        $this->db->from($tabla); // tabla principal consultada


        if($group_by!=NULL)
        {
            $this->db->group_by($group_by);
        }

        if($distinct!=NULL)
        {
            $this->db->distinct($distinct);
        }



        if ($cuenta!=NULL) // Consulta para contar el total de registros
        {
            return $this->db->count_all_results();
        }
        else
        {
            if ($pag != NULL and $pag2 != NULL) // Uso de paginación
            {
                $this->db->limit($pag, $pag2);
            }
            if ($pag != NULL and $pag2 == NULL) // Limite de listado
            {
                $this->db->limit($pag);
            }

            $consulta = $this->db->get(); // llamado a la consulta

            if ($consulta->num_rows() > 0)
            {
                foreach ($consulta->result() as $consulta)
                {
                    $datos[] = $consulta; // resultado de la consulta en un arreglo
                }
            }
            else
            {
                $datos["error"] = TRUE;  // ,mensaje de error en caso de no existir registro para la consulta
            }
            return $datos;
        }
    }

    public function cantidad_dias($fecha_ingreso=NULL)
    {
        //$this->db->select('DATEDIFF(NOW(),2014-10-15) as dif',FALSE);         
        $this->db->select("DATEDIFF(NOW(), '".$fecha_ingreso."') AS diff", FALSE);
        $consulta=$this->db->get('caja_chica');
        return $consulta->row()->diff;
    }


    public function suma_cantidad($ultimasemana=NULL, $ultimomes=NULL, $dia=NULL, $caso1=NULL, $caso2=NULL, $caso3=NULL, $caso4=NULL)
    {
        $this->db->select('SUM(monto) as montos');
        if($ultimasemana!=NULL)
        {
            $this->db->where('YEARWEEK('.$ultimasemana.')', 'YEARWEEK(NOW())', FALSE);
        }

        if($ultimomes !=NULL)
        {
            $this->db->where('MONTH('.$ultimomes.')', 'MONTH(NOW())', FALSE);

        }

        if($dia !=NULL)
        {
            $this->db->where('DAYOFMONTH('.$dia.')', 'DAYOFMONTH(NOW())', FALSE);
        }
        if($caso1!=NULL)
        {
            $this->db->where($caso1, $caso2);
        }
        if($caso3!=NULL) // Opción dos para filtrar
        {
            $this->db->where($caso3, $caso4);
        }

        $consulta=$this->db->get('caja_chica');
        return $consulta->row()->montos;
    }

    public function exportargeneral($tabla, $ultimasemana=NULL, $ultimomes=NULL, $dia=NULL, $caso1=NULL, $caso2=NULL)
    {
        if($ultimasemana!=NULL)
        {
            $this->db->where('YEARWEEK('.$ultimasemana.')', 'YEARWEEK(NOW())', FALSE);
        }

        if($ultimomes !=NULL)
        {
            $this->db->where('MONTH('.$ultimomes.')', 'MONTH(NOW())', FALSE);

        }

        if($dia !=NULL)
        {
            $this->db->where('DAYOFMONTH('.$dia.')', 'DAYOFMONTH(NOW())', FALSE);
        }

        if($caso1!=NULL)
        {
            $this->db->where($caso1, $caso2);
        }

        $consulta=$this->db->get($tabla);
        return $consulta->result_array();
    }

    public function exportargeneralpdf($tabla, $ultimasemana=NULL, $ultimomes=NULL, $dia=NULL, $caso1=NULL, $caso2=NULL)
    {
        if($ultimasemana!=NULL)
        {
            $this->db->where('YEARWEEK('.$ultimasemana.')', 'YEARWEEK(NOW())', FALSE);
        }

        if($ultimomes !=NULL)
        {
            $this->db->where('MONTH('.$ultimomes.')', 'MONTH(NOW())', FALSE);

        }

        if($dia !=NULL)
        {
            $this->db->where('DAYOFMONTH('.$dia.')', 'DAYOFMONTH(NOW())', FALSE);
        }

        if($caso1!=NULL)
        {
            $this->db->where($caso1, $caso2);
        }

        $consulta=$this->db->get($tabla);
        return $consulta->result();
    }

    public function suma_ingresos($ultimasemana=NULL, $ultimomes=NULL, $dia=NULL, $caso1=NULL, $caso2=NULL, $caso3=NULL, $caso4=NULL)
    {
        $this->db->select('SUM(monto) as montos');
        if($ultimasemana!=NULL)
        {
            $this->db->where('YEARWEEK('.$ultimasemana.')', 'YEARWEEK(NOW())', FALSE);
        }

        if($ultimomes !=NULL)
        {
            $this->db->where('MONTH('.$ultimomes.')', 'MONTH(NOW())', FALSE);

        }

        if($dia !=NULL)
        {
            $this->db->where('DAYOFMONTH('.$dia.')', 'DAYOFMONTH(NOW())', FALSE);
        }
        if($caso1!=NULL)
        {
            $this->db->where($caso1, $caso2);
        }
        if($caso3!=NULL) // Opción dos para filtrar
        {
            $this->db->where($caso3, $caso4);
        }

        $consulta=$this->db->get('reponer_caja');
        return $consulta->row()->montos;
    }



    /*function filas_paginada($abuscar) {

        $this->db->like('nombre', $abuscar, 'both');
        $this->db->or_like('apellidos', $abuscar, 'after');
        $this->db->or_like('cedula', $abuscar, 'after');
        $this->db->or_like('direccion', $abuscar, 'before');

        $consulta = $this->db->get('clientes');
        return $consulta->num_rows();
    }*/



    function filas_paginada($stringContrato) {

        //$stringContrato = 'A0000101A';
        $stringImei = '170';

        $query = "CALL spandroidbcontratos( ? , ? );";

        $consulta = $this->db->query($query, array($stringContrato,$stringImei));



        $row = new stdClass();
        $row->result = $consulta->result();
        $row->num_rows = $consulta->num_rows();

        $consulta->next_result(); //la libreria fue modificada para tener este parametro dentro de mysqli_result
        $consulta->free_result();




        return  $row->num_rows;

    }
 function buscarBancos(){

         if ($this->session->userdata('id_usuario') === NULL){
            return ;
        }
        $query = "";

        
        $query = "select Codigo,Descripcion from cxcbancos order by Descripcion";
     

        $consulta = $this->db->query($query);

        $row = new stdClass();
        $row->result = $consulta->result();
        $row->num_rows = $consulta->num_rows();

        //$consulta->next_result(); //la libreria fue modificada para tener este parametro dentro de mysqli_result
        $consulta->free_result();



        if($row->num_rows > 0)
        {
            return $row->result;
        }
        else
        {
            $datos["error"] = TRUE;
        }
        return $datos;



    }



    function detallecliente($stringCriterio, $opcion){

         if ($this->session->userdata('id_usuario') === NULL){
            return ;
        }
        $query = "";

        if ($opcion == "mensualidad") {
            //var_dump("hola");
            $query = "CALL spandroidbbalances( ?, 'fc')";
        } elseif ($opcion == "caja") {
            $query = "CALL spandroidbbalances( ?, 'sb')";
        } else {
            return "opcion invalida";
        }

        $consulta = $this->db->query($query, array($stringCriterio));

        $row = new stdClass();
        $row->result = $consulta->result();
        $row->num_rows = $consulta->num_rows();

        $consulta->next_result(); //la libreria fue modificada para tener este parametro dentro de mysqli_result
        $consulta->free_result();



        if($row->num_rows > 0)
        {
            return $row->result;
        }
        else
        {
            $datos["error"] = TRUE;
        }
        return $datos;



    }



    private function mensaje($id = 0, $mensaje = array()){
        //var_dump( $mensaje);
        $this->show(array("resultado" => $mensaje, "Id" => $id));
    }

    private function show($object){

        if (isset($object) || $object) {

            $this->output->set_content_type('application/json')->set_output(json_encode($object));
        }
    }


    function pagos($stringContrato, $stringImei, $dblmonto, $opcion, $idcargos, $intcajas, $tipo_pago, $insert, $intcantmeses, $dbldescuento, $dblmensualidad, $dbldescuentocalculado)
    {

       /* define("PAGO_MENSUALIDAD", "mensualidad");
        define("PAGO_CAJA", "caja");
        define("PAGO_CAJA2", "caja2");
        define("PAGO_EXTENSIONES", "extension");
        define("PAGO_RECONEXION", "reconexion");
        define("PAGO_ADELANTADO", "adelantados");*/

         if ($this->session->userdata('id_usuario') === NULL){
            return ;
        }

        $resultado = "";

        if ($opcion == 'mensualidad') {
            $string_tipoPago = "FC";
            $query = "CALL cxcandroid(?,?,?,?,?,?);";
            $resultado = $this->db->query($query, array($stringContrato, $dblmonto, $string_tipoPago, $stringImei, $tipo_pago, $insert));
        } elseif ($opcion == 'caja') {
            $string_tipoPago = "SB";
            $query = "CALL cxcandroid(?,?,?,?,?,?);";
            $resultado = $this->db->query($query, array($stringContrato, $dblmonto, $string_tipoPago, $stringImei, $tipo_pago, $insert));
        } elseif ($opcion == 'PAGO_EXTENSIONES'){
            $string_tipoPago = "EX";
            $query = "CALL spandroidcobrar( ? , ?, ?, ? , ?, ?, ?);";//efect EF CK TA,
            $resultado = $this->db->query($query, array($stringContrato, $dblmonto, $string_tipoPago, $stringImei, $intcajas, $tipo_pago, $insert));
        } elseif ($opcion == 'PAGO_CAJA2'){
            $string_tipoPago = "SB";
            $query = "CALL spandroidcobrar( ? , ?, ?, ? , ?, ?, ?);";
            $resultado = $this->db->query($query, array($stringContrato, $dblmonto, $string_tipoPago, $stringImei, $intcajas, $tipo_pago, $insert));
        } elseif ($opcion == 'reconexion'){
            $query = "CALL spandroidreconectar(?,?,?,?,?);";
            $resultado = $this->db->query($query, array($stringContrato, $dblmonto, $stringImei, $tipo_pago, $insert));
        } elseif ($opcion == 'PAGO_ADELANTADO') {
            $query = "CALL spandroidadelantado(?,?,?,?,?,?,?,?)";
            $resultado = $this->db->query($query, array($stringContrato, $dblmonto, $stringImei, $intcantmeses, $dbldescuentocalculado , $intcajas, $dbldescuento, $dblmensualidad));
        } else {
            return "opcion invalida";
        }



        $row = new stdClass();
        $row->result = $resultado->result();
        $row->num_rows = $resultado->num_rows();

        $resultado->next_result(); //la libreria fue modificada para tener este parametro dentro de mysqli_result
        $resultado->free_result();




        if ($resultado === "opcion invalida") {

            return "Datos incompletos";
        }

        $valor = 100;

        if ($row->num_rows < 1){
            $valor = -1;
        }

        if ($row->result[0]->TRN < 1) {
            $valor = -2;
        }



       return json_encode(array("resultado" => $row->result, "Id" => $valor));

    }



    function total_posts_paginados($stringContrato,$stringImei)
    {

        //$stringContrato = 'A0000101A';
        //$stringImei = '170';
        if ($this->session->userdata('id_usuario') === NULL){
            return ;
        }

        $query = "CALL spandroidbcontratos( ? , ? )";

        $consulta = $this->db->query($query, array($stringContrato,$stringImei));



        $row = new stdClass();
        $row->result = $consulta->result();
        $row->num_rows = $consulta->num_rows();

        $consulta->next_result(); //la libreria fue modificada para tener este parametro dentro de mysqli_result
        $consulta->free_result();



        if($row->num_rows > 0)
        {
            return $row->result;
        }
        else
        {
            $datos["error"] = TRUE;
        }
        return $datos;


    }



     function get_user_data($parameter)
    {

        if ($this->session->userdata('id_usuario') === NULL){
            return ;
        }
        //192.168.10.147
        $url = 'http://127.0.0.1:8080/codprueba/index.php/main/consultacliente'; //'http://tcentral.ddns.net:8080/Clientela/db_ODC.php'; 192.168.10.147:8080/Clientela/PruebaDBp.php http://tcentral.ddns.net:8080/Clientela/PruebaDBp.php
        //013495003102438
        $data = array('usuario' => $this->session->userdata('id_usuario'), 'contrato' =>  $parameter);
        $options = array(
            'http' => array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($data)
            )
        );

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $json_a = json_decode($result,true);

        return $json_a;
    }


    function get_user_detail($parameter,$type){


        if ($this->session->userdata('id_usuario') === NULL){
            return ;
        }



        //192.168.10.147
        $url = 'http://127.0.0.1:8080/codprueba/index.php/main/detallecliente/' . $type;

        $data = array('usuario' => $this->session->userdata('id_usuario'), 'contrato' =>  $parameter);
        $options = array(
            'http' => array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($data)
            )
        );

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $json_a = json_decode($result,true);

        return $json_a ;

    }





    public function make_reconection($contract, $mount)
    {
        if ($this->session->userdata('id_usuario') === NULL){
            return ;
        }

        $url = 'http://192.168.10.77:8080/tcentral/index.php/main/reconexion'; //http://192.168.10.147:8080/Clientela/PruebaDBp.php //'http://tcentral.ddns.net:8080/Clientela/db_ODC.php';
        $data = array('codigo' => $this->session->userdata('id_usuario'), 'contrato' =>  $contract, 'monto' => $mount);

        $options = array(
            'http' => array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($data)
            )
        );

        $context  = stream_context_create($options);
        $result = file_get_contents($url,false, $context);
      
        $json_a = json_decode($result,true);

       // var_dump($json_a);

        return $json_a;
    }


    /*function total_posts_paginados($abuscar, $por_pagina, $segmento)
    {

        $this->db->like('usuario', $abuscar, 'both');
        $this->db->or_like('correo', $abuscar, 'after');
        $this->db->or_like('nombre', $abuscar, 'after');
        $this->db->or_like('apellido', $abuscar, 'before');

        $consulta = $this->db->get('usuarios', $por_pagina, $segmento);

        if($consulta->num_rows() > 0)
        {
            return $consulta->result();
        }
        else
        {
            $datos["error"] = TRUE;
        }
        return $datos;
    }*/

}
