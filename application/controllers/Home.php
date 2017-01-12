<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('M_department', 'department');
        $this->load->model('M_home', 'home');
    }

    public function index() {
        //Check post
        if ($this->input->method(TRUE) === 'POST') {
            $mode = $this->input->post('mode');
            $post_data = $this->input->post();
            if ($mode == 'add') {
                if ($this->home->insertQueue($post_data)) {
                    $flag = TRUE;
                } else {
                    $flag = FALSE;
                }
            }
        }

        $data = array(
            'checkDepartment' => $this->department->checkDepartment(TRUE),
            'flag' => (isset($flag)) ? $flag : NULL,
            'form_cancel' => form_open('home/cancel', array('class' => 'form-horizontal')),
            'form_complete' => form_open('home/complete', array('class' => 'form-horizontal')),
            'form_close' => form_close(),
        );
        $data_debug = array(
//            'session' => $this->session->userdata(),
//            'data' => $data,
//            'appointment' => $this->appointment->checkAppointment(array('reserve', 'waiting')),
//            'service'=>$this->appointment->countAppointmentByService(),
        );
        $this->themes->setContent('home/main', $data);
//        $this->themes->setDebug($data['checkDepartment']);
        $this->themes->showTemplate();
    }

    // Update from modal in themes_nav
    public function updateEmployee() {
        if ($this->input->method(TRUE) === 'POST') {
            $current_page = $this->input->post('current_page');
            $data_emp = array(
                'emp_id' => $this->input->post('emp_id'),
                'emp_pass' => $this->input->post('emp_pass'),
                'emp_firstname' => $this->input->post('emp_firstname'),
                'emp_lastname' => $this->input->post('emp_lastname'),
                'emp_position' => $this->input->post('emp_position'),
                'dep_id' => $this->input->post('dep_id'),
            );

            if ($data_emp['emp_pass'] == NULL) {
                unset($data_emp['emp_pass']);
            } else {
                $data_emp['emp_pass'] = md5($data_emp['emp_pass']);
            }

            $this->db->where('emp_id', $data_emp['emp_id']);
            $this->db->update('employee', $data_emp);

            redirect($current_page);
        }
    }

}
