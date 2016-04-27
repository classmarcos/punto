<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class invoice extends CI_Controller {

 	public function __construct(){
        parent::__construct();
      //  $this->load->library('chequeousuario');
        $this->load->model('clientes');
    }

    public function print_invoice($parameter, $print ='0', $default = "0"){

        preg_match("/^[a-zA-Z][0-9]{7}[a-zA-Z]$/", $parameter, $output_array);

        if (empty($output_array[0])){
            echo $parameter . " Es un dato invalido";
            return ;
        }

       // $this->chequeousuario->estara_en_sesion(true);
        if ($this->session->userdata('id_usuario') === NULL){
            return ;
        }
        
        $this->load->model('mdl_report_template');
        $this->load->library('html_to_pdf/pdf_generator');
        if ($print === '1'){
            $print_template = 'template_cutter'; // 'template_a4'  'template_cutter'
        } else {
            $print_template = 'template_a4';
        }
        $template = $this->mdl_report_template->get_template_by_id($print_template); 
        $datos = $this->mdl_client->get_last_invoice($parameter);

        if ($default === "2") {
            var_dump($datos);
            return;
            
        } elseif ($default === "0") {

            if (empty($datos['resultado'][0]['TRN'])){
                echo "'$parameter' No retorno ningun resultado <br />";
                echo $datos['message'];
                return ;
            }
  
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
            
            $valor_pendiente = number_format($datos['resultado'][0]['balanceAnterior'] - $datos['resultado'][0]['Pagado'], 2, '.', ',');

            $variables = array(
                'date' => date("d-m-Y", strtotime($datos['resultado'][0]['Fecha'])),
                'table_body' => $table_body,
                //'tabla' => '',
                'cliente' => $datos['resultado'][0]['NomCli'],
                'id_invoice' => $datos['resultado'][0]['TRN'],
                'contract' => $parameter,
                'total' => $datos['resultado'][0]['Pagado'],
                'cobrador' => $datos['resultado'][0]['Nombre'], //Este es el cobrador
                'BAnterior' => $datos['resultado'][0]['balanceAnterior'],
                'VPendiente' => $valor_pendiente,
                'direccion_empresa' => $this->session->userdata('impresion_Direccion'),
                'ciudad_empresa' => $this->session->userdata('impresion_Ciudad'),
                'telefono_empresa' => $this->session->userdata('impresion_Telefono'),
                'fax_empresa' => $this->session->userdata('impresion_Fax'),
                'rnc_empresa' => '104-01619-1'
            );

            //var_dump($variables);

            foreach ($variables as $key => $value) {
                $template = str_replace("@$key@", $value, $template);
            }

            $html2pdf = new HTML2PDF('P','A4','fr');
            $html2pdf->WriteHTML($template);
            $html2pdf->Output( $parameter . ' ' . $datos['resultado'][0]['Fecha'] . ' ' . $datos['resultado'][0]['TRN'] . '.pdf');
        } elseif ($default === "1") {

            if (empty($datos['resultado'][0]['TRN'])){
                echo "'$parameter' No retorno ningun resultado <br />";
                echo $datos['message'];
                return ;
            }

            $table_body = '';
            
            $val = explode(';', "SALDO MES AGOSTO;550.00;SALDO MES JUNIO;550.00;PAGO ADELANTADO;900.00"); //$datos['resultado'][0]['ConceptoPago']
            if ($print_template === 'template_cutter'){
                    for ($i=0; $i < count($val) - 1; $i++) { 
                        $table_body.=   '<tr>
                                             <td style="width: 70%; text-align: left; font-size: 270%;">'.$val[$i].'</td>
                                            <td style="width: 30%; text-align: left; font-size: 270%;"><div style="width: 40%; margin:0; padding:0; text-align: right;">'.$val[$i +1].'</div></td>
                                        </tr>'; 
                                        //<td style="width: 30%; text-align: right">$val[$i +1]</td>
                        $i++;
                    }
            } else {
                    for ($i=0; $i < count($val) - 1; $i++) { 
                        $table_body.=   '<tr>
                                             <td style="width: 70%; text-align: left;">'.$val[$i].'</td>
                                            <td style="width: 30%; text-align: left;"><div style="width: 40%; margin:0; padding:0; text-align: right;">'.$val[$i +1].'</div></td>
                                        </tr>'; 
                                        //<td style="width: 30%; text-align: right">$val[$i +1]</td>
                        $i++;
                    }
            }
        
            
            $variables = array(
                'date' => '14/02/2009',
                'table_body' => $table_body,
                //'tabla' => '',
                'cliente' => "UN nombre",
                'id_invoice' => "34534",
                'contract' => $parameter,
                'total' => "900.00",
                'cobrador' => "Nombre Cobrador", //Este es el cobrador
                'BAnterior' => '3,435.00',
                'VPendiente' => "7,345.00",
                'direccion_empresa' => 'Falta Direccion',
                'ciudad_empresa' => 'Falta Ciudad',
                'telefono_empresa' => 'Falta Telefono',
                'fax_empresa' => 'Falta Fax',
                'rnc_empresa' => '104-01619-1'
            );

            //var_dump($variables);

            foreach ($variables as $key => $value) {
                $template = str_replace("@$key@", $value, $template);
            }

            $html2pdf = new HTML2PDF('P','A4','fr');
            $html2pdf->WriteHTML($template);
            $html2pdf->Output( 'ejemplo.pdf');

        }
    }

}
?>