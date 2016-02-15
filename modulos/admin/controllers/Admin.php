<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('global_model');
        $this->load->library('jquery_pagination');
        $this->load->library('form_validation');
        $this->load->library('select');
        $this->load->library('mi_session');
        $this->load->library('excel');
        $this->load->library('pdf');
        $this->load->helper('csv');

        $this->mi_session->activo();
        $this->mi_session->verificar_inactividad();
    }

    function index()
    {

        $data['jsvista'] =  array('public/js/select2.js');
        $data['cssvista'] =  array('public/css/select2.min.css','public/css/select2-bootstrap.css');
        $data['modal'] = 'front-end/modal';
        $data['header'] = 'front-end/header';
        $data['aside'] = 'front-end/aside';
        $data['section'] = 'front-end/section';
        $data['footer'] = 'front-end/footer';
        $this->load->view('front-end/plantilla',$data);
    }


    function principal()
    {
        if($this->input->is_ajax_request())
        {
            $this->load->view('front-end/section');
        }
        else
        {
            show_404();
        }
    }



    function registro_compras()
    {
        if($this->input->is_ajax_request())
        {
            if (!$this->input->post('enviado'))
            {
                $this->load->view('registro_compra');
            }
            else
            {
                if ($this->input->post('id_pago') == 'Factura')
                {
                    $this->form_validation->set_rules('id_grupos', 'grupos', 'trim|required');
                    $this->form_validation->set_rules('id_pago', 'Tipo de pago', 'trim|required');
                    $this->form_validation->set_rules('concepto', 'Concepto', 'trim|required');
                    $this->form_validation->set_rules('preciounitario', 'Precio Unitario', 'trim|numeric|required');
                    $this->form_validation->set_rules('numero_factura', 'Numero de Factura', 'trim|required|numeric');
                    $this->form_validation->set_rules('numero_control', 'Numero de control', 'trim|required');
                    $this->form_validation->set_rules('fecha_factura', 'Fecha de Factura', 'trim|required');
                    $this->form_validation->set_rules('cantidad', 'Cantidad de Producto', 'trim|required');
                    $this->form_validation->set_rules('subtotal', 'Sub Total', 'trim|numeric|required');
                    $this->form_validation->set_rules('iva', 'Impuesto del Valor', 'trim|numeric|required');
                    $this->form_validation->set_rules('ivatotal', 'Total Iva a pagar', 'trim|numeric|required');
                    $this->form_validation->set_rules('montocompra', 'Total a pagar', 'trim|numeric|required|callback_verificar_caja');

                    $this->form_validation->set_message('required', 'El Campo %s es obligatorio');
                    $this->form_validation->set_message('numeric', 'El Campo %s acepta solo numeros');

                    if ($this->form_validation->run($this) == FALSE)
                    {
                        echo json_encode(array('success'=>false, 'mensaje' => validation_errors('<div class="alert alert-danger alert-dismissible" role="alert">', '</div>')));
                    }
                    else
                    {
                        extract($_POST);

                        $cbd["tabla"] = "caja_chica";
                        $datos = array(
                            'concepto' => $concepto,
                            'tipo_pago' => $id_pago,
                            'id_grupo' => $id_grupos,
                            'numero_factura' => $numero_factura,
                            'numero_control'=> $numero_control,
                            'fecha_factura'=> $fecha_factura,
                            'precio_unitario'=> $preciounitario,
                            'cantidad_producto'=> $cantidad,
                            'sub_total'=> $subtotal,
                            'porcentaje_iva'=> $iva,
                            'total_iva'=> $ivatotal,
                            'monto'=> $montocompra,
                            'fecha_registro'=>FECHAGESTOR,
                            'id_usuario'=> '1',
                            'estado'=> '2',
                            'revisado'=> '1',
                        );

                        $this->global_model->agregar($cbd, $datos);

                        $id = $this->db->insert_id();

                        echo json_encode(array('id'=>$id,'mensaje' => 'Compra Com Factura Registrada Correctamente'));

                        $cbd["tabla"] = "parametros";
                        $cbd["where"] = array(
                            0 => array("campo" => "id", "valor" => 1, "tipo" => "where")
                        );

                        $restadinerocaja = CAJACHICA - $montocompra;

                        $datos = array(
                            'caja' => $restadinerocaja,
                        );
                        $this->global_model->actualizar($cbd, $datos);
                    }
                }
                else
                {
                    if ($this->input->post('id_pago') == 'Sin factura')
                    {
                        $this->form_validation->set_rules('id_grupos', 'grupos', 'trim|required');
                        $this->form_validation->set_rules('id_pago', 'Tipo de pago', 'trim|required');
                        $this->form_validation->set_rules('concepto', 'Concepto', 'trim|required');
                        $this->form_validation->set_rules('preciounitario', 'Precio Unitario', 'trim|numeric|required');
                        $this->form_validation->set_rules('cantidad', 'Cantidad de Producto', 'trim|required');
                        $this->form_validation->set_rules('subtotal', 'Sub Total', 'trim|numeric|required');
                        $this->form_validation->set_rules('iva', 'Impuesto del Valor', 'trim|numeric|required');
                        $this->form_validation->set_rules('ivatotal', 'Total Iva a pagar', 'trim|numeric|required');
                        $this->form_validation->set_rules('montocompra', 'Total a pagar', 'trim|numeric|required|callback_verificar_caja|callback_verificar_monto_consumible');

                        $this->form_validation->set_message('numeric', 'El Campo %s acepta solo numeros decimales');
                        $this->form_validation->set_message('required', 'El Campo %s es obligatorio');

                        if ($this->form_validation->run($this) == FALSE)
                        {
                            echo json_encode(array('success'=>false, 'mensaje' => validation_errors('<div class="alert alert-danger alert-dismissible" role="alert">', '</div>')));
                        }
                        else
                        {
                            extract($_POST);

                            $cbd["tabla"] = "caja_chica";
                            $datos = array(
                                'concepto' => $concepto,
                                'id_grupo' => $id_grupos,
                                'tipo_pago' => $id_pago,
                                'precio_unitario'=> $preciounitario,
                                'cantidad_producto'=> $cantidad,
                                'sub_total'=> $subtotal,
                                'porcentaje_iva'=> $iva,
                                'total_iva'=> $ivatotal,
                                'monto'=> $montocompra,
                                'fecha_registro'=>FECHAGESTOR,
                                'id_usuario'=> '1',
                                'revisado'=> '1',
                                'estado'=> '2');

                            $this->global_model->agregar($cbd, $datos);

                            $id = $this->db->insert_id();

                            echo json_encode(array('id'=>$id,'mensaje' => 'Compra Sin Factura Registrada Correctamente'));

                            $cbd["tabla"] = "parametros";
                            $cbd["where"] = array(
                                0 => array("campo" => "id", "valor" => 1, "tipo" => "where")
                            );

                            $restadinerocaja = CAJACHICA - $montocompra;

                            $datos = array(
                                'caja' => $restadinerocaja,
                            );
                            $this->global_model->actualizar($cbd, $datos);
                        }
                    }
                    else
                    {
                        $this->form_validation->set_rules('id_grupos', 'grupos', 'trim|required');
                        $this->form_validation->set_rules('id_pago', 'Tipo de pago', 'trim|required');
                        $this->form_validation->set_rules('concepto', 'Concepto', 'trim|required');
                        $this->form_validation->set_rules('preciounitario', 'Precio Unitario', 'trim|numeric|required|callback_verificar_caja');
                        $this->form_validation->set_rules('cantidad', 'Cantidad de Producto', 'trim|required');
                        $this->form_validation->set_rules('subtotal', 'Sub Total', 'trim|numeric|required');
                        $this->form_validation->set_rules('iva', 'Impuesto del Valor', 'trim|numeric|required');
                        $this->form_validation->set_rules('ivatotal', 'Total Iva a pagar', 'trim|numeric|required');
                        $this->form_validation->set_rules('montocompra', 'Total a pagar', 'trim|numeric|required');

                        $this->form_validation->set_message('numeric', 'El Campo %s acepta solo numeros decimales');
                        $this->form_validation->set_message('required', 'El Campo %s es obligatorio');

                        if ($this->form_validation->run($this) == FALSE)
                        {
                            echo json_encode(array('success'=>false, 'mensaje' => validation_errors('<div class="alert alert-danger alert-dismissible" role="alert">', '</div>')));
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

}