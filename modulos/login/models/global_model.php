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
	function total_filas()
    {
        return $this->db->count_all('publicaciones');
    }

	public function mostrar($cbd)
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


	function borrar(
	/*1*/	$bd = NULL,				// $bd = CONST Indicamos la BD, si se deja NULL tomará la BD por defecto en el archivo database.php de la carpeta configuración
	/*2*/	$tabla,					// $tabla = "tabla"	Seleccionamos la Tabla. Campo Obligatorio
	/*3*/	$datos = NULL,				// $datos = Arreglo con los datos a insertar
	/*4*/	$condicion = NULL				// $condicion = array("var" => 1,"var" => "noc"); Condición o condiciones para actualizar
			)
	{
		$this->db->where($condicion);
		if ($bd != NULL)/*1 y 2 */		// // Seleccionamos la base de datos opcional o tomo la por defecto más su tabla
		{
			$consulta = $this->db->delete($bd.'.'.$tabla, $datos);
		}
		else
		{
			$consulta = $this->db->delete($tabla, $datos);
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

}
