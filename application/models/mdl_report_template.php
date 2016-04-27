<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class mdl_report_template extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_template_by_id($template_name)
    {
        $query = $this->db->select('*')
                          ->from('templates')
                          ->where('template_name',$template_name)
                          ->get();

        if($query->num_rows())
            return $query->row()->template_content;
        else
            return '';
    }
}
