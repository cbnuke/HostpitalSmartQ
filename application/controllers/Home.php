<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        $this->themes->checkLoginWithRedirect();
//        $this->themes->setAssetExtent('jQuery-Form|iCheck|select2|DataTables|WYSIHTML5-Bootstrap3|datepicker|knob|flot|timepicker');
//        $this->themes->setPermission('ALL');
//        $this->themes->checkPermission();

        $this->load->model('M_department', 'department');
        $this->load->model('M_setting', 'setting');
        $this->load->model('M_appointment', 'appointment');
    }

    public function index() {
        $data = array(
            'checkDepartment' => $this->department->checkDepartment(),
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
        $this->themes->setDebug($data);
        $this->themes->showTemplate();
    }

}
