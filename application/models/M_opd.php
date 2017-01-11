<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class M_opd extends CI_Model {

    function checkOpdInfo($dep_id) {
        return $this->db->get_where('department', array('dep_id' => $dep_id))->first_row('array');
    }

    function checkPatientInOpd($dep_id) {
        $this->db->from('queue_dep');
        $this->db->join('queue_hos', 'queue_hos.id_uni=queue_dep.id_uni');
        $this->db->join('patient', 'patient.pat_hn=queue_hos.hn');
        $this->db->where('dep_id', $dep_id);
        $this->db->where('qd_date', $this->datetime->DBToDay());
        $this->db->where('qd_status !=', 'done');
        return $this->db->get()->result_array();
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

    function fastAssignQueue($hn, $dep_id) {
        //Check queue_hos by hn
        $this->db->from('queue_hos');
        $this->db->where('hn', $hn);
        $this->db->where('qh_date', $this->datetime->DBToDay());
        $hos_info = $this->db->get()->first_row('array');
        $id_uni = $hos_info['id_uni'];

        //Check all queue_dep by dep_id in day
        $this->db->where('dep_id', $dep_id);
        $this->db->order_by('qd_order_number', 'DESC');
        $first_dep = $this->db->get('queue_dep')->first_row('array');
        $next_number = $first_dep['qd_order_number'] + 1;

        //Insert to queue_dep
        $data_dep = array(
            'id_uni' => $id_uni,
            'dep_id' => $dep_id,
            'qd_order_number' => $next_number,
            'qd_date' => $this->datetime->DBToDay(),
            'qd_status' => 'wait'
        );
        $this->db->insert('queue_dep', $data_dep);
        return TRUE;
    }

    function assignQueue($qd_id) {
        //Check queue_dep
        $queue_dep_info = $this->db->get_where('queue_dep', array('qd_id' => $qd_id))->first_row('array');

        //Check all queue_dep by dep_id in day
        $this->db->where('dep_id', $queue_dep_info['dep_id']);
        $this->db->where('qd_id !=', $qd_id);
        $this->db->where('qd_date', $this->datetime->DBToDay());
        $this->db->order_by('qd_order_number', 'DESC');
        $first_dep = $this->db->get('queue_dep')->first_row('array');
        $next_number = $first_dep['qd_order_number'] + 1;

        //Update number in queue_dep
        $this->db->where('qd_id', $qd_id);
        $this->db->update('queue_dep', array('qd_order_number' => $next_number, 'qd_status' => 'wait'));
        return TRUE;
    }

    function up($dep_id, $qd_id) {
        $this->db->from('queue_dep');
        $this->db->where('dep_id', $dep_id);
        $this->db->where('qd_status', 'wait');
        $this->db->order_by('qd_order_number', 'ASC');
        $all = $this->db->get()->result_array();

        $focus_i = 0;
        foreach ($all as $index => $row) {
            if ($row['qd_id'] == $qd_id) {
                $focus_i = $index;
                break;
            }
        }

        if ($focus_i > 0) {
            $data_focus = $all[$focus_i];
            $focus_number = $data_focus['qd_order_number'];

            $data_other = $all[$focus_i - 1];
            $other_number = $data_other['qd_order_number'];
            $other_qd_id = $data_other['qd_id'];

            $this->db->where('qd_id', $qd_id);
            $data_focus['qd_order_number'] = $other_number;
            $this->db->update('queue_dep', $data_focus);

            $this->db->where('qd_id', $other_qd_id);
            $data_other['qd_order_number'] = $focus_number;
            $this->db->update('queue_dep', $data_other);
        }
        return TRUE;
    }

    function down($dep_id, $qd_id) {
        $this->db->from('queue_dep');
        $this->db->where('dep_id', $dep_id);
        $this->db->where('qd_status', 'wait');
        $this->db->order_by('qd_order_number', 'ASC');
        $all = $this->db->get()->result_array();

        $focus_i = 0;
        foreach ($all as $index => $row) {
            if ($row['qd_id'] == $qd_id) {
                $focus_i = $index;
                break;
            }
        }

        if ((count($all) - 1) > $focus_i) {
            $data_focus = $all[$focus_i];
            $focus_number = $data_focus['qd_order_number'];

            $data_other = $all[$focus_i + 1];
            $other_number = $data_other['qd_order_number'];
            $other_qd_id = $data_other['qd_id'];

            $this->db->where('qd_id', $qd_id);
            $data_focus['qd_order_number'] = $other_number;
            $this->db->update('queue_dep', $data_focus);

            $this->db->where('qd_id', $other_qd_id);
            $data_other['qd_order_number'] = $focus_number;
            $this->db->update('queue_dep', $data_other);
        }
        return TRUE;
    }

}
