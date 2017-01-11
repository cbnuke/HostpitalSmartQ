<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->themes->setAssetExtent('jQuery-Form|iCheck|select2|DataTables|WYSIHTML5-Bootstrap3|datepicker|knob|flot|timepicker');
        $this->load->model('M_patient', 'patient');
        $this->load->model('M_setting', 'setting');
        $this->load->model('M_appointment', 'appointment');
    }

    public function index() {
        //Check post
        if ($this->input->method(TRUE) === 'POST') {
            $mode = $this->input->post('mode');
            $post_data = $this->input->post();
            if ($mode == 'add') {
                if ($this->patient->insertPatient($post_data)) {
                    echo 'PASS';
                } else {
                    echo 'FAIL';
                }
            } elseif ($mode == 'edit') {
                if ($this->patient->updatePatient($post_data)) {
                    echo 'PASS';
                } else {
                    echo 'FAIL';
                }
            }
        }

        $data = array(
            'checkPatient' => $this->patient->checkPatient(),
//            'waiting' => $this->appointment->countAppointmentByStatus('waiting'),
//            'cancel' => $this->appointment->countAppointmentByStatus('cancel'),
//            'complete' => $this->appointment->countAppointmentByStatus('complete'),
//            'service' => $this->appointment->countAppointmentByService(),
//            'input_complete' => $this->appointment->setFormCompleteAppointment(),
//            'appointment' => $this->appointment->checkAppointment(array('reserve', 'waiting')),
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
        $this->themes->setContent('register/main', $data);
//        $this->themes->setDebug($data);
        $this->themes->showTemplate();
    }

}
