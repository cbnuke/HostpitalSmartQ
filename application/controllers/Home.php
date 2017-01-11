<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        $this->themes->checkLoginWithRedirect();
//        $this->themes->setAssetExtent('jQuery-Form|iCheck|select2|DataTables|WYSIHTML5-Bootstrap3|datepicker|knob|flot|timepicker');
//        $this->themes->setPermission('ALL');
//        $this->themes->checkPermission();

        $this->load->model('M_customer', 'customer');
        $this->load->model('M_setting', 'setting');
        $this->load->model('M_appointment', 'appointment');
    }

    public function test() {
        $data = array(
            'a0' => 'Test0',
            'a1' => 'Test1',
            'a2' => 'Test2',
            'a4' => 'Test3',
            'emp' => $this->db->get('employee')->result_array(),
            'a5' => 'Test5'
        );

        $this->themes->setContent('home/test', $data);
        $this->themes->setDebug($data);
        $this->themes->showTemplate();
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

    public function complete() {
        if ($this->appointment->validationCompleteAppointment()) {
            $POST = $this->appointment->getPostFormCompleteAppointment();
            $this->appointment->updateAppointment($POST);
        }
        redirect('home');
    }

    public function cancel() {
        if ($this->appointment->validationCancelAppointment()) {
            $POST = $this->appointment->getPostCancelAppointment();
            $this->appointment->cancelAppointment($POST['quotation_id']);
        }
        redirect('home');
    }

}
