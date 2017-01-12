<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class M_login extends CI_Model {

    function getPostLoginForm() {
        $data = array(
            'emp_id' => $this->input->post('user'),
            'emp_pass' => $this->input->post('pass'),
        );
        return $data;
    }

    function checkAdmin($user, $pass) {
        $query = $this->db->get_where('employee', array('emp_id' => $user, 'emp_pass' => md5($pass)));
        if ($query->num_rows() == 1) {
            return $query->first_row('array');
        } else {
            return FALSE;
        }
    }

    function checkUser($user, $pass) {
        $session_data = array(
            'emp_id' => 'admin',
            'emp_firstname' => 'Admin',
            'emp_lastname' => 'Admin',
            'login' => FALSE,
        );

        $temp = $this->checkAdmin($user, $pass);
        if ($temp != FALSE) {
            $session_data['login'] = TRUE;
            $session_data['emp_id'] = $temp['emp_id'];
            $session_data['emp_firstname'] = $temp['emp_firstname'];
            $session_data['emp_lastname'] = $temp['emp_lastname'];
            $session_data['emp_position'] = $temp['emp_position'];
            $session_data['dep_id'] = $temp['dep_id'];
            $this->session->set_userdata($session_data);
            return TRUE;
        }
    }

    function logOut() {
        $this->session->sess_destroy();
        return TRUE;
    }

}
