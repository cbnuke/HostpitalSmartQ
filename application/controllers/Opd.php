<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Opd extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->themes->setAssetExtent('jQuery-Form|iCheck|select2|DataTables|WYSIHTML5-Bootstrap3|datepicker|knob|flot|timepicker');
        $this->load->model('M_opd', 'opd');
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
            } elseif ($mode == 'edit') {
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
            }
        }


        $data = array(
            'all' => $this->opd->countPatientInOpd($dep_id),
            'wait' => $this->opd->countPatientInOpd($dep_id, 'wait'),
            'done' => $this->opd->countPatientInOpd($dep_id, 'done'),
            'checkOpdInfo' => $this->opd->checkOpdInfo($dep_id),
            'checkPatientInOpd' => $this->opd->checkPatientInOpd($dep_id),
        );
        $this->themes->setContent('opd/main', $data);
//        $this->themes->setDebug($data);
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
