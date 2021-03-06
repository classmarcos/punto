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

	
     function formulariobusquedacliente()
    {
    	if($this->input->is_ajax_request())
        {
    		$this->load->view('buscarcliente');
    	}
    	else
    	{
    		show_404();
    	}	
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
	    		 
			      $filas = $this->global_model->total_posts_paginados($this->input->post('buscarcliente'),$this->session->userdata('id_usuario'));
			      
			      $data = array(
					'filas' => $filas
					
			     );
				$this->load->view('mostrarbusqueda',$data);
	    	}
	    }
	    else
	    {
	    	show_404();
	    }	
    }

     public function pagar(){

    	if($this->input->is_ajax_request())
        {
	    	
	    	 $filas = $this->input->post('fila');
	    	 $myArray = explode(';', $filas);


	    	 $Contrato = $myArray[0];
	    	 $Nombre = $myArray[1];
	    	 $Cedula = $myArray[2];
	    	 $Estatus = $myArray[3];
	    	 $Direccion = $myArray[4];
	    	 $Balance = $myArray[5];
	    	 $accion = $myArray[6];
	    	
		      $data = array(
		      	'Contrato' => $Contrato,
	      		'Nombre' => $Nombre,
	  			'Cedula' => $Cedula,
				'Estatus' => $Estatus,
				'Direccion' => $Direccion,
				'accion'=>$accion,
				'Balance' => $Balance,
				'Montoapagar'=>''
		     );
		    
			 $this->load->view('pagar_deudas',$data);
		 }
	    else
	    {
	    	show_404();
	    }	
    }

    function ejemplopagar(){

    	$datos= $this->global_model->pagos('A0002901A','1007','1','mensualidad','','','','','','','','');
    	$resp = json_decode($datos, true);
    	//var_dump("");
    	//foreach ($resp as $key) {
    		var_dump( $resp);
    		//var_dump($resp['resultado']);
    		//var_dump($resp['TRN']);

    		//echo $resp["resultado"];
    	//}
    }

    function realizarPago(){
    	if($this->input->is_ajax_request())
        {
 
			$Nombre = $this->input->post('Nombre');
			$Cedula = $this->input->post('Cedula');
	    	$Contrato = $this->input->post('Contrato');
	    	$Direccion = $this->input->post('Direccion');
	    	$Monto = $this->input->post('Montoapagar');
	    	$accion=$this->input->post('id_accion');
	    	$Estatus = $this->input->post('Estatus');
	    	$Balance = $this->input->post('Balance');
	    	
	    	if($accion==1){
	    		$Type ='mensualidad' ;
	    	}elseif ($accion==2) {
	    		$Type ='caja' ;
	    	}elseif ($accion==3) {
	    		$Type ='reconexion' ;
	    	}

	    	$StringImei =$this->session->userdata('id_usuario');

	    	$json =  $this->global_model->pagos($Contrato,$StringImei,$Monto,$Type,'','','','','','','','');

			$resp = json_decode($json, true);

			 
			 			
				if(isset($resp["resultado"])){
					if($resp["Id"]==100){
					
		    			
    			

					 $data = array(
				      	'Contrato' => $Contrato,
			      		'Nombre' => $Nombre,
			  			'Cedula' => $Cedula,
						'Estatus' => $Estatus,
						'Direccion' => $Direccion,
						'Balance' => $Balance,
						'accion' => $accion,
						'pagado'=>'Pago realizado exitosamente',
						'Montoapagar'=>$Monto,
						'TRN' =>$resp["resultado"][0]['TRN'],
						'fecha'=>$resp["resultado"][0]["Fecha"],
						'usuario'=>$resp["resultado"][0]["Nombre"],
						'conceptoPago' =>$resp["resultado"][0]["ConceptoPago"]
					
		     		);
					 }
					$this->load->view('pagar_deudas',$data);
					
				}else{
						echo "No Existe";
					}
	     
	    }
		else
	    {
	    	show_404();
	    }	
    }

    function mostrarDetalle(){
    	if($this->input->is_ajax_request())
        {
	    	 $arreglo = $this->input->post('fila');
	    	 $myArray = explode(';', $arreglo);

	    	 $Contrato = $myArray[0];
	    	 $Balance = $myArray[1];
	    	 $BalanceCaja = $myArray[2];
	    	 $BalanceMensualidad = $Balance-$BalanceCaja;

		     $mensualidad = $this->global_model->detallecliente($Contrato,'mensualidad');
		     $caja = $this->global_model->detallecliente($Contrato,'caja');
			     
		      $data = array(
				'mensualidad' => $mensualidad,
				'caja' =>$caja,
				'Contrato' =>$Contrato,
				'Balance' =>$Balance,
				'BalanceCaja' =>$BalanceCaja,
				'BalanceMensualidad' =>$BalanceMensualidad
				
		     );
				

			$this->load->view('detallescliente',$data);
		}
		else
	    {
	    	show_404();
	    }	
	}





	 function credit_info(){
		//$this->chequeousuario->estara_en_sesion(true);



			/*$type = $this->input->post('type');
			$parameter = $this->input->post('parameter');*/

			$type = 'caja';
			$parameter = 'V0400201A%';


			$cred_info = $this->global_model->get_user_detail($parameter, $type);


			$sumBalance['Balance'] = 0;
			if ($cred_info['resultado'] !== null) {
				foreach ($cred_info['resultado'] as $value) {
					foreach ($value as $id => $valuetwo) {
						$id === "Balance" ? (isset($sumBalance[$id]) ? $sumBalance[$id] += $valuetwo : $sumBalance[$id] = $valuetwo) : '';
					}
				}
			}

			$totalRecords = count($cred_info['resultado']);
			$results = $cred_info['resultado'];

			$json_output = array(
				'total' => 0,
				'page' => 0,
				'records' => $totalRecords,
				'rows' => $results,
				'sumBalance' => number_format($sumBalance['Balance'], 2)
			);

			echo json_encode($json_output);

	}


	function facturar(){
		if($this->input->is_ajax_request())
        {

			$this->load->view('factura');
		}
		else
	    {
	    	show_404();
	    }	
	}





    /*function mostrarcliente()
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

	}*/


     	/*function mostrar(){
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

		}	 */ 

  
   



   
	
}

?>