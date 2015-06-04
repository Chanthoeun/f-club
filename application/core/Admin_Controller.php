<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin_Controller
 *
 * @author chanthoeun
 */
class Admin_Controller extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('template', array('layout' => 'backend', 'asset_location' => 'assets', 'site_name' => 'Funny Club', 'no_footer' =>TRUE));
        $this->load->library('form_validation');
    }
    
    public function check_login(){
        if (!$this->ion_auth->logged_in())
        {
            $this->session->set_flashdata('message', 'You are not log in.');
            redirect(site_url('auth/login'), 'refresh');
        }
        else
        {
            if(!$this->ion_auth->is_admin())
            {
                $this->session->set_flashdata('message', 'You must be an administrator to view this page.');
                
                //log the user out
                $this->ion_auth->logout();
                redirect(site_url('auth/login'), 'refresh');
            }
            // set home breadcrumb
            $this->template->set_home_breadcrumb('control');
            return TRUE;
        }
    }
}