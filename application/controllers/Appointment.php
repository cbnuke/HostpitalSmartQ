<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->themes->checkLoginWithRedirect();
        $this->themes->setAssetExtent('DataTables|WYSIHTML5-Bootstrap3|fullcalendar|timepicker|select2');
        $this->themes->setPermission('ALL');
        $this->themes->checkPermission();

        $this->load->model('M_customer', 'customer');
        $this->load->model('M_setting', 'setting');
        $this->load->model('M_appointment', 'appointment');
    }

    public function index() {
        $data_debug = array(
//            'service' => $this->setting->checkCustomer(),
//            'customer' => $this->customer->checkCustomer(),
//            'appointment' => $this->appointment->checkAppointment(),
        );
        if ($this->appointment->validationFormAppointment() && $this->form_validation->run() == TRUE) {
            $post = $this->appointment->getPostFormAppointment();
//            $data_debug['POST'] = $post;
            $mode = $this->input->post('mode');
            if ($mode == 'add') {
                if ($this->appointment->insertAppointment($post)) {
                    $this->themes->setAlert('success', 'เพิ่มสำเร็จ', 'เพิ่มตารางนัดเรียบร้อย');
                } else {
                    $this->themes->setAlert('danger', 'เพิ่มไม่สำเร็จ', 'เพิ่มตารางนัดไม่สำเร็จ กรุณาลองใหม่อีกครั้ง');
                }
            } else if ($mode == 'edit') {
                if ($this->appointment->updateAppointment($post)) {
                    $this->themes->setAlert('success', 'แก้ไขสำเร็จ', 'แก้ไขตารางนัดเรียบร้อย');
                } else {
                    $this->themes->setAlert('danger', 'แก้ไขไม่สำเร็จ', 'แก้ไขตารางนัดไม่สำเร็จ กรุณาลองใหม่อีกครั้ง');
                }
            } else if ($mode == 'add-new') {
                $post_cus = $this->customer->getPostFormCustomer();
                $Cus_id = $this->input->post('Cus_id');
                if ($this->customer->insertCustomer($post_cus)) {
                    if ($this->appointment->insertAppointment($post)) {
                        $this->themes->setAlert('success', 'เพิ่มสำเร็จ', 'เพิ่มตารางนัดเรียบร้อย');
                    } else {
                        $this->themes->setAlert('danger', 'เพิ่มไม่สำเร็จ', 'ผิดพลาดขณะ เพิ่มนัด กรุณาลองใหม่ด้วยเมนูลูกค้าเก่า');
                    }
                } else {
                    $this->themes->setAlert('danger', 'เพิ่มไม่สำเร็จ', 'ผิดพลาดขณะ เพิ่มลูกค้า');
                }
            }
        }

        $data = array(
            'form_open_new' => form_open('appointment', array('id' => 'addFormNew', 'class' => 'form-horizontal')),
            'form_open_old' => form_open('appointment', array('id' => 'addFormOld', 'class' => 'form-horizontal')),
            'form_open' => form_open('appointment', array('id' => 'addForm', 'class' => 'form-horizontal')),
            'form_close' => form_close(),
            'input' => $this->appointment->setFormAppointment(),
            'input_customer' => $this->customer->setFormCustomer(),
            'genCusID' => $this->customer->genCustomerID(),
            'appointment' => $this->appointment->checkAppointment(),
        );


        $this->themes->setContent('appointment/main', $data);
        $this->themes->setDebug($data_debug);
        $this->themes->showTemplate();
    }

}
