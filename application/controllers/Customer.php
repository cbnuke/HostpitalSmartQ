<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->themes->checkLoginWithRedirect();
        $this->themes->setAssetExtent('DataTables|WYSIHTML5-Bootstrap3|datepicker|jQuery-Form|timepicker');
        $this->themes->setPermission('ALL');
        $this->themes->checkPermission();

        $this->load->model('M_customer', 'customer');
        $this->load->model('M_appointment', 'appointment');
    }

    public function index() {
        if ($this->customer->validationFormCustomer() && $this->form_validation->run() == TRUE) {
            $post = $this->customer->getPostFormCustomer();
            $mode = $this->input->post('mode');
            if ($mode == 'add') {
                if ($this->customer->insertCustomer($post)) {
                    $this->themes->setAlert('success', 'เพิ่มสำเร็จ', 'เพิ่มลูกค้าเรียบร้อย');
                } else {
                    $this->themes->setAlert('danger', 'เพิ่มไม่สำเร็จ', 'เพิ่มลูกค้าไม่สำเร็จ กรุณาลองใหม่อีกครั้ง');
                }
            } else if ($mode == 'edit') {
                if ($this->customer->updateCustomer($post)) {
                    $this->themes->setAlert('success', 'แก้ไขสำเร็จ', 'แก้ไขลูกค้าเรียบร้อย');
                } else {
                    $this->themes->setAlert('danger', 'แก้ไขไม่สำเร็จ', 'แก้ไขลูกค้าไม่สำเร็จ กรุณาลองใหม่อีกครั้ง');
                }
            }
        }

        $data = array(
            'form_open' => form_open('customer', array('id' => 'addForm', 'class' => 'form-horizontal')),
            'form_close' => form_close(),
            'input' => $this->customer->setFormCustomer(),
            'customer' => $this->customer->checkCustomer(),
        );
        $data_debug = array(
//            'service' => $this->setting->checkCustomer(),
//            'service_form' => $this->setting->setFormCustomer(),
        );

        $this->themes->setContent('customer/main', $data);
        $this->themes->setDebug($data_debug);
        $this->themes->showTemplate();
    }

    public function detail($Cus_id = NULL) {
        if ($Cus_id == NULL) {
            redirect('customer');
        }

        if ($this->customer->validationFormUseGuarantee()) {
            $POST = $this->customer->getPostFormUseGuarantee();
            $this->appointment->updateAppointment($POST);
        }

        $data = array(
            'info' => $this->customer->checkCustomer($Cus_id),
            'list_complete' => $this->customer->checkCustomerAppointment($Cus_id, 'complete'),
            'list_reserve' => $this->customer->checkCustomerAppointment($Cus_id, array('reserve', 'cancel', 'waiting')),
            'input' => $this->customer->setFormUseGuarantee(),
            'form_open' => form_open('customer/detail/' . $Cus_id, array('class' => 'form-horizontal')),
            'form_close' => form_close(),
        );

        $data_debug = array(
//            'info' => $data['info'],
//            'list' => $data['list_complete'],
//            'list_reserve' => $data['list_reserve'],
//            'POST' => isset($POST) ? $POST : '',
        );

        $this->themes->setContent('customer/detail', $data);
        $this->themes->setDebug($data_debug);
        $this->themes->showTemplate();
    }

}
