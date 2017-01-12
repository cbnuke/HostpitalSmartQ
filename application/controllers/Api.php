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

    public function login() {
        if ($this->input->method(TRUE) === 'POST') {
            $hn = $this->input->post('HN');
            $pw = $this->input->post('PW');
            $token = $this->input->post('Token');

            //Check patient
            $flag = FALSE;
            $query = $this->db->get_where('patient', array('pat_hn' => $hn, 'pat_pass' => $pw));
            if ($query->num_rows() == 1) {
                $flag = TRUE;
                $data_update = array(
                    'pat_token' => $token,
                );
                $this->db->where('pat_hn', $hn);
                $this->db->where('pat_pass', $pw);
                $this->db->update('patient', $data_update);
            }

            $data = array(
                'data' => 'login',
                'status' => ($flag) ? 'success' : 'fail'
            );
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            show_404();
        }
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
