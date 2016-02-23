<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');
		$this->load->library('mi_session');
		$this->load->library('form_validation');
		$this->load->library('jquery_pagination');

        $this->mi_session->verificar_inactividad();
	}

			 
	public function index()
	{   
		$this->mostrar();
	}

	public function mostrar($offset=0)
	{
		if($this->input->is_ajax_request())
        {
			if ($this->input->post('estado') == 1)
			{
				$estado = $this->input->post('estado');
				$config['base_url'] = base_url().'usuarios/mostrar';
			    $config['div'] = '#resultado';
			    $config['additional_param'] = "{'estado' : '$estado'}";
			    $config['show_count'] = true;
			    $config['total_rows'] = $this->global_model->total_usuarios('estado','1');
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
	  			
	  			 $datos['select']= 'id, nombre, apellido, usuario, correo, tipo_operador, estado';
			     $datos['tabla']= 'usuarios';
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
	            
	            $data['total_usuarios'] = $this->global_model->metodoanteguo('usuarios','cuenta');
	    		$data['activos'] = $this->global_model->metodoanteguo('usuarios','cuenta','','estado','1');
	    		$data['inactivos'] = $this->global_model->metodoanteguo('usuarios','cuenta','','estado','2');
	    		$data['admin'] = $this->global_model->metodoanteguo('usuarios','cuenta','','tipo_operador','1');
	    		$data['registrados'] = $this->global_model->metodoanteguo('usuarios','cuenta','','tipo_operador','2');
				$this->load->view('mostrar',$data);
			 }
			 else
			 {
				 if ($this->input->post('estado') == 2)
				 {
					$estado = $this->input->post('estado');
					$config['base_url'] = base_url().'usuarios/mostrar';
				    $config['div'] = '#resultado';
				    $config['additional_param'] = "{'estado' : '$estado'}";
				    $config['show_count'] = true;
				    $config['total_rows'] = $this->global_model->total_usuarios('estado','2');
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
		  			
		  			 $datos['select']= 'id, nombre, apellido, usuario, correo, tipo_operador, estado';
				     $datos['tabla']= 'usuarios';
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
	                    $data['total_usuarios'] = $this->global_model->metodoanteguo('usuarios','cuenta');
	            		$data['activos'] = $this->global_model->metodoanteguo('usuarios','cuenta','','estado','1');
	            		$data['inactivos'] = $this->global_model->metodoanteguo('usuarios','cuenta','','estado','2');
	            		$data['admin'] = $this->global_model->metodoanteguo('usuarios','cuenta','','tipo_operador','1');
	            		$data['registrados'] = $this->global_model->metodoanteguo('usuarios','cuenta','','tipo_operador','2');
						$this->load->view('mostrar',$data);
					 }
					 else
					 {
					 	 if ($this->input->post('grupo') == 1)
						 {
							$grupo = $this->input->post('grupo');
							$config['base_url'] = base_url().'usuarios/mostrar';
						    $config['div'] = '#resultado';
						    $config['additional_param'] = "{'grupo' : '$grupo'}";
						    $config['show_count'] = true;
						    $config['total_rows'] = $this->global_model->total_usuarios('tipo_operador','1');
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
				  			
				  			 $datos['select']= 'id, nombre, apellido, usuario, correo, tipo_operador, estado';
						     $datos['tabla']= 'usuarios';
						     $datos["where"] = array(
											0 => array("campo" => "tipo_operador", "valor" => $grupo, "tipo" => "where")
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
	                            $data['total_usuarios'] = $this->global_model->metodoanteguo('usuarios','cuenta');
	                    		$data['activos'] = $this->global_model->metodoanteguo('usuarios','cuenta','','estado','1');
	                    		$data['inactivos'] = $this->global_model->metodoanteguo('usuarios','cuenta','','estado','2');
	                    		$data['admin'] = $this->global_model->metodoanteguo('usuarios','cuenta','','tipo_operador','1');
	                    		$data['registrados'] = $this->global_model->metodoanteguo('usuarios','cuenta','','tipo_operador','2');
								$this->load->view('mostrar',$data);
							 }
							 else{
							 		 if ($this->input->post('grupo') == 2)
									 {
										$grupo = $this->input->post('grupo');
										$config['base_url'] = base_url().'usuarios/mostrar';
									    $config['div'] = '#resultado';
									    $config['additional_param'] = "{'grupo' : '$grupo'}";
									    $config['show_count'] = true;
									    $config['total_rows'] = $this->global_model->total_usuarios('tipo_operador','2');
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
							  			
							  			 $datos['select']= 'id, nombre, apellido, usuario, correo, tipo_operador, estado';
									     $datos['tabla']= 'usuarios';
									     $datos["where"] = array(
														0 => array("campo" => "tipo_operador", "valor" => $grupo, "tipo" => "where")
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
	                                    
	                                    $data['total_usuarios'] = $this->global_model->metodoanteguo('usuarios','cuenta');
	                            		$data['activos'] = $this->global_model->metodoanteguo('usuarios','cuenta','','estado','1');
	                            		$data['inactivos'] = $this->global_model->metodoanteguo('usuarios','cuenta','','estado','2');
	                            		$data['admin'] = $this->global_model->metodoanteguo('usuarios','cuenta','','tipo_operador','1');
	                            		$data['registrados'] = $this->global_model->metodoanteguo('usuarios','cuenta','','tipo_operador','2');
										$this->load->view('mostrar',$data);
							 }
							 else
							 {
									$config['base_url'] = base_url().'usuarios/mostrar';
								    $config['div'] = '#resultado';
								    //$config['additional_param'] = "{'estado' : '$estado'}";
								    $config['show_count'] = true;
								    $config['total_rows'] = $this->global_model->total_usuarios();
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
						  			
						  			 $datos['select']= 'id, nombre, apellido, usuario, correo, tipo_operador, estado';
								     $datos['tabla']= 'usuarios';
								     $datos['limit']=  $config['per_page'];
								     $datos['offset']=  $offset;
								   
								     $filas = $this->global_model->mostrar($datos);
								     $paginacion = $this->jquery_pagination->create_links();    

								      $data = array
								     (
										'filas' => $filas,
										'paginacion' => $paginacion
								     );
	                                
	                                
	                                $data['total_usuarios'] = $this->global_model->metodoanteguo('usuarios','cuenta');
	                        		$data['activos'] = $this->global_model->metodoanteguo('usuarios','cuenta','','estado','1');
	                        		$data['inactivos'] = $this->global_model->metodoanteguo('usuarios','cuenta','','estado','2');
	                        		$data['admin'] = $this->global_model->metodoanteguo('usuarios','cuenta','','tipo_operador','1');
	                        		$data['registrados'] = $this->global_model->metodoanteguo('usuarios','cuenta','','tipo_operador','2');
	                                
									$this->load->view('mostrar',$data);
								 }	
							}	
					 }	       
				 }
			}
			else
			{
				show_404();
			}	 	  
	}

	public function registrarusuario()
	{
		if ($this->input->is_ajax_request()) 
		{
			if (!$this->input->post('enviado')) 
			{
				$this->load->view('registrarusuario');
			}
			else
			{
				$this->form_validation->set_rules('nombre', 'Nombres', 'trim|required');
				$this->form_validation->set_rules('apellido', 'Apellidos', 'trim|required');
				$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|callback_confirmar_usuario|callback_validar_usuario');
				$this->form_validation->set_rules('clave', 'Clave', 'trim|required|matches[cclave]|md5');
            	$this->form_validation->set_rules('cclave', 'Repita Clave', 'trim|required|md5');	
				$this->form_validation->set_rules('correo','Correo electrónico','trim|required|valid_email|callback_confirmar_correo');
				$this->form_validation->set_rules('id_operador', 'Operador', 'trim|required');
				
				$this->form_validation->set_message('required', '<i class="fa fa-exclamation-triangle"></i> El Campo %s es obligatorio');
				$this->form_validation->set_message('matches', '<i class="fa fa-exclamation-triangle"></i> Los campos %s no coincide.');

				if ($this->form_validation->run($this) == FALSE)
				{
					echo json_encode(array('success'=>false, 'mensaje' => validation_errors('<div class="alert alert-danger alert-dismissible" role="alert">', '</div>')));
				}
				else
				{
					extract($_POST);
				
					if ($_FILES['userfile']['name'] != '') 
					{
						$usuario = $this->input->post('usuario');
						$respuesta = $this->subir_foto($usuario);

						if (!is_array($respuesta)) 
						{
							$cbd["tabla"] = "usuarios";
						    $datos = array(
								'foto' => $respuesta,
								'usuario' => $this->input->post('usuario'),
								'nombre' => $this->input->post('nombre'),
								'apellido' => $this->input->post('apellido'),
								'password' => $this->input->post('clave'),
								'correo' => $this->input->post('correo'),
								'tipo_operador' => $this->input->post('id_operador'),
								'fecha_registro' => FECHAGESTOR,
								'estado' => 1,
							);
							$this->global_model->agregar($cbd, $datos);

							$id = $this->db->insert_id();

							echo json_encode(array('id'=> $id, 'mensaje' => 'Registro de Usuario Correcto'));
						}
						else
						{
							$respuestacarga = implode('', $respuesta);
							$alerta = '<div class="alert alert-danger alert-dismissible" role="alert">';
							echo json_encode(array('success'=>false, 'mensaje' => $alerta.$respuestacarga));
						}		
						//$this->estados_citas($id);
					}
					else
					{
							$cbd["tabla"] = "usuarios";
						    $datos = array(
								'foto' => 'anonimo.jpg',
								'usuario' => $this->input->post('usuario'),
								'nombre' => $this->input->post('nombre'),
								'apellido' => $this->input->post('apellido'),
								'password' => $this->input->post('clave'),
								'correo' => $this->input->post('correo'),
								'tipo_operador' => $this->input->post('id_operador'),
								'estado' => 1,
								'fecha_registro' => FECHAGESTOR,
							);
							$this->global_model->agregar($cbd, $datos);

							$id = $this->db->insert_id();

							echo json_encode(array('id'=>$id, 'mensaje' => 'Registro de Usuario Correcto'));
					}	
				}
			}
		}
		else
		{
			show_404();
		}
	}

	function mostrarusuario()
    {
    	if($this->input->is_ajax_request())
        {
	        if ($this->input->post('id'))
	        {
	            $data['tabla']= 'usuarios';
	            $data["where"] = array(0 => array("campo" => "id", "valor" => $this->input->post('id'), "tipo" => "where"));
	            $datos["filas"] = $this->global_model->mostrar($data);
	            $this->load->view('mostrarusuario',$datos);
	        }
	        else
	        {
	            $data['tabla']= 'usuarios';
	            $datos["filas"] = $this->global_model->mostrar($data);
	            $this->load->view('mostrarusuario',$datos);
	        }
	     }
	     else
	     {
	     	show_404();
	     }   

    }

	function confirmar_correo($val)
	{
		$datos['tabla'] = 'usuarios';	
		$datos['select'] = '';	
		$datos['where'] = array(0 => array("campo" => "correo", "valor" => $val, "tipo" => "where"));
		$datos['filas'] = $this->global_model->mostrar($datos);

		if(isset($datos['filas']["error"]) == FALSE)
        {
			$this->form_validation->set_message('confirmar_correo', '<i class="fa fa-exclamation-triangle"></i> El Correo '.$val.' ya existe en nuestra base de datos');
        	return false;
		}
		else
		{
			return true;
		}
	}	

	function confirmar_usuario($val)
	{
		$datos['tabla'] = 'usuarios';	
		$datos['select'] = '';	
		$datos['where'] = array(0 => array("campo" => "usuario", "valor" => $val, "tipo" => "where"));
		$datos['filas'] = $this->global_model->mostrar($datos);

		if(isset($datos['filas']["error"]) == FALSE)
        { 
			$this->form_validation->set_message('confirmar_usuario', '<i class="fa fa-exclamation-triangle"></i> El Nombre de Usuario '.$val.' ya existe en nuestra base de datos');
        	return false;
		}
		else
		{
			return true;
		}
	}	
		
    function validar_usuario($val)
	{
	    if(!preg_match("/^\w+$/", $val))
	    {
	    	$this->form_validation->set_message('validar_usuario', '<i class="fa fa-exclamation-triangle"></i> Indique su nombre de usuario (no se aceptan espacios en blanco ni tildes)');
	        return false;
	    }
	    else
	    {
	    	 return true;
	    }
	}

	function editar_usuario()
	{
		if($this->input->is_ajax_request())
		{
			$data['select']= 'id, foto, nombre, apellido, usuario, correo, tipo_operador';
			$data['tabla']= 'usuarios';
			$data["where"] = array(0 => array("campo" => "id", "valor" => $this->input->post('id'), "tipo" => "where"));
			$datos["filas"] = $this->global_model->mostrar($data);

			if(!isset($datos["filas"]["error"]))
			{
				if(!$this->input->post('enviado'))
				{
					$this->load->view('usuario_editar',$datos);
				}
				else
				{
					$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required');
					$this->form_validation->set_message('required', 'El Campo %s es obligatorio');

					if ($this->form_validation->run() == FALSE)
					{
						$this->load->view('usuario_editar',$datos);
					}
					else
					{
						if ($_FILES['userfile']['name'] != '') 
						{
							$usuario = $this->input->post('usuario');
							$respuesta = $this->subir_foto($usuario);

							if (!is_array($respuesta)) 
							{
									$cbd["tabla"] = "usuarios";
									$cbd["where"] = array(
											0 => array("campo" => "id", "valor" => $this->input->post('id'), "tipo" => "where")
										);

								    $datos = array(
										'foto' => $respuesta,
										'usuario' => $this->input->post('usuario'),
										'nombre' => $this->input->post('nombre'),
										'apellido' => $this->input->post('apellido'),
										'tipo_operador' => $this->input->post('id_operador'),
										'correo' => $this->input->post('correo'),
										'fecha_editado' => FECHAGESTOR,
									);
									$this->global_model->actualizar($cbd, $datos);

									$data['select']= 'id, foto, nombre, apellido, usuario, correo';
									$data['tabla']= 'usuarios';
									$data["where"] = array(0 => array("campo" => "id", "valor" => $this->input->post('id'), "tipo" => "where"));
									$datos["filas"] = $this->global_model->mostrar($data);

									$datos['editado'] = 'Usuario Editado';
									$this->load->view('usuario_editar',$datos);
									//echo "Editado";
							}
							else
							{
									$datos['respuesta'] = $respuesta;
									$this->load->view('usuario_editar',$datos);
							}		
							//$this->estados_citas($id);
						}
						else
						{
								$cbd["tabla"] = "usuarios";
								$cbd["where"] = array(
										0 => array("campo" => "id", "valor" => $this->input->post('id'), "tipo" => "where")
									);
								$datos = array(
									'usuario' => $this->input->post('usuario'),
									'nombre' => $this->input->post('nombre'),
									'apellido' => $this->input->post('apellido'),
									'tipo_operador' => $this->input->post('id_operador'),
									'correo' => $this->input->post('correo'),
									'fecha_editado' => FECHAGESTOR,
									);
								$this->global_model->actualizar($cbd, $datos);

								
								$data['select']= 'id, foto, nombre, apellido, usuario, correo';
								$data['tabla']= 'usuarios';
								$data["where"] = array(0 => array("campo" => "id", "valor" => $this->input->post('id'), "tipo" => "where"));
								$datos["filas"] = $this->global_model->mostrar($data);

								$datos['editado'] = 'Usuario Editado';
								$this->load->view('usuario_editar',$datos);
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

	function mostrarDetalle(){
		$this->load->view('detalleclientes');
	}

	 function borrarusuario()
    {
    	if($this->input->is_ajax_request())
        {
            $cbd["tabla"] = "usuarios";
            $cbd["where"] = array(
                    0 => array("campo" => "id", "valor" =>  $this->input->post('id'), "tipo" => "where")
                );

            $this->global_model->borrar($cbd);

          	$this->mostrar();
        }
        else
        {
        	show_404();
        }  	
    }

    function habiliatinabilitarusuario()
    {
    	if($this->input->is_ajax_request())
        {
        	if ($this->input->post('habilitar'))
        	{
				$cbd["tabla"] = "usuarios";
				$cbd["where"] = array(
						0 => array("campo" => "id", "valor" => $this->input->post('habilitar'), "tipo" => "where")
					);
				$datos = array(
					'fecha_editado' => FECHAGESTOR,
					'estado' => 1,
					);
				$this->global_model->actualizar($cbd, $datos);

				$this->mostrar();
        	}
        	else
        	{
        		if ($this->input->post('inhabilitar')) 
        		{
        			$cbd["tabla"] = "usuarios";
        			$cbd["where"] = array(
						0 => array("campo" => "id", "valor" => $this->input->post('inhabilitar'), "tipo" => "where")
					);
					$datos = array(
						'fecha_editado' => FECHAGESTOR,
						'estado' => 2,
						);
					$this->global_model->actualizar($cbd, $datos);

					$this->mostrar();
        		}
        	}
        }
    }

	function subir_foto($usuario)
    {
        if(!is_dir($usuario))
        {
            @mkdir($config['upload_path'] = './public/img/perfil/'.$usuario);
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 6000;
            $config['quality'] = '90%';
            $config['file_name']  = $this->input->post('usuario');

            $this->load->library('upload');
            $this->upload->initialize($config);

            if (!$this->upload->do_upload())
            {
                $error = array('error' => $this->upload->display_errors());

                return $error;
            }
            else
            {
                $data = $this->upload->data();
                $this->create_thumb($data['file_name'],$usuario);
                return $data['file_name'];
            }
        }
    }

    function create_thumb($imagen, $usuario)
    {
        $this->load->library('image_lib');

        if(!is_dir($usuario))
        {
            $config['image_library'] = 'GD2';
            @mkdir($config['source_image']  = 'public/img/perfil/'.$usuario.'/'.$imagen);
            $config['thumb_marker'] = '';
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width']    = 150;
            $config['height']   = 150;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
         }
    }

    function formulariobusquedausuario()
    {
    	if($this->input->is_ajax_request())
        {
    		$this->load->view('buscarusuario');
    	}
    	else
    	{
    		show_404();
    	}	
    }

    function buscarusuario($offset=0)
    {
    	if($this->input->is_ajax_request())
        {
	    	if ($this->input->post('buscarusuario') == NULL) 
	    	{
	    		echo 'El Campo esta Vacio Por favor Ingrese Algo';
	    	}
	    	else
	    	{
	    		$buscar = $this->input->post('buscarusuario');
		    	$config['base_url'] = base_url().'usuarios/buscarusuario';
			    $config['div'] = '#busqueda';
			    $config['additional_param'] = "{'buscarusuario' : '$buscar'}";
			    $config['show_count'] = true;
			    $config['total_rows'] = $this->global_model->filas_paginada($this->input->post('buscarusuario'));
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
					
			     $filas = $this->global_model->total_posts_paginados($this->input->post('buscarusuario'),$config['per_page'],$offset);
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

	public function estadistica()
	{
        $grafico1 = "[";
        	
        	$data['registrados'] = $this->global_model->metodoanteguo('usuarios','cuento', '', '', /*4*/''/*4*/, '', '', '',/*8*/ ''/*8*/, '', '', '', /*12*/''/*12*/, '', '', '',''); 
            $grafico1.="['Registrados',".$data['registrados']."],"; 

            $data['admin'] = $this->global_model->metodoanteguo('usuarios','cuento', '', 'tipo_operador', /*4*/'1'/*4*/, '', '', '',/*8*/ ''/*8*/, '', '', '', /*12*/''/*12*/, '', '', '','tipo_operador'); 
            $grafico1.="['Administradores',".$data['admin']."],"; 

            $data['activos'] = $this->global_model->metodoanteguo('usuarios','cuento', '', 'estado', /*4*/'1'/*4*/, '', '', '',/*8*/ ''/*8*/, '', '', '', /*12*/''/*12*/, '', '', '','estado'); 
            $grafico1.="['Usuarios Activos',".$data['activos']."],";  

            $data['inactivo'] = $this->global_model->metodoanteguo('usuarios','cuento', '', 'estado', /*4*/'2'/*4*/, '', '', '',/*8*/ ''/*8*/, '', '', '', /*12*/''/*12*/, '', '', '','estado'); 
            $grafico1.="['Usuarios Inactivo',".$data['inactivo']."],";  

        $grafico1 = $grafico1."]";

        $data['activo'] = $grafico1;

		$this->load->view('estadistica',$data);
	}
}
