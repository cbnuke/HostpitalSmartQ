<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_login', 'login');

        //Check login
        if ($this->themes->checkLogin()) {
            redirect('home');
        }
    }

    public function index() {
        $data = array(
            'login_fail' => FALSE
        );
        if ($this->input->method(TRUE) === 'POST') {
            $post = $this->login->getPostLoginForm();
            if ($this->login->checkUser($post['emp_id'], $post['emp_pass'])) {
                redirect('home');
            } else {
                $data['login_fail'] = TRUE;
            }
        }
        $this->load->view('login.php', $data);
    }

}
