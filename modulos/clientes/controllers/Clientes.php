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

    function pagar_servicios(){
    	$this->load->view('pagar_servicios');
    } 

    function pagar(){

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
	    	 $tarifa = $myArray[7];
	    	 $caja = $myArray[8];

	    	if($accion==1){
	    		$detalle = $this->global_model->detallecliente($Contrato,'mensualidad');
	    	}else if($accion==2){
	    		$detalle = $this->global_model->detallecliente($Contrato,'caja');
	    		$tarifa="";
	    	}

	    	if($accion==3){
	    		$Montoapagar='200';
	    		$detalle="";
	    		$tarifa="";
	    	}else{
	    		$Montoapagar='';
	    	}


	    	$Bancos = $this->global_model->buscarBancos();

		    $data = array(
		      	'Contrato' => $Contrato,
	      		'Nombre' => $Nombre,
	  			'Cedula' => $Cedula,
				'Estatus' => $Estatus,
				'Direccion' => $Direccion,
				'accion'=>$accion,
				'Balance' => $Balance,
				'Montoapagar'=>$Montoapagar,
				'detalle' => $detalle,
				'tarifa' =>$tarifa,
				'Bancos' =>$Bancos,
				'Caja'	=>$caja,
				'Cuenta'=>'',
				'Cheque'=>'',
				'Formapago'=>'EF',
				'Banco'=>'',
				'tipotarjeta'=>''
		     );
		    
			 $this->load->view('pagar_deudas',$data);
		 }
	    else
	    {
	    	show_404();
	    }	
    }

    public function pruebatodo()
	{
		$this->load->view('pruebatodo');
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
	    	$accion=$this->input->post('id_accion');// si es mensualidad, caja o reconexion
	    	$Estatus = $this->input->post('Estatus');
	    	$Balance = $this->input->post('Balance');
	    	$tarifa = $this->input->post('Mensualidad');//tarifa fija
	    	$formapago=$this->input->post('formapago');
	    	$caja =$this->input->post('Caja'); 
			$cuenta = $this->input->post('Cuenta'); 
			$cheque = $this->input->post('Cheque'); 
			$Banco = $this->input->post('Banco'); //banco seleccionado
			$tipotarjeta = $this->input->post('tipotarjeta');
			$Bancos = $this->global_model->buscarBancos();//todos los bancos
			
			if($accion==1){
				$Type ='mensualidad' ;
	    		$detalle = $this->global_model->detallecliente($Contrato,'mensualidad');
	    		$this->form_validation->set_rules('Montoapagar', 'Monto a pagar', 'trim|required|is_natural_no_zero');
	    	}else if($accion==2){
	    		$Type ='caja' ;
	    		$detalle = $this->global_model->detallecliente($Contrato,'caja');
	    		$this->form_validation->set_rules('Montoapagar', 'Monto a pagar', 'trim|required|is_natural_no_zero|less_than_equal_to['.$Balance.']');
	    	
    		}
 			if($formapago=='EF'){
				$insert='';
 			}else if($formapago=='CK'){
 				$this->form_validation->set_rules('Banco', 'Banco', 'trim|required');
 				$this->form_validation->set_rules('Cuenta', 'Cuenta', 'trim|required');
				$this->form_validation->set_rules('Cheque','Cheque','trim|required');
				$insert =$this->input->post('Cheque').','.$this->input->post('Banco').','.$Monto.','.$this->input->post('Cuenta');
 			}else if($formapago=='TA'){
 				$this->form_validation->set_rules('Banco', 'Banco', 'trim|required');
 				$this->form_validation->set_rules('tipotarjeta', 'Tipo de Tarjeta', 'trim|required');
 				$this->form_validation->set_rules('Cuenta', 'Cuenta', 'trim|required');
				$this->form_validation->set_rules('Cheque','Cheque','trim|required');
				$insert =$this->input->post('Cheque').','.$this->input->post('Banco').','.$Monto.','.$this->input->post('Cuenta').',"'.$this->input->post('tipotarjeta').'"';	
 			}

			$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
			
			$this->form_validation->set_message('required', '<i class="fa fa-exclamation-triangle"></i> El campo %s es Obligatorio');
			$this->form_validation->set_message('is_natural_no_zero', '<i class="fa fa-exclamation-triangle"></i> El campo %s debe contener s&oacute;lo n&uacute;meros mayores a 0');
			$this->form_validation->set_message('matches', '<i class="fa fa-exclamation-triangle"></i> El campo %s no puede ser ni mayor ni menor al %s a cobrar');
			$this->form_validation->set_message('less_than_equal_to', '<i class="fa fa-exclamation-triangle"></i> El campo %s debe ser menor que %s.');
			
			if($this->form_validation->run() == FALSE) // Condicionamos l validación del formulario
			{
				$data = array(
				      	'Contrato' 		=>	$Contrato,
			      		'Nombre' 		=>	$Nombre,
			  			'Cedula' 		=>	$Cedula,
						'Estatus' 		=>	$Estatus,
						'Direccion' 	=>	$Direccion,
						'Balance' 		=>	$Balance,
						'accion' 		=>	$accion,
						'error'			=>	validation_errors(),
						'Montoapagar'	=>	$Monto,
						'tarifa'		=>	$tarifa,
						'detalle'		=>	$detalle,
						'Bancos'		=>	$Bancos,
						'Caja'			=>	$caja,
						'Cuenta'		=>	$cuenta,
						'Cheque'		=>	$cheque,
						'Formapago'		=>	$formapago,
						'Banco'			=>	$Banco,
						'tipotarjeta'	=>	$tipotarjeta,
		     		);
	     		$this->load->view('pagar_deudas',$data);
			}
			else{

		    	
		    	$this->load->library('html_to_pdf/pdf_generator');

		    	$StringImei =$this->session->userdata('id_usuario');

		    	$json =$this->global_model->pagos($Contrato,$StringImei,$Monto,$Type,'','',$formapago,$insert,'','','','');

				$resp = json_decode($json, true);

			
		/*
            $print_template = 'template_cutter';
        

			 $table_body = '';
            if (!empty($datos['resultado'][0]['ConceptoPago'])) {
                $val = explode(';',$datos['resultado'][0]['ConceptoPago']); //$datos['resultado'][0]['ConceptoPago']
                if ($print_template === 'template_cutter'){
                    for ($i=0; $i < count($val) - 1; $i++) { 
                        $table_body.=   '<tr>
                                             <td style="width: 70%; text-align: left; font-size: 270%;">'.$val[$i].'</td>
                                            <td style="width: 30%; text-align: left; font-size: 270%;"><div style="width: 40%; margin:0; padding:0; text-align: right;">'.$val[$i +1].'</div></td>
                                        </tr>'; 
                                        //<td style="width: 30%; text-align: right">$val[$i +1]</td>
                        $i++;
                    }
                } else{
                    for ($i=0; $i < count($val) - 1; $i++) { 
                        $table_body.=   '<tr>
                                             <td style="width: 70%; text-align: left;">'.$val[$i].'</td>
                                            <td style="width: 30%; text-align: left;"><div style="width: 40%; margin:0; padding:0; text-align: right;">'.$val[$i +1].'</div></td>
                                        </tr>'; 
                                        //<td style="width: 30%; text-align: right">$val[$i +1]</td>
                        $i++;
                    }
                }
            }
            
            //$valor_pendiente = number_format($datos['resultado'][0]['balanceAnterior'] - $datos['resultado'][0]['Pagado'], 2, '.', ',');

            $variables = array(
                'date' => date("d-m-Y", strtotime($datos['resultado'][0]['Fecha'])),
                'table_body' => $table_body,
                //'tabla' => '',
                'cliente' => $Nombre,//$datos['resultado'][0]['NomCli'],
                'id_invoice' =>$datos['resultado'][0]['TRN'],
                'contract' => $Contrato,//$parameter,
                'total' => $Monto,//$datos['resultado'][0]['Pagado'],
                'cobrador' => $datos['resultado'][0]['Nombre'], //Este es el cobrador
                'BAnterior' => $Balance,//$datos['resultado'][0]['balanceAnterior'],
                'VPendiente' => '0.00',//$valor_pendiente,
                'direccion_empresa' => '',//$this->session->userdata('impresion_Direccion'),
                'ciudad_empresa' => '',//$this->session->userdata('impresion_Ciudad'),
                'telefono_empresa' => '',//$this->session->userdata('impresion_Telefono'),
                'fax_empresa' => '',//$this->session->userdata('impresion_Fax'),
                'rnc_empresa' => '104-01619-1'
            );

            var_dump($variables);

            foreach ($variables as $key => $value) {
                $template = str_replace("@$key@", $value, $template);
            }

            $html2pdf = new HTML2PDF('P','A4','fr');
            $html2pdf->WriteHTML($template);
            $html2pdf->Output( $Contrato . ' ' . $datos['resultado'][0]['Fecha'] . ' ' . $datos['resultado'][0]['TRN'] . '.pdf');
      
*/			
				if(isset($resp["resultado"])){
					if($resp["Id"]==100){

					 $data = array(
				      	'Contrato' 		=>	$Contrato,
			      		'Nombre' 		=>	$Nombre,
			  			'Cedula' 		=>	$Cedula,
						'Estatus' 		=>	$Estatus,
						'Direccion' 	=>	$Direccion,
						'Balance' 		=>	$Balance,
						'accion' 		=>	$accion,
						'pagado'		=>	'Pago realizado exitosamente',
						'Montoapagar'	=>	$Monto,
						'TRN' 			=>	$resp["resultado"][0]['TRN'],
						'fecha'			=>	$resp["resultado"][0]["Fecha"],
						'usuario'		=>	$resp["resultado"][0]["Nombre"],
						'conceptoPago'	=>	$resp["resultado"][0]["ConceptoPago"],
						'tarifa'		=>	$tarifa,
						'detalle'		=>	$detalle,
						'Bancos'		=>	$Bancos,
						'Caja'			=>	$caja
					
		     		);
					 }
					
					$this->load->view('factura',$data);
				}else{
						echo "No Existe";
					}
	     	}
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

	public function pago_reconexion(){
	//if($this->input->is_ajax_request())
   // {

		if ($this->session->userdata('id_usuario') === NULL){
			return ;
		}

		$Nombre = $this->input->post('Nombre');
		$Cedula = $this->input->post('Cedula');
    	$Contrato = $this->input->post('Contrato');
    	$Direccion = $this->input->post('Direccion');
    	$Monto = $this->input->post('Montoapagar');
    	$accion=$this->input->post('id_accion');
    	$Estatus = $this->input->post('Estatus');
    	$Balance = $this->input->post('Balance');
    	$tarifa = $this->input->post('Mensualidad');
    	$formapago=$this->input->post('formapago');
    	$caja =$this->input->post('Caja'); 
		$Bancos = $this->global_model->buscarBancos();
		$cuenta = $this->input->post('Cuenta'); 
		$cheque = $this->input->post('Cheque'); 
		$Banco = $this->input->post('Banco'); 
		$tipotarjeta = $this->input->post('tipotarjeta'); 
		$this->load->model('global_model');

		//$type = $this->input->post('type') ? $this->input->post('type') : "0";
		
		//$mount = $this->input->post('mount') ? $this->input->post('mount') : "100";
		//$contract = $this->input->post('contract') ? $this->input->post('contract') : "N0170001A";

		//$Monto = '200';
		//
		//$Contrato = 'T00000001A';

		if($formapago=='CK'){
			$this->form_validation->set_rules('Banco', 'Banco', 'trim|required');
			$this->form_validation->set_rules('Cuenta', 'Cuenta', 'trim|required');
			$this->form_validation->set_rules('Cheque','Cheque','trim|required');
		}else if($formapago=='TA'){
			$this->form_validation->set_rules('Banco', 'Banco', 'trim|required');
			$this->form_validation->set_rules('tipotarjeta', 'Tipo de Tarjeta', 'trim|required');
			$this->form_validation->set_rules('Cuenta', 'Cuenta', 'trim|required');
			$this->form_validation->set_rules('Cheque','Cheque','trim|required');
		}

 			
		$this->form_validation->set_rules('Montoapagar', 'Monto a pagar', 'trim|required|is_natural_no_zero|less_than_equal_to[200]|greater_than_equal_to[200]');	    	

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');

		$this->form_validation->set_message('required', '<i class="fa fa-exclamation-triangle"></i> El campo %s es Obligatorio');
		$this->form_validation->set_message('is_natural_no_zero', '<i class="fa fa-exclamation-triangle"></i> El campo %s debe contener s&oacute;lo n&uacute;meros mayores a 0');
		$this->form_validation->set_message('matches', '<i class="fa fa-exclamation-triangle"></i> El campo %s no puede ser ni mayor ni menor al %s');
		$this->form_validation->set_message('less_than_equal_to', '<i class="fa fa-exclamation-triangle"></i> El campo %s debe ser menor a la cantidad ingresada.');
		$this->form_validation->set_message('greater_than_equal_to', '<i class="fa fa-exclamation-triangle"></i> El campo %s debe ser mayor a la cantidad ingresada.');
	

		if($this->form_validation->run() == FALSE) // Condicionamos l validación del formulario
		{
			$data = array(
			      	'Contrato' 		=>	$Contrato,
		      		'Nombre' 		=>	$Nombre,
		  			'Cedula' 		=>	$Cedula,
					'Estatus' 		=>	$Estatus,
					'Direccion' 	=>	$Direccion,
					'Balance' 		=>	$Balance,
					'accion' 		=>	$accion,
					'error'			=>	validation_errors(),
					'Montoapagar'	=>	$Monto,
					'tarifa'		=>	$tarifa,
					'detalle'		=>	'',
					'Bancos'		=>	$Bancos,
					'Caja'			=>	$caja,
					'Cuenta'		=>	$cuenta,
					'Cheque'		=>	$cheque,
					'Formapago'		=>	$formapago,
					'Banco'			=>	$Banco,
					'tipotarjeta'	=>	$tipotarjeta,
	     		);
     		$this->load->view('pagar_deudas',$data);
		}
		else{


			$cred_info = NULL;

			$cred_info = $this->global_model->make_reconection($Contrato,  $Monto);



		 //json_encode($cred_info);

			//$resp = json_decode($cred_info, true);

			// var_dump($cred_info);
			 			
			if(isset($cred_info["resultado"])){
				if($cred_info["Id"]==100){

					$data = array(
				      	'Contrato' 		=> 	$Contrato,
			      		'Nombre' 		=> 	$Nombre,
			  			'Cedula' 		=> 	$Cedula,
						'Estatus' 		=> 	$Estatus,
						'Direccion' 	=> 	$Direccion,
						'Balance' 		=> 	$Balance,
						'pagado'		=>	'Pago realizado exitosamente',
						'Montoapagar'	=>	$Monto,
						'TRN' 			=>	$cred_info["resultado"][0]['TRN'],
						'fecha'			=>	$cred_info["resultado"][0]["Fecha"],
						'usuario'		=>	$cred_info["resultado"][0]["Nombre"],
						'conceptoPago' 	=>	$cred_info["resultado"][0]["ConceptoPago"]
					
		     		);}
				$this->load->view('factura',$data);
			}
			else{

				if($cred_info["Id"]== -1){
					echo "No Existe";
				}
						
						
					//}
			}

		}

		//echo ($cred_info);
		//$cred_info = (object) array_merge( (array)$cred_info, array( 'balance_anterior' => $balance_anterior, 'mount' => $mount, 'contract' => $contract));
	/*}
	else
    {
    	show_404();
    }*/
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

