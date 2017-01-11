<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Opd extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_customer', 'customer');
        $this->load->model('M_setting', 'setting');
        $this->load->model('M_appointment', 'appointment');
    }

    public function index() {
        $data = array(
//            'reserve' => $this->appointment->countAppointmentByStatus('reserve'),
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
        $this->themes->setContent('home/main', $data);
        $this->themes->setDebug($data_debug);
        $this->themes->showTemplate();
    }

    public function id($dep_id) {
        $data = array(
        );
        $this->themes->setContent('opd/main', $data);
        $this->themes->setDebug($data);
        $this->themes->showTemplate();
    }

}
