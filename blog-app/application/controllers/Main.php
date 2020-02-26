<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	//byDefoult first load index function
	//modifay in aplication/config/routes.php
	public function index() 
	{
		//echo 'test';
		//Or this is auto load on index.php
		//$this->test1();

		//Load model
		$this->load->model('main_model');
		//echo $this->main_model->test_main();

		//Passing data to view
		$data = new stdClass(); // object
		$data->title = "Controler title";
		$data->data = "Some data";
		//For array
		//$data["title"] = "Controler title";
		//gather information  from models
		$data->data_from_model = $this->main_model->test_main();
		//Load view => look view main_view
		$this->load->view('main_view.php', $data);
	}
	//to call in URL : codeIgniter/index.php/main/test1
	public function test1()
	{
		echo 'test1 public function';
	}


}
