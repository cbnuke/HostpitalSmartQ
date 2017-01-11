<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class M_appointment extends CI_Model {

    function insertAppointment($data) {
        $this->datetime->createDate($data);
        if ($this->db->insert('Appointment', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function updateAppointment($data) {
        $this->datetime->updateDate($data);
        $this->db->where('quotation_id', $data['quotation_id']);
        if ($this->db->update('Appointment', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function genAppointmentID() {
        $this->db->from('Appointment');
        $this->db->order_by('quotation_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return 1;
        } else {
            $temp = $query->first_row('array');
            return $temp['quotation_id'] + 1;
        }
    }

    function checkAppointment($status = NULL) {
        $this->db->join('Service', 'Service.Serv_id=Appointment.Serv_id');
        $this->db->join('Customers', 'Customers.Cus_id=Appointment.Cus_id');
        if ($status != NULL) {
            if (is_array($status)) {
                foreach ($status as $row) {
                    $this->db->or_where('Appointment.status', $row);
                }
            } else {
                $this->db->where('Appointment.status', $status);
            }
        }
        $this->db->order_by('Appointment.quotation_date', 'ASC');
        $query = $this->db->get('Appointment');
        return $query->result_array();
    }

    function cancelAppointment($quotation_id) {
        $data = array(
            'quotation_id' => $quotation_id,
            'status' => 'cancel',
        );
        return $this->updateAppointment($data);
    }

    function setFormAppointment() {
        $i_quotation_id = array(
            'name' => 'quotation_id',
            'class' => 'form-control',
            'type' => 'number',
            'min' => '1',
            'required' => TRUE,
            'readonly' => TRUE,
            'value' => $this->genAppointmentID()
        );
        $temp = $this->customer->checkCustomer();
        $i_Cus_id = array();
        foreach ($temp as $row) {
            $i_Cus_id[$row['Cus_id']] = $row['Cus_name'];
        }
        $temp = $this->setting->checkService();
        $i_Serv_id = array();
        foreach ($temp as $row) {
            $i_Serv_id[$row['Serv_id']] = $row['Serv_name'];
        }
        $i_quotation_date = array(
            'name' => 'quotation_date',
            'class' => 'form-control datepicker',
            'required' => TRUE
        );
        $i_quotation_time = array(
            'name' => 'quotation_time',
            'class' => 'form-control timepicker',
            'required' => TRUE
        );
        $i_quotation_price = array(
            'name' => 'quotation_price',
            'class' => 'form-control',
            'required' => TRUE,
            'type' => 'number',
        );
        $i_remark = array(
            'name' => 'remark',
            'class' => 'form-control textarea',
        );
        $i_status = array(
            'reserve' => 'Reserve',
            'cancel' => 'Cancel',
            'waiting' => 'Waiting',
            'complete' => 'Complete',
        );

        $data = array(
            'quotation_id' => form_input($i_quotation_id),
            'Cus_id' => form_dropdown('Cus_id', $i_Cus_id, '', array('class' => 'form-control select2', 'style' => 'width: 100%')),
            'Serv_id' => form_dropdown('Serv_id', $i_Serv_id, '', array('class' => 'form-control select2', 'style' => 'width: 100%')),
            'quotation_date' => form_input($i_quotation_date),
            'quotation_time' => form_input($i_quotation_time),
            'quotation_price' => form_input($i_quotation_price),
            'remark' => form_textarea($i_remark),
            'status' => form_dropdown('status', $i_status, '', array('class' => 'form-control select2', 'style' => 'width: 100%')),
        );
        return $data;
    }

    function validationFormAppointment() {
        $this->form_validation->set_rules('quotation_id', '', 'trim|required');
        $this->form_validation->set_rules('Cus_id', '', 'trim|required');
        $this->form_validation->set_rules('Serv_id', '', 'trim|required');
        $this->form_validation->set_rules('quotation_date', '', 'trim|required');
        $this->form_validation->set_rules('quotation_time', '', 'trim|required');
        $this->form_validation->set_rules('quotation_price', '', 'trim|required');
        $this->form_validation->set_rules('remark', '', 'trim');
        $this->form_validation->set_rules('status', '', 'trim|required');
        return TRUE;
    }

    function getPostFormAppointment() {
        $data = array(
            'quotation_id' => $this->input->post('quotation_id'),
            'Cus_id' => $this->input->post('Cus_id'),
            'Serv_id' => $this->input->post('Serv_id'),
            'quotation_price' => $this->input->post('quotation_price'),
            'remark' => $this->input->post('remark'),
            'status' => $this->input->post('status'),
        );

        $temp = explode('/', $this->input->post('quotation_date'));
        $data['quotation_date'] = $temp[2] . '-' . $temp[0] . '-' . $temp[1] . ' ' . date("H:i:s", strtotime($this->input->post('quotation_time')));

        return $data;
    }

    function countAppointmentByStatus($status = 'reserve') {
        $query = $this->db->get_where('Appointment', array('status' => $status));
        return $query->num_rows();
    }

    function countAppointmentByService() {
        $this->db->select('Appointment.Serv_id,Service.Serv_name,COUNT(Appointment.Serv_id) as num');
        $this->db->from('Appointment');
        $this->db->join('Service', 'Service.Serv_id=Appointment.Serv_id');
        $this->db->group_by("Appointment.Serv_id");
        $query = $this->db->get();
        return $query->result_array();
    }

    function validationCancelAppointment() {
        $this->form_validation->set_rules('quotation_id', '', 'trim|required');
        return $this->form_validation->run();
    }

    function getPostCancelAppointment() {
        $data = array(
            'quotation_id' => $this->input->post('quotation_id'),
        );
        return $data;
    }

    function setFormCompleteAppointment() {
        $i_quotation_id = array(
            'name' => 'quotation_id',
            'class' => 'form-control',
            'required' => TRUE,
            'readonly' => TRUE,
        );
        $i_real_date = array(
            'name' => 'real_date',
            'class' => 'form-control datepicker',
            'required' => TRUE
        );
        $i_real_date_time = array(
            'name' => 'real_date_time',
            'class' => 'form-control timepicker',
            'required' => TRUE
        );
        $i_real_price = array(
            'name' => 'real_price',
            'class' => 'form-control',
            'required' => TRUE,
            'type' => 'number',
        );
        $i_rear_guarantee = array(
            'name' => 'rear_guarantee',
            'class' => 'form-control',
            'required' => TRUE,
            'type' => 'number',
        );
        $i_remark = array(
            'name' => 'remark',
            'class' => 'form-control textarea',
        );

        $data = array(
            'quotation_id' => form_input($i_quotation_id),
            'real_date' => form_input($i_real_date),
            'real_date_time' => form_input($i_real_date_time),
            'real_price' => form_input($i_real_price),
            'rear_guarantee' => form_input($i_rear_guarantee),
            'remark' => form_textarea($i_remark),
        );
        return $data;
    }

    function getPostFormCompleteAppointment() {
        $data = array(
            'quotation_id' => $this->input->post('quotation_id'),
            'real_price' => $this->input->post('real_price'),
            'rear_guarantee' => $this->input->post('rear_guarantee'),
            'status' => 'complete',
            'remark' => $this->input->post('remark'),
        );

        $temp = explode('/', $this->input->post('real_date'));
        $data['real_date'] = $temp[2] . '-' . $temp[1] . '-' . $temp[0] . ' ' . date("H:i:s", strtotime($this->input->post('real_date_time')));

        return $data;
    }

    function validationCompleteAppointment() {
        $this->form_validation->set_rules('quotation_id', '', 'trim|required');
        $this->form_validation->set_rules('real_price', '', 'trim|required');
        $this->form_validation->set_rules('rear_guarantee', '', 'trim|required');
        $this->form_validation->set_rules('real_date', '', 'trim|required');
        $this->form_validation->set_rules('remark', '', 'trim');
        return $this->form_validation->run();
    }

//    SELECT *,COUNT(Serv_id) as num FROM `appointment` WHERE 1 GROUP BY Serv_id
}
