<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class M_api extends CI_Model {

    function checkPatient() {
        return $this->db->get('patient')->result_array();
    }

    function insertPatient($data) {
        unset($data['mode']);
        return $this->db->insert('patient', $data);
    }

}
