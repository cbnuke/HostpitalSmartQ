<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class M_home extends CI_Model {

    function checkOpdInfo($dep_id) {
        return $this->db->get_where('department', array('dep_id' => $dep_id))->first_row('array');
    }

    function checkPatientInOpd($dep_id) {
        $this->db->where('dep_id', $dep_id);
        $this->db->where('qd_order_number IS NOT NULL', NULL, FALSE);
        return $this->db->get('queue_dep')->result_array();
    }

    function insertQueue($data) {
        //Insert to queue_hos
        $data_hos = array(
            'hn' => $data['hn'],
            'qh_sms' => $data['qh_sms'],
            'qh_date' => $this->datetime->nowToDBFormat(),
        );
        $this->db->insert('queue_hos', $data_hos);
        $id_uni = $this->db->insert_id();

        //Insert to queue_dep
        $data_dep = array(
            'id_uni' => $id_uni,
            'dep_id' => $data['qd_id'],
            'qd_date' => $this->datetime->nowToDBFormat(),
            'qd_status' => 'register'
        );
        $this->db->insert('queue_dep', $data_dep);
        return TRUE;
    }

    function insertPatient($data) {
        unset($data['mode']);
        return $this->db->insert('patient', $data);
    }

    function updatePatient($data) {
        unset($data['mode']);
        $this->db->where('pat_hn', $data['pat_hn']);
        return $this->db->update('patient', $data);
    }

}
