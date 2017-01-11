<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class M_themes extends CI_Model {

    private $title = 'Beauty & Art | Management';
    private $view_name = NULL;
    private $set_alert = array();
    private $set_data = NULL;
    private $breadcrumb_data = array();
    private $permission = "ALL";
    private $asset_extent = "jquery2|jquery-ui|bootstrap3|font-awesome";
    private $debud_data = NULL;
    private $lang_value = array('theme');
    private $version = '1.0';

    function setAlert($type = 'info', $title = 'เตือน!', $body = NULL) {
        $this->set_alert = array('type' => $type, 'title' => $title, 'body' => $body);
    }

    function setDebug($data) {
        $this->debud_data = $data;
    }

    function setTitle($name) {
        $this->title = $name . ' | ' . $this->title;
    }

    function setContent($name, $data = NULL) {
        $this->view_name = $name;
        $this->set_data = $data;
    }

    function setBreadcrumb($data) {
        $this->breadcrumb_data = $data;
    }

    function setPermission($mode) {
        $this->permission = $mode;
    }

    function setAssetExtent($data) {
        if ($this->asset_extent == "") {
            $this->asset_extent = $data;
        } else {
            $this->asset_extent .= '|' . $data;
        }
    }

    function checkLogin() {
        if ($this->session->has_userdata('user')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function checkLoginWithRedirect() {
        if (!$this->session->has_userdata('user')) {
            redirect('login');
        }
    }

    function checkPermission() {
        $sess = $this->session->userdata('user');
        if ($sess == NULL || $sess == FALSE) {
//            redirect('login');
        }
        return TRUE;
    }

    function setLanguage($in) {
        foreach ($in as $data) {
            array_push($this->lang_value, $data);
        }
    }

    function genTextAssetExtent($target = 'header') {
        $ans = "<!-- Auto Load By Themes engine -->\n";
        $assets = explode('|', $this->asset_extent);
        foreach ($assets as &$row) {
            $data = $this->config->item($row);
            $ans .="\t<!-- " . $row . " -->\n";
            if (count($data) > 0) {
                foreach ($data as $type => $data_type) {
                    foreach ($data_type as $file => $place) {
                        if ($place == $target) {
                            if ($type == "css") {
                                if (!file_exists(css_path() . $file)) {
                                    if ($this->debud_data == NULL) {
                                        $this->debud_data = array();
                                    }
                                    array_push($this->debud_data, 'Not found ' . $file);
                                } else {
                                    $ans.="\t" . css($file);
                                }
                            } else if ($type == "js") {
                                if (!file_exists(js_path() . $file)) {
                                    if ($this->debud_data == NULL) {
                                        $this->debud_data = array();
                                    }
                                    array_push($this->debud_data, 'Not found ' . $file);
                                } else {
                                    $ans.="\t" . js($file);
                                }
                            }
                        }
                    }
                }
            } else {
                if ($this->debud_data == NULL) {
                    $this->debud_data = array();
                }
                array_push($this->debud_data, 'Not found ' . $row . ' in config file');
            }
        }
        $ans .="\t<!-- End Auto Load -->\n";
        return $ans;
    }

    function showTemplate() {
        //--- Load language --//
//        $site_lang = $this->session->userdata('site_lang');
//        if (!$site_lang) {
//            $site_lang = 'thai'; //Default set language to Thai
//        }
//        foreach ($this->lang_value as $path) {
//            $this->lang->load($path, $site_lang); //Load message
//        }
        //Check login
        $this->checkPermission();
        //Load version for Cache CSS and JS
        $data['version'] = $this->version;



        $user = $this->session->userdata('user');
//        Old
//        $data['u_name'] = $user['u_name'];
//        $data['form_login'] = form_open('logout', array('class' => 'navbar-form pull-right', 'style' => 'height: 40px;'));

        $data['title'] = $this->title;
        $this->setAssetExtent('AdminLTE'); //For AdminLTE load ending
        $data['assetExtent'] = $this->genTextAssetExtent('header');
//        $data['debug'] = $this->debud_data;
//        $data['breadcrumb'] = $this->breadcrumb_data;
        //Data to view
        if ($this->set_data != NULL) {
            $data_view = $this->set_data;
        } else {
            $data_view = array();
        }
        $data_view += $this->breadcrumb_data;

        //Data to nav
        $data_nav['debug'] = $this->debud_data;
        $data_nav['page'] = $this->uri->segment(1);
        $data_nav['subpage'] = $this->uri->segment(2);

        $data_nav['name'] = $this->session->userdata('name');
        $data_nav['position'] = $this->session->userdata('position');
        $data_nav['per_name'] = $this->session->userdata('per_name');
        $data_nav['per_value'] = $this->session->userdata('per_value');
        $data_nav['picture'] = $this->session->userdata('picture');

        //Load Notifications to nav
        $id_users = $this->session->userdata('id_users');
//        $data_nav['notifications'] = $this->m_api->checkNotificationsByUser($id_users);
        //Load Task to nav
        $id_users = $this->session->userdata('id_users');
//        $data_nav['task'] = $this->m_api->checkTaskByUser($id_users);
        //--- Alert System ---//
        $data_nav['alert'] = $this->set_alert;

        $this->load->view('themes_head.php', $data);
        $this->load->view('themes_nav.php', $data_nav);
        if ($this->view_name != NULL) {
            $this->load->view($this->view_name, $data_view);
        }
        $this->load->view('themes_footer.php');
    }

}
