<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class M_department extends CI_Model {

    function checkDepartment($flag_count = FALSE) {
        $this->db->select('*');
        $this->db->from('department');
        $query = $this->db->get();
        $ans = $query->result_array();
        if ($flag_count) {
            foreach ($ans as &$row) {
                $row['all'] = $this->countPatientInOpd($row['dep_id']);
                $row['wait'] = $this->countPatientInOpd($row['dep_id'], 'wait');
                $row['done'] = $this->countPatientInOpd($row['dep_id'], 'done');
            }
        }
        return $ans;
    }

    function countPatientInOpd($dep_id, $qd_status = NULL) {
        $this->db->from('queue_dep');
        $this->db->join('queue_hos', 'queue_hos.id_uni=queue_dep.id_uni');
        $this->db->join('patient', 'patient.pat_hn=queue_hos.hn');
        $this->db->where('dep_id', $dep_id);
        $this->db->where('qd_date', $this->datetime->DBToDay());
        if ($qd_status == NULL) {
            $this->db->where('qd_status !=', 'register');
        } else {
            $this->db->where('qd_status', $qd_status);
        }
        return $this->db->get()->num_rows();
    }

    function insertCustomer($data) {
        $this->datetime->createDate($data);
        if ($this->db->insert('Customers', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
