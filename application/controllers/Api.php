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
            $appoint = $this->db->get_where('appointment', array('pat_hn' => $hn))->result_array();
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

    public function appoint() {
        if ($this->input->method(TRUE) === 'POST') {
            $hn = $this->input->post('hn');
            $appoint = $this->db->get_where('appointment', array('pat_hn' => $hn))->result_array();
            header('Content-Type: application/json');
            $data = array(
                'data' => $appoint,
                'status' => 'success'
            );
            echo json_encode($data);
        } else {
            show_404();
        }
    }

    public function queue() {
        if ($this->input->method(TRUE) === 'POST') {
            $hn = $this->input->post('hn');
            $queue_hos_id = $this->db->get_where('queue_hos', array('hn' => $hn))->first_row('array');
            $uid = $queue_hos_id['id_uni'];
            $this->db->order_by('qd_id', 'DESC');
            $queue_result = $this->db->get_where('queue_dep', array('id_uni' => $uid))->result_array();
            header('Content-Type: application/json');
            $data = array(
                'data' => $queue_result,
                'status' => 'success'
            );
            echo json_encode($data);
        } else {
            show_404();
        }
    }

    public function map($position, $target) {
//        
        $man_dep = $this->db->get_where('department', array('dep_id' => $position))->first_row('array');
        $flag_dep = $this->db->get_where('department', array('dep_id' => $target))->first_row('array');
        $data = array(
            'man_dep_lat' => $man_dep['dep_lat'],
            'man_dep_long' => $man_dep['dep_long'],
            'flag_dep_lat' => $flag_dep['dep_lat'],
            'flag_dep_long' => $flag_dep['dep_long']
        );
        $this->load->view('map.php', $data);
    }

}
