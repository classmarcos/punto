<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
* 
*/
class Clients extends CI_Model
{
    
    function __construct()
    {
        parent::__construct();
    }

    public function get_last_invoice($parameter_){
        
        if ($this->session->userdata('id_usuario') === NULL){
            return ;
        }

        $url = 'http://192.168.10.77:8080/codprueba/index.php/main/ultimafactura/'; //'http://tcentral.ddns.net:8080/Clientela/db_ODC.php'; 'http://192.168.10.147:8080/Clientela/PruebaDBp.php'
        //013495003102438

        $data = array('codigo' => $this->session->userdata('id_usuario'), 'contrato' =>  $parameter_);

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
}


?>