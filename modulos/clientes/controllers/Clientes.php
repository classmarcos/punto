<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends MX_Controller{
		
	function __construct(){
		parent::__construct();
		$this->load->model('global_model');
		$this->load->library('mi_session');
		$this->load->library('form_validation');
		$this->load->library('jquery_pagination');

		$this->mi_session->verificar_inactividad();
	}

	function index(){
		$this->mostrar();
	}

	function mostrarcliente()
	{
		if($this->input->is_ajax_request())
	    {
	        if ($this->input->post('id'))
	        {
	            $data['tabla']= 'clientes';
	            $data["where"] = array(0 => array("campo" => "id", "valor" => $this->input->post('id'), "tipo" => "where"));
	            $datos["filas"] = $this->global_model->mostrar($data);
	            $this->load->view('mostrarcliente',$datos);
	        }
	        else
	        {
	            $data['tabla']= 'clientes';
	            $datos["filas"] = $this->global_model->mostrar($data);
	            $this->load->view('mostrarcliente',$datos);
	        }
	     }
	     else
	     {
	     	show_404();
	     }   

	}

	function mostrarDetalle(){
		$this->load->view('detallescliente');
		//$this->load->view('usuario_editar');
	}

	function hola()
    {
    	var_dump($this->global_model->filas_paginada1($this->input->post('buscarcliente')));
    }

     function buscarcliente($offset=0)
    {
    	if($this->input->is_ajax_request())
        {
	    	if ($this->input->post('buscarcliente') == NULL) 
	    	{
	    		echo 'El Campo esta Vacio Por favor Ingrese Algo';
	    	}
	    	else
	    	{
	    		$buscar = $this->input->post('buscarcliente');
		    	$config['base_url'] = base_url().'clientes/buscarcliente';
			    $config['div'] = '#busqueda';
			    $config['additional_param'] = "{'buscarcliente' : '$buscar'}";
			    $config['show_count'] = true;
			    $config['total_rows'] = $this->global_model->filas_paginada1($this->input->post('buscarcliente'));
			    $config['js_rebind'] =  'loadajax()';
			  	$config['per_page'] = 5;
		        $config['num_links'] = 3;
		        $config['full_tag_open'] = '<div class="pagination"><ul class="pagination">';
				$config['full_tag_close'] = '</ul></div><!--pagination-->';
				$config['first_link'] = '&laquo; Primera';
				$config['first_tag_open'] = '<li class="prev page">';
				$config['first_tag_close'] = '</li>';
				$config['last_link'] = 'Última &raquo;';
				$config['last_tag_open'] = '<li class="next page">';
				$config['last_tag_close'] = '</li>';
				$config['next_link'] = 'Siguiente &rarr;';
				$config['next_tag_open'] = '<li class="next page">';
				$config['next_tag_close'] = '</li>';
				$config['prev_link'] = '&larr; Anterior';
				$config['prev_tag_open'] = '<li class="prev page">';
				$config['prev_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li class="page">';
				$config['num_tag_close'] = '</li>';

				 $this->jquery_pagination->initialize($config);
					
			     $filas = $this->global_model->total_posts_paginados1($this->input->post('buscarcliente'),$config['per_page'],$offset);
			     $paginacion = $this->jquery_pagination->create_links();    

			      $data = array(
					'filas' => $filas,
					'paginacion' => $paginacion
			     );
				$this->load->view('mostrarbusqueda',$data);
	    	}
	    }
	    else
	    {
	    	show_404();
	    }	
    }

     	function mostrar(){
			if($this->input->is_ajax_request()){
			//if ($this->input->post('estado') == 1)
			//{
				//$estado = $this->input->post('estado');
				$config['base_url'] = base_url().'clientes/mostrar';
			    $config['div'] = '#resultado';
			    //$config['additional_param'] = "{'estado' : '$estado'}";
			    $config['show_count'] = true;
			   // $config['total_rows'] = $this->global_model->total_usuarios('estado','1');
			    $config['js_rebind'] =  'loadajax()';
			   
			  	$config['per_page'] = 5;
	            $config['num_links'] = 3;
	            $config['first_link'] = 'Primero';
	            $config['next_link'] = 'Siguiente';
	            $config['prev_link'] = 'Anterior';
	            $config['last_link'] = 'Último';

	            $config['full_tag_open'] = '<div class="pagination"><ul class="pagination">';
				$config['full_tag_close'] = '</ul></div><!--pagination-->';

				$config['first_link'] = '&laquo; Primera';
				$config['first_tag_open'] = '<li class="prev page">';
				$config['first_tag_close'] = '</li>';
				 
				$config['last_link'] = 'Última &raquo;';
				$config['last_tag_open'] = '<li class="next page">';
				$config['last_tag_close'] = '</li>';
				 
				$config['next_link'] = 'Siguiente &rarr;';
				$config['next_tag_open'] = '<li class="next page">';
				$config['next_tag_close'] = '</li>';
				 
				$config['prev_link'] = '&larr; Anterior';
				$config['prev_tag_open'] = '<li class="prev page">';
				$config['prev_tag_close'] = '</li>';
				 
				$config['cur_tag_open'] = '<li class="active"><a href="">';
				$config['cur_tag_close'] = '</a></li>';
				 
				$config['num_tag_open'] = '<li class="page">';
				$config['num_tag_close'] = '</li>';

				 $this->jquery_pagination->initialize($config);
	  			
	  			 $datos['select']= 'id, nombre, apellidos, cedula, direccion, estatus';
			     $datos['tabla']= 'clientes';
			     $datos["where"] = array(
								0 => array("campo" => "estado", "valor" => $estado, "tipo" => "where")
							);
			     $datos['limit']=  $config['per_page'];
			     $datos['offset']=  $offset;
			   
			     $filas = $this->global_model->mostrar($datos);
			     $paginacion = $this->jquery_pagination->create_links();    

			      $data = array
			     (
					'filas' => $filas,
					'paginacion' => $paginacion
			     );
	            
	            //$data['total_usuarios'] = $this->global_model->metodoanteguo('usuarios','cuenta');
	    		//$data['activos'] = $this->global_model->metodoanteguo('usuarios','cuenta','','estado','1');
	    		//$data['inactivos'] = $this->global_model->metodoanteguo('usuarios','cuenta','','estado','2');
	    		//$data['admin'] = $this->global_model->metodoanteguo('usuarios','cuenta','','tipo_operador','1');
	    		//$data['registrados'] = $this->global_model->metodoanteguo('usuarios','cuenta','','tipo_operador','2');
				
				$this->load->view('mostrar',$data);

			
			}
			else
			{
				show_404();
			}	

		}	  

    public function detallesPedientes()
  	{
        if($this->input->is_ajax_request())
        {
        	$data['select'] = 'd.id,ac.accion AS concepto,d.monto,p.monto AS pagado,p.fecha,(d.monto-p.monto) AS balance';
            $data['tabla']= 'deudas d';
          	$data['join'] = array(0 => array("tabla" => " pagos p", "condicion" => " d.id=p.idDeuda", "tipo" => "LEFT"),1=> array("tabla" =>"accion_clientes ac","condicion"=>"d.accion=ac.id", "tipo" => "LEFT" )); 
            $data["where"] = array(0 => array("campo" => "idCliente", "valor" => $this->input->post('idCliente'), "tipo" => "where"));
            $datos["filas"] = $this->global_model->mostrar($data);

            if(!isset($datos["filas"]["error"]))
            {
              $this->load->view('detallescliente',$datos);
            }
            else
            {
                echo 'No se encuentran datos';
            }
        }
        else
        {
            show_404();
        }    
  }
    public function accionElegida($idCliente,$accion)
  	{
        if($this->input->is_ajax_request())
        {
        	$data['select'] = 'SUM(monto) AS balanceTotal';
            $data['tabla']= 'deudas';
          	$data["where"] = array(0 => array("campo" => "idCliente", "valor" => $idCliente, "tipo" => "where"),1=>array("campo" => "accion", "valor" => $accion, "tipo" => "where"));
            $datos["accion"] = $this->global_model->mostrar($data);
            return $datos["accion"];
        }
        else
        {
            show_404();
        }    
  }


function pagar()
	{
		if($this->input->is_ajax_request())
		{
			$data['select']= 'c.id,c.nombre,c.apellidos,c.estatus,d.contrato,c.direccion,c.cedula,(IFNULL((SUM(d.monto)- p.monto),SUM(d.monto))) AS balance ';
			$data['tabla']= 'clientes c';
			$data["join"] = array(0 => array("tabla" => "deudas d", "condicion" => "d.idCliente = c.id ", "tipo" => "LEFT"),1=> array("tabla" => "pagos p", "condicion" => "d.id = p.idDeuda ", "tipo" => "LEFT"));
			$data["where"] = array(0 => array("campo" => "c.id", "valor" => $this->input->post('idCliente'), "tipo" => "where"));
			$data["limit"]='1';
			$datos["filas"] = $this->global_model->mostrar($data);

			if(!isset($datos["filas"]["error"]))
			{
				if(!$this->input->post('enviado'))
				{
					$this->load->view('pagar_deudas',$datos);
				}
				else
				{
					$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
					$this->form_validation->set_message('required', 'El Campo %s es obligatorio');

					if ($this->form_validation->run() == FALSE)
					{
						$this->load->view('pagar_deudas',$datos);
					}
					else
					{
						if ($_FILES['userfile']['name'] != '') 
						{
							$cliente = $this->input->post('cliente');
							$respuesta = $this->subir_foto($cliente);

							if (!is_array($respuesta)) 
							{
									$cbd["tabla"] = "clientes";
									$cbd["where"] = array(
											0 => array("campo" => "id", "valor" => $this->input->post('idCliente'), "tipo" => "where")
										);

								    $datos = array(
										'contrato' => $this->input->post('contrato'),
										'nombre' => $this->input->post('nombre'),
										'apellidos' => $this->input->post('apellidos'),
										'cedula' => $this->input->post('cedula'),
										'direccion' => $this->input->post('direccion'),
										'estatus' => $this->input->post('estatus'),
										'id' =>$this->input->post('id'),
										
									);
									$this->global_model->actualizar($cbd, $datos);

									$data['select']= 'c.id,c.nombre,c.apellidos,c.estatus,d.contrato,c.direccion,(IFNULL((SUM(d.monto)- p.monto),SUM(d.monto))) AS balance';
									$data['tabla']= 'clientes c';
									$data["join"] = array(0 => array("tabla" => "deudas d", "condicion" => "d.idCliente = c.id ", "tipo" => "LEFT"),1=> array("tabla" => "pagos p", "condicion" => "d.id = p.idDeuda ", "tipo" => "LEFT"));
									$data["where"] = array(0 => array("campo" => "c.id", "valor" => $this->input->post('idCliente'), "tipo" => "where"));
									$data["limit"]='1';
									$datos["filas"] = $this->global_model->mostrar($data);

									$datos['pagado'] = ' Deuda Pagada';
									$this->load->view('pagar_deudas',$datos);
									//echo "Editado";
							}
							else
							{
									$datos['respuesta'] = $respuesta;
									$this->load->view('pagar_deudas',$datos);
							}		
							//$this->estados_citas($id);
						}
						else
						{
								$cbd["tabla"] = "clientes";
								$cbd["where"] = array(
										0 => array("campo" => "id", "valor" => $this->input->post('idCliente'), "tipo" => "where")
									);
								$datos = array(
										'contrato' => $this->input->post('contrato'),
										'nombre' => $this->input->post('nombre'),
										'apellidos' => $this->input->post('apellidos'),
										'cedula' => $this->input->post('cedula'),
										'direccion' => $this->input->post('direccion'),
										'estatus' => $this->input->post('estatus'),
										'id' =>$this->input->post('id'),
									
									);
								$this->global_model->actualizar($cbd, $datos);

								
								$data['select']= 'c.id,c.nombre,c.apellidos,c.estatus,d.contrato,c.direccion,c.cedula,(IFNULL((SUM(d.monto)- p.monto),SUM(d.monto))) AS balance';
								$data['tabla']= 'clientes c';
								$data["join"] = array(0 => array("tabla" => "deudas d", "condicion" => "d.idCliente = c.id ", "tipo" => "LEFT"),1=> array("tabla" => "pagos p", "condicion" => "d.id = p.idDeuda ", "tipo" => "LEFT"));
								$data["where"] = array(0 => array("campo" => "c.id", "valor" => $this->input->post('idCliente'), "tipo" => "where"));
								$data["limit"]='1';
								$datos["filas"] = $this->global_model->mostrar($data);

								$datos['pagado'] = 'Deuda Pagada';
								$this->load->view('pagar_deudas',$datos);
								//echo "editado 2";
						}	
					}
				}
			}
			else
			{
				echo "Ocurrió un error en la consulta";
			}
		}
		else
		{
			show_404();
		}

	}

   
	
}

?>