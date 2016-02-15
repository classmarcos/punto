<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: suarez
 * Date: 15/02/2016
 * Time: 10:39
 */
class Login extends MX_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('global_model');
		$this->load->library('form_validation');
		$this->load->library('jquery_pagination');
		$this->load->library('mi_session');
		$this->load->helper('cookie');

		if($this->input->is_ajax_request()){
			if($this->input->post('recargar')==1){
				return true;
			}
			else{
				$this->mi_session->verificar_inactividad();
			}
		}
		else{
			$this->mi_session->verificar_inactividad();
		}

	}

	function index(){
		$data['titulo'] = 'Iniciar Sección';
		$data['contenido'] = 'login';
		$this->load->view('plantilla_admin',$data);
	}

	function entrar(){
		if($this->input->is_ajax_request()){

			$this->form_validation->set_rules('usuario','Usuario','trim|required');
			$this->form_validation->set_rules('clave','Clave','trim|required|md5');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
			$this->form_validation->set_message('required','<i class="fa fa-exclamation-triangle"></i>El campo %s es Obligatorio');
			$this->form_validation->set_message('min_length', '<i class="fa fa-exclamation-triangle"></i> El campo %s debe Contener 4 Caracteres.');
			$this->form_validation->set_message('max_length', '<i class="fa fa-exclamation-triangle"></i> El campo %s debe Contener 4 Caracteres.');
			
			if($this->form_validation->run()== false){
				echo json_encode(array('success' => , false,'mensajes'=>validation_errors()));
			}
			else{
				$respuesta = $this->mi_session->entrar($this->unput->post('usuario'),$this->input->post('clave'));

				if(!isset($respuesta['error'])){
					echo json_encode(array('success' =>true , 'mensages'=>'admin'));
				}
				else{
					echo json_encode(array('success' => false,'mensajes'=>$respuesta['error'] ));
				}
			}
		}
		else{
			show_404();
		}
	}

	function verificar_session(){
		if($this->input->is_ajax_request()){

			if($this->mi_session->verificar_session()==true){
				$fechaGuardada= $this->session->userdata('fechainicio');
				$ahora = FECHAGESTOR;
				$tiempo_transcurrido = (strtotime($ahora) - strtotime($fechaGuardada));

				echo json_encode(array('tiempoinactivo' => $tiempo_transcurrido ));
			}
			else{
				echo json_encode(array('session' => false ));
			}
		}
		else{
			show_404();
		}
	}

	function estado_sistema(){
		$estado = 1;

		if($estado ==1){
			echo json_encode(array('getEstadoSistema' => 1));
		}
		else{
			echo json_encode(array('getEstadoSistema' => 0 ));
		}
	}

	function bloquear_sistema(){
		if($this->input->is_ajax_request()){
			$this->salir();
		}
		else{
			show_404();
		}
	}

	function mensajes_sistema(){
		if($this->input->is_ajax_request()){
			if($this->input->post('updatemensaje')){
				echo $this->input->post('updatemensaje');
			}
			else{
				$data = array('useremisor' =>'villate' ,'mensaje'=>'hola como estas', );
				$datos[] = $data;
				echo json_encode(array('getMsjAlertas' => $datos ));
			}
		}
		else{
			show_404();
		}
	}

	function salir(){
		if($this->input->is_ajax_request()){
			$this->mi_session->salir();
		}
		else{
			show_404();
		}
	}

	function veryiniciosession(){
		if($this->input->is_ajax_request()){
			if($this->mi_session->verificar_session()==true){
				echo '1';
			}
			else{
				echo '0';
			}
		}
		else{
			show_404();
		}
	}

}
