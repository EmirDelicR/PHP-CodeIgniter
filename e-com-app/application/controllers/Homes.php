<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homes extends CI_Controller {
    
	public function __construct(){
	    parent::__construct();
		//$this->load->model('user_model');
		//$this->load->helper('security');
		//$this->load->helper('email');
	}

	public function index() 
	{
       if(!$this->session->userdata('logged_in')) {
            redirect('');
        }
		$data['title'] = "Home Page";
		//$data['headers'] = ['Login','Registration'];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('pages/home', $data);
        $this->load->view('templates/footer');
	}


}
