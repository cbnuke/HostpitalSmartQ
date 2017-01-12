<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Opd extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->themes->setAssetExtent('jQuery-Form|iCheck|select2|DataTables|WYSIHTML5-Bootstrap3|datepicker|knob|flot|timepicker');
        $this->load->model('M_opd', 'opd');
        $this->load->model('M_department', 'department');
    }

    public function index() {
        redirect('home');
    }

    public function id($dep_id) {
        //Check post
        if ($this->input->method(TRUE) === 'POST') {
            $mode = $this->input->post('mode');
            $post_data = $this->input->post();
            if ($mode == 'add') {
                if ($this->opd->fastAssignQueue($post_data['pat_hn'], $dep_id)) {
//                    echo 'PASS';
                } else {
//                    echo 'FAIL';
                }
            } elseif ($mode == 'wait') {
                $qd_id = $this->input->post('qd_id');
                if ($this->opd->assignQueue($qd_id)) {
//                    echo 'PASS';
                } else {
//                    echo 'FAIL';
                }
            } elseif ($mode == 'send') {
                $qd_id = $this->input->post('qd_id');
                $dep_id = $this->input->post('dep_id');
                if ($this->opd->sendQueue($qd_id, $dep_id)) {
//                    echo 'PASS';
                } else {
//                    echo 'FAIL';
                }
            } elseif ($mode == 'appointment') {
                $data_a = array(
                    'pat_hn' => $this->input->post('pat_hn'),
                    'app_date' => $this->datetime->calToDB($this->input->post('app_date')),
                    'dep_id' => $this->input->post('dep_id'),
                    'detail' => $this->input->post('detail'),
                );
                if ($this->opd->insertAppointment($data_a)) {
//                    echo 'PASS';
                } else {
//                    echo 'FAIL';
                }
            }
        }


        $data = array(
            'dep_id' => $dep_id,
            'all' => $this->opd->countPatientInOpd($dep_id),
            'wait' => $this->opd->countPatientInOpd($dep_id, 'wait'),
            'done' => $this->opd->countPatientInOpd($dep_id, 'done'),
            'checkDepartment' => $this->department->checkDepartment(TRUE),
            'checkOpdInfo' => $this->opd->checkOpdInfo($dep_id),
            'checkPatientInOpd' => $this->opd->checkPatientInOpd($dep_id),
        );
        $this->themes->setContent('opd/main', $data);
//        $this->themes->setDebug($data['checkDepartment']);
        $this->themes->showTemplate();
    }

    public function up($dep_id, $qd_id) {
        $this->opd->up($dep_id, $qd_id);
        redirect('opd/id/' . $dep_id);
    }

    public function down($dep_id, $qd_id) {
        $this->opd->down($dep_id, $qd_id);
        redirect('opd/id/' . $dep_id);
    }

}
