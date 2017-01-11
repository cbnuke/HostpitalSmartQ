<?php

class Logout extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_login', 'login');
    }

    public function index() {
        if ($this->login->logOut()) {
            redirect('login');
        } else {
            redirect('home');
        }
    }

}
