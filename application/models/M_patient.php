<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class M_patient extends CI_Model {

    function checkPatient() {
        return $this->db->get('patient')->result_array();
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
