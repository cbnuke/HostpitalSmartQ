<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('M_api', 'api');
    }

    public function index() {
        show_404();
    }

    public function patient() {
        if ($this->input->method(TRUE) === 'POST') {
            $hn = $this->input->post('hn');
            $ans = $this->db->get_where('patient', array('pat_hn' => $hn))->first_row('array');
            header('Content-Type: application/json');

            $data = array(
                'data' => $ans,
                'status' => 'success'
            );
            echo json_encode($data);
        } else {
            show_404();
        }
    }

}
