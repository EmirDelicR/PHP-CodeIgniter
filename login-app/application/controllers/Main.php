<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index() 
	{
		$this->load->model('main_model');
		
		$data = new stdClass(); // object
		$data->title = "Controler title";
		$data->data = "Some data";
		$this->load->view('templates/header', $data);
		$this->load->view('index', $data);
		$this->load->view('templates/footer', $data);
	}


}
