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

    function insertCustomer($data) {
        $this->datetime->createDate($data);
        if ($this->db->insert('Customers', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function updateCustomer($data) {
        $this->datetime->updateDate($data);
        $this->db->where('Cus_id', $data['Cus_id']);
        if ($this->db->update('Customers', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function genCustomerID() {
        $this->db->from('Customers');
        $this->db->order_by('Cus_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return 'BA0001';
        } else {
            $temp = $query->first_row('array');
            $num = str_pad(substr($temp['Cus_id'], 2) + 1, 4, "0", STR_PAD_LEFT);
            return 'BA' . $num;
        }
    }

    function checkCustomer($Cus_id = NULL) {
        if ($Cus_id != NULL) {
            $query = $this->db->get_where('Customers', array('Cus_id' => $Cus_id));
            return $query->first_row('array');
        } else {
            $query = $this->db->get('Customers');
            return $query->result_array();
        }
    }

    function checkCustomerAppointment($Cus_id = NULL, $status = NULL) {
        if ($Cus_id == NULL) {
            return array();
        }
        $this->db->join('Service', 'Service.Serv_id=Appointment.Serv_id');
        $this->db->join('Customers', 'Customers.Cus_id=Appointment.Cus_id');
        $this->db->where('Appointment.Cus_id', $Cus_id);
        if ($status != NULL) {
            if (is_array($status)) {
                $this->db->where_in('Appointment.status', $status);
            } else {
                $this->db->where('Appointment.status', $status);
            }
        }
        $this->db->order_by('Appointment.quotation_date', 'ASC');
        $query = $this->db->get('Appointment');
        $ans = $query->result_array();

        foreach ($ans as &$row) {
            if ($row['real_date'] != NULL) {
                $d1 = DateTime::createFromFormat('Y-m-d H:i:s', $row['real_date']);
                $d1->add(new DateInterval('P' . $row['rear_guarantee'] . 'M'));
                $row['expire'] = $d1->format('Y-m-d H:i:s');
            } else {
                $row['expire'] = date('Y-m-d H:i:s');
            }
        }
        return $ans;
    }

    function setFormCustomer() {
        $i_Cus_id = array(
            'name' => 'Cus_id',
            'class' => 'form-control',
            'required' => TRUE,
            'value' => $this->genCustomerID()
        );
        $i_Cus_name = array(
            'name' => 'Cus_name',
            'class' => 'form-control',
            'required' => TRUE
        );
        $i_Cus_nick = array(
            'name' => 'Cus_nick',
            'class' => 'form-control',
        );
        $i_Cus_tel = array(
            'name' => 'Cus_tel',
            'class' => 'form-control',
            'required' => TRUE
        );

        $data = array(
            'Cus_id' => form_input($i_Cus_id),
            'Cus_name' => form_input($i_Cus_name),
            'Cus_nick' => form_input($i_Cus_nick),
            'Cus_tel' => form_input($i_Cus_tel),
        );
        return $data;
    }

    function validationFormCustomer() {
        $this->form_validation->set_rules('Cus_id', '', 'trim|required');
        $this->form_validation->set_rules('Cus_name', '', 'trim|required');
        $this->form_validation->set_rules('Cus_nick', '', 'trim');
        $this->form_validation->set_rules('Cus_tel', '', 'trim|required');
        return TRUE;
    }

    function getPostFormCustomer() {
        $data = array(
            'Cus_id' => $this->input->post('Cus_id'),
            'Cus_name' => $this->input->post('Cus_name'),
            'Cus_nick' => $this->input->post('Cus_nick'),
            'Cus_tel' => $this->input->post('Cus_tel')
        );
        return $data;
    }

    function setFormUseGuarantee() {
        $i_guarantee_use_date = array(
            'name' => 'guarantee_use_date',
            'class' => 'form-control datepicker',
            'required' => TRUE
        );
        $i_guarantee_use_time = array(
            'name' => 'guarantee_use_time',
            'class' => 'form-control timepicker',
            'required' => TRUE
        );

        $data = array(
            'guarantee_use_date' => form_input($i_guarantee_use_date),
            'guarantee_use_time' => form_input($i_guarantee_use_time),
        );
        return $data;
    }

    function validationFormUseGuarantee() {
        $this->form_validation->set_rules('quotation_id', '', 'trim|required');
        $this->form_validation->set_rules('guarantee_use_date', '', 'trim|required');
        $this->form_validation->set_rules('guarantee_use_time', '', 'trim|required');
        return $this->form_validation->run();
    }

    function getPostFormUseGuarantee() {
        $data = array(
            'quotation_id' => $this->input->post('quotation_id'),
            'guarantee_use' => '1',
        );

        $temp = explode('/', $this->input->post('guarantee_use_date'));
        $data['guarantee_use_date'] = $temp[2] . '-' . $temp[1] . '-' . $temp[0] . ' ' . date("H:i:s", strtotime($this->input->post('guarantee_use_time')));

        return $data;
    }

}
