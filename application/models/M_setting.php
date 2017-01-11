<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class M_setting extends CI_Model {

    function insertService($data) {
        $this->datetime->createDate($data);
        if ($this->db->insert('Service', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function updateService($data) {
        $this->datetime->updateDate($data);
        $this->db->where('Serv_id', $data['Serv_id']);
        if ($this->db->update('Service', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function checkService() {
        $query = $this->db->get('Service');
        return $query->result_array();
    }

    function genServiceID() {
        $this->db->from('Service');
        $this->db->order_by('Serv_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return 1;
        } else {
            $temp = $query->first_row('array');
            return $temp['Serv_id'] + 1;
        }
    }

    function setFormService() {
        $i_Serv_id = array(
            'name' => 'Serv_id',
            'class' => 'form-control',
            'type' => 'number',
            'min' => '1',
            'required' => TRUE,
            'value' => $this->genServiceID()
        );
        $i_Serv_name = array(
            'name' => 'Serv_name',
            'class' => 'form-control',
            'required' => TRUE
        );
        $i_Serv_price = array(
            'name' => 'Serv_price',
            'class' => 'form-control',
            'type' => 'number',
            'min' => '0',
            'required' => TRUE
        );
        $i_Serv_guarantee = array(
            'name' => 'Serv_guarantee',
            'class' => 'form-control',
            'type' => 'number',
            'min' => '0',
            'required' => TRUE,
            'value' => '0'
        );

        $data = array(
            'Serv_id' => form_input($i_Serv_id),
            'Serv_name' => form_input($i_Serv_name),
            'Serv_price' => form_input($i_Serv_price),
            'Serv_guarantee' => form_input($i_Serv_guarantee),
        );
        return $data;
    }

    function validationFormService() {
        $this->form_validation->set_rules('Serv_id', '', 'trim|required');
        $this->form_validation->set_rules('Serv_name', '', 'trim|required');
        $this->form_validation->set_rules('Serv_price', '', 'trim|required');
        $this->form_validation->set_rules('Serv_guarantee', '', 'trim|required');
        return TRUE;
    }

    function getPostFormService() {
        $data = array(
            'Serv_id' => $this->input->post('Serv_id'),
            'Serv_name' => $this->input->post('Serv_name'),
            'Serv_price' => $this->input->post('Serv_price'),
            'Serv_guarantee' => $this->input->post('Serv_guarantee')
        );
        return $data;
    }

    function insertAdmin($data) {
        $this->datetime->createDate($data);
        if ($this->db->insert('Admin', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function updateAdmin($data) {
        $this->datetime->updateDate($data);
        $this->db->where('Admin_id', $data['Admin_id']);
        if ($this->db->update('Admin', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function checkAdmin() {
        $query = $this->db->get('Admin');
        return $query->result_array();
    }

    function setFormAdmin() {
        $i_Admin_id = array(
            'name' => 'Admin_id',
            'class' => 'form-control',
            'required' => TRUE,
        );
        $i_Admin_pass = array(
            'name' => 'Admin_pass',
            'class' => 'form-control',
            'required' => TRUE,
            'type' => 'password'
        );
        $i_Admin_name = array(
            'name' => 'Admin_name',
            'class' => 'form-control',
            'required' => TRUE
        );
        $i_Admin_tel = array(
            'name' => 'Admin_tel',
            'class' => 'form-control',
            'type' => 'tel'
        );

        $data = array(
            'Admin_id' => form_input($i_Admin_id),
            'Admin_pass' => form_input($i_Admin_pass),
            'Admin_name' => form_input($i_Admin_name),
            'Admin_tel' => form_input($i_Admin_tel),
        );
        return $data;
    }

    function validationFormAdmin() {
        $this->form_validation->set_rules('Admin_id', '', 'trim|required');
        $this->form_validation->set_rules('Admin_pass', '', 'trim|required');
        $this->form_validation->set_rules('Admin_name', '', 'trim|required');
        $this->form_validation->set_rules('Admin_tel', '', 'trim');
        return TRUE;
    }

    function getPostFormAdmin() {
        $data = array(
            'Admin_id' => $this->input->post('Admin_id'),
            'Admin_pass' => $this->input->post('Admin_pass'),
            'Admin_name' => $this->input->post('Admin_name'),
            'Admin_tel' => $this->input->post('Admin_tel')
        );
        if (strlen($data['Admin_pass']) == 32) {
            unset($data['Admin_pass']);
        } else {
            $data['Admin_pass'] = md5($data['Admin_pass']);
        }
        return $data;
    }

}
