<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->themes->checkLoginWithRedirect();
        $this->themes->setAssetExtent('DataTables|datepicker');
        $this->themes->setPermission('ALL');
        $this->themes->checkPermission();

        $this->load->model('M_setting', 'setting');
    }

    public function index() {
        $this->themes->setContent('home/main');
        $this->themes->setDebug($this->session->userdata());
        $this->themes->showTemplate();
    }

    public function service() {
        if ($this->setting->validationFormService() && $this->form_validation->run() == TRUE) {
            $post = $this->setting->getPostFormService();
            $mode = $this->input->post('mode');
            if ($mode == 'add') {
                if ($this->setting->insertService($post)) {
                    $this->themes->setAlert('success', 'เพิ่มสำเร็จ', 'เพิ่มบริการเรียบร้อย');
                } else {
                    $this->themes->setAlert('danger', 'เพิ่มไม่สำเร็จ', 'เพิ่มบริการไม่สำเร็จ กรุณาลองใหม่อีกครั้ง');
                }
            } else if ($mode == 'edit') {
                if ($this->setting->updateService($post)) {
                    $this->themes->setAlert('success', 'แก้ไขสำเร็จ', 'แก้ไขบริการเรียบร้อย');
                } else {
                    $this->themes->setAlert('danger', 'แก้ไขไม่สำเร็จ', 'แก้ไขบริการไม่สำเร็จ กรุณาลองใหม่อีกครั้ง');
                }
            }
        }

        $data = array(
            'form_open' => form_open('setting/service', array('id' => 'addForm', 'class' => 'form-horizontal')),
            'form_close' => form_close(),
            'input' => $this->setting->setFormService(),
            'service' => $this->setting->checkService(),
        );
        $data_debug = array(
//            'service' => $this->setting->checkService(),
//            'service_form' => $this->setting->setFormService(),
        );

        $this->themes->setContent('setting/service', $data);
        $this->themes->setDebug($data_debug);
        $this->themes->showTemplate();
    }

    public function admin() {
        if ($this->setting->validationFormAdmin() && $this->form_validation->run() == TRUE) {
            $post = $this->setting->getPostFormAdmin();
            $mode = $this->input->post('mode');
            if ($mode == 'add') {
                if ($this->setting->insertAdmin($post)) {
                    $this->themes->setAlert('success', 'เพิ่มสำเร็จ', 'เพิ่มผู้ดูแลระบบเรียบร้อย');
                } else {
                    $this->themes->setAlert('danger', 'เพิ่มไม่สำเร็จ', 'เพิ่มผู้ดูแลระบบไม่สำเร็จ กรุณาลองใหม่อีกครั้ง');
                }
            } else if ($mode == 'edit') {
                if ($this->setting->updateAdmin($post)) {
                    $this->themes->setAlert('success', 'แก้ไขสำเร็จ', 'แก้ไขผู้ดูแลระบบเรียบร้อย');
                } else {
                    $this->themes->setAlert('danger', 'แก้ไขไม่สำเร็จ', 'แก้ไขผู้ดูแลระบบไม่สำเร็จ กรุณาลองใหม่อีกครั้ง');
                }
            }
        }

        $data = array(
            'form_open' => form_open('setting/admin', array('id' => 'addForm', 'class' => 'form-horizontal')),
            'form_close' => form_close(),
            'input' => $this->setting->setFormAdmin(),
            'admin' => $this->setting->checkAdmin(),
        );
        $data_debug = array(
//            'admin' => $this->setting->setFormAdmin(),
//            'admin_form' => $this->setting->checkAdmin(),
        );

        $this->themes->setContent('setting/admin', $data);
        $this->themes->setDebug($data_debug);
        $this->themes->showTemplate();
    }

}
